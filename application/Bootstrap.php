<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initAutoload() {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->setFallbackAutoloader(true);
    }

    protected function _initView() {
        $smartyConfigs = $this->getOption('smarty');
        Zend_Loader_Autoloader::getInstance()->pushAutoloader(NULL, 'Smarty_');
        $view = new SmartyMain($smartyConfigs);
        $viewRender = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRender->setView($view);
        $viewRender->setViewSuffix('tpl');
    }

    protected function _initEmailTransport() {
        $mailTransport = new Zend_Mail_Transport_Smtp('mail.mobieduc.com', $this->getOption('mail'));
        Zend_Mail::setDefaultTransport($mailTransport);
    }

}

