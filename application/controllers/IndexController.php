<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
      
        $users = new Application_Model_DbTable_Users();
        $this->view->users = $users->fetchAll(); 

    }
    function addAction()
    {

        $form = new Application_Form_Users();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) 
        {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) 
            {
                $name = $form->getValue('name');
                $email = $form->getValue('email');
                $users = new Application_Model_DbTable_Users();
                $users->addUser($name, $email);
                $this->_helper->redirector('index');
            } 
            else 
            {
                $form->populate($formData);
            }
        }
    }

    function editAction()
    {
        $form = new Application_Form_Users();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) 
        {
            $formData = $this->getRequest()->getPost();
            if($form->isValid($formData)) 
            {
                $id = (int)$form->getValue('id');
                $name = $form->getValue('name');
                $email = $form->getValue('email');
                $users = new Application_Model_DbTable_Users();
                $users->updateUser($id, $name, $email);
                $this->_helper->redirector('index');
            }     
            else 
            {
                $form->populate($formData);
            }
        }
    
    else 
    {
        $id = $this->_getParam('id', 0);
        if ($id > 0)
        {
            $users = new Application_Model_DbTable_Users();
            $form->populate($users->getUser($id));
        }
    }
    }
    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) 
        {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') 
            {
                $id = $this->getRequest()->getPost('id');
                $albums = new Application_Model_DbTable_Users();
                $albums->deleteUser($id);
            }
            $this->_helper->redirector('index');
        } 
        else 
        {
            $id = $this->_getParam('id', 0);
            $users = new Application_Model_DbTable_Users();
            $this->view->user = $users->getUser($id);
        }
    }


}







