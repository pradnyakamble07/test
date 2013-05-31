<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Zend_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract 

{

    public function loggedInAs ()

    {

        $auth = Zend_Auth::getInstance();
        //echo "<pre>";
        //print_r($auth);die;
        
        if ($auth->hasIdentity()) {

            $username = $auth->getIdentity()->username;

            $logoutUrl = $this->view->url(array('controller'=>'auth',

                'action'=>'logout'), null, true);

            return 'Welcome ' . $username .  '. <a href="'.$logoutUrl.'">Logout</a>';

        } 



        $request = Zend_Controller_Front::getInstance()->getRequest();

        $controller = $request->getControllerName();

        $action = $request->getActionName();

        if($controller == 'auth' && $action == 'index') {

            return '';

        }

        $loginUrl = $this->view->url(array('controller'=>'auth', 'action'=>'index'));

        return '<a href="'.$loginUrl.'">Login</a>';

    }

}

?>
