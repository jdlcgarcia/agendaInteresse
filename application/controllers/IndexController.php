<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        
    }
    /**
    * Acción de página de inicio
    *
    * Lista todos los contactos
    * 
    * @var \entries arr Lista de contactos 
    */
    public function indexAction()
    {
        $agenda = new Application_Model_ContactosMapper();
        $this->view->entries = $agenda->leerTodos();
    }

}

