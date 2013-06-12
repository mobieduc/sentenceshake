<?php

/**
 * Description of UsuarioController
 *
 * @author Jarddel Antunes
 */
class UsuarioController extends Zend_Controller_Action {

    public function init() {
        $this->_usuario = new Usuario();
    }

    public function indexAction() {
        
    }

    public function confirmAction() {
        $key = $this->_request->getParam('key');
        $usuario = $this->_usuario->findBy('confirmkey', $key);

        if ($usuario):
            if ($this->_loginProcessByKey($usuario->confirmkey)):
                $usuario->confirmkey = null;
                $this->_usuario->updateById($usuario);
                $this->_redirect('/painel');
            endif;
        endif;
    }

    public function cadastroAction() {
        if ($this->_request->isPost()) :
            $data = $this->_request->getPost();
            if ($this->_cadastrarUsuario($data)):
                $this->view->assign('message', 'Registration completed successfully, please confirm it through your email');
                $this->_enviarEmailConfirmacao($data['name'], $data['email']);
            else:
                $this->view->assign('message', 'Registration completed successfully, please confirm it through your email');
            endif;
        endif;
    }

    protected function _enviarEmailConfirmacao($nomeDestinatario, $emailDestinatario) {
        $mail = new Zend_Mail();

        $html = '<p>Dear, ' . $nomeDestinatario . '.</p>
                 <p>Thank you for your registration in SentenceShake, to confirm it click the link below.</p>
                 <a href="http://' . $_SERVER["HTTP_HOST"] . '/usuario/confirm/?key=' . sha1($nomeDestinatario . $emailDestinatario) . '"> >> Click here to Activation << </a>
                 <p>Att,</p>
                 <p>Sentece-Shake</p>';

        $mail->setBodyText(strip_tags($html))
                ->setBodyHtml(utf8_decode($html))
                ->setFrom('sentenceshake@mobieduc.com', 'SentenceShake')
                ->addTo($emailDestinatario, $nomeDestinatario)
                ->setSubject('SentenceShake - Confirm your registration')
                ->send();
    }

    protected function _cadastrarUsuario($data) {
        $dados = array(
            'nome' => $data['name'],
            'email' => $data['email'],
            'senha' => sha1($data['password']),
            'tipo' => 'SIMPLE',
            'confirmkey' => sha1($data['name'] . $data['email'])
        );
        $searchUser = $this->_usuario->findBy('email', $dados['email']);
        if (!$searchUser):
            $this->_usuario->insert($dados);
            return true;
        else:
            return false;
        endif;
    }

    protected function _loginProcessByKey($key) {
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($key);
        $adapter->setCredential($key);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);

        if ($result->isValid()) :
            $usuario = $adapter->getResultRowObject(null, 'senha');
            $auth->getStorage()->write($usuario);
            return true;
        else:
            return false;
        endif;
    }

    protected function _getAuthAdapter() {
        $authAdapter = new Zend_Auth_Adapter_DbTable();
        $authAdapter->setTableName('usuarios')->setIdentityColumn('confirmkey')->setCredentialColumn('confirmkey');
        return $authAdapter;
    }

}

