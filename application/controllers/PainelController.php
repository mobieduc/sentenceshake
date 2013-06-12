<?php

/**
 * Description of PainelController
 *
 * @author Jarddel Antunes
 */
class PainelController extends Zend_Controller_Action {

    public function init() {
        $this->_auth = Zend_Auth::getInstance();
        if ($this->_auth->getIdentity() == null)
            $this->_redirect('/');
    }

    public function indexAction() {
        $this->view->assign('auth', $this->_auth->getIdentity());
    }

}

