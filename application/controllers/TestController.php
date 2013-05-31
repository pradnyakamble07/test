<?php

class TestController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {   
        $registry = Zend_Registry::getInstance();
        $albums = new Application_Model_DbTable_Albums();
        $result = $albums->fetchAll();
        $page=$this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(3);
        $paginator->setCurrentPageNumber($page);
        //echo "<pre>";
        //print_r($paginator);die;
        $this->view->paginator=$paginator;
    }

    public function addAction()
    {  
       $form = new Application_Form_Album();
       $form->submit->setLabel('Add');
      
       $this->view->form = $form;
       if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            //echo "<pre>";
            //print_r($formData);die;
            if ($form->isValid($formData)) {
                //echo "here";die;
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->addAlbum($artist, $title);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction(){
       $form = new Application_Form_Album();
       $form->submit->setLabel('Save');
       $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            //echo "<pre>";
            //print_r($formData);die;
            if ($form->isValid($formData)) {
                //echo "here";die;
                $id = (int)$form->getValue('id');
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_DbTable_Albums();
                $albums->updateAlbum($id,$artist, $title);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }else{
            $id = $this->_getParam('id',0);
            //echo $id;die;
            if($id>0){
                 $albums = new Application_Model_DbTable_Albums();
                 $form->populate($albums->getAlbum($id));
            }
        }
    }

    public function deleteAction(){
         if ($this->getRequest()->isPost()) {
             $del = $this->getRequest()->getPost('del');
             if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $albums = new Application_Model_DbTable_Albums();
                $albums->deleteAlbum($id);
            }
            $this->_helper->redirector('index');
         } else {
            $id = $this->_getParam('id', 0);
            $albums = new Application_Model_DbTable_Albums();
            $this->view->album = $albums->getAlbum($id);
        }
    }


}







