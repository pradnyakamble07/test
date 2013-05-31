<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
   protected function _initPlaceholders()
    {
        $this->bootstrap('View');
        $view = $this->getResource('View');
        $view->doctype('XHTML1_STRICT');
 
        // Set the initial title and separator:
        $view->headTitle('My Site')
             ->setSeparator(' :: ');
    } 

}

