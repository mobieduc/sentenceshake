<?php

/**
 * Description of IndexController
 *
 * @author Jarddel Antunes
 */
class IndexController extends Zend_Controller_Action {

    public function init() {
        $this->_usuario = new Usuario();
    }

    public function indexAction() {
        if (Zend_Auth::getInstance()->getIdentity() != null) {
            $this->_redirect('/painel');
        }
        $this->view->assign('erro', '');
        if ($this->_request->isPost()) :
            $data = $this->_request->getPost();
            if (isset($data['login']) && $data['login'] == 'log in'): //LOGIN
                if ($this->_loginProcess($data)):
                    $this->_redirect('/painel');
                endif;
            endif;
        endif;
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('/');
    }

    protected function _loginProcess($values) {
        $erroMessage = '';
        $adapter = $this->_getAuthAdapter();

        $adapter->setIdentity($values['email']);
        $adapter->setCredential($values['senha']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);

        if ($result->isValid()) :
            $usuario = $adapter->getResultRowObject(null, 'senha');
            if ($usuario->confirmkey == null):
                $auth->getStorage()->write($usuario);
                return true;
            else:
                Zend_Auth::getInstance()->clearIdentity();
                $this->view->assign('erro', '<span class="dados-invalidos">Please, confirm your email address</span>');
                return false;
            endif;
        else:
            $this->view->assign('erro', '<span class="dados-invalidos">Invalid e-mail address or password</span>');
            return false;
        endif;
    }

    protected function _getAuthAdapter() {
        $authAdapter = new Zend_Auth_Adapter_DbTable();
        $authAdapter->setTableName('usuarios')->setIdentityColumn('email')->setCredentialColumn('senha')->setCredentialTreatment('SHA1(?)');
        return $authAdapter;
    }

}

