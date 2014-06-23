<?php

class ContactoController extends Zend_Controller_Action
{

  public function init()
  {

  }

    /**
    * Acción de abrir formulario
    *
    * Abre el formulario. Si el parametro ID no es nulo, se cargan los datos del contacto en cada campo 
    * 
    * @param int $id
    */
    public function formularioAction()
    {
      $this->_helper->layout()->disableLayout(); 
      if (null !== $this->_getParam('id'))
      {
        $agenda = new Application_Model_ContactosMapper();
        $datosContacto = $agenda->leerContacto($this->_getParam('id'));
        $this->view->id = $this->_getParam('id');
        $this->view->nombre = $datosContacto->getNombre();
        $this->view->apellido = $datosContacto->getApellido();
        $this->view->direccion = $datosContacto->getDireccion();
        $this->view->email = $datosContacto->getEmail();
        $this->view->telefonos = $datosContacto->getTelefonos();

      }
    }

    /**
    * Acción de grabar datos
    *
    * Graba los datos del formulario. Se presuponen validados.
    * 
    * @param arr $_POST
    */
    public function grabarAction()
    {
      $this->_helper->layout->disableLayout(); 
      $this->_helper->viewRenderer->setNoRender(TRUE);

      $data = $this->_request->getPost();
      $db = new Zend_Db_Adapter_Pdo_Mysql(array(
        'host'     => 'localhost',
        'username' => 'jdlcgarcia',
        'password' => '4dm1np4ssw0rd',
        'dbname'   => 'agenda',
        'charset' => 'utf8'));
      try{
        $db->beginTransaction();
        $db->query("CALL NuevoContacto('".$data['nombre']."','".$data['apellidos']."','".$data['direccion']."','".$data['email']."',@someOutParameter)");
        $id = $db->fetchOne("SELECT @someOutParameter as lastID");
        foreach($data['telefonos'] as $telefono)
        {
          $todosContactos = $db->query("CALL CrearTelefono('".$id."','".$telefono['tipo']."','".$telefono['numero']."')");
        }

        $db->commit();
      } catch (Exception $e) {
        $db->rollback();
      }
    }

    /**
    * Acción de editar datos
    *
    * Graba los datos del formulario en una tupla existente. Se presuponen validados.
    * 
    * @param arr $_POST
    */
    public function editarAction()
    {
      $this->_helper->layout->disableLayout(); 
      $this->_helper->viewRenderer->setNoRender(TRUE);

      $data = $this->_request->getPost();
      $db = new Zend_Db_Adapter_Pdo_Mysql(array(
        'host'     => 'localhost',
        'username' => 'jdlcgarcia',
        'password' => '4dm1np4ssw0rd',
        'dbname'   => 'agenda',
        'charset' => 'utf8'));
      try{
        $db->beginTransaction();
        $db->query("CALL BorrarTelefonos(".$data['id'].")");
        $db->query("CALL EditarContacto('".$data['id']."','".$data['nombre']."','".$data['apellidos']."','".$data['direccion']."','".$data['email']."')");
        foreach($data['telefonos'] as $telefono)
        {
          $db->query("CALL CrearTelefono('".$data['id']."','".$telefono['tipo']."','".$telefono['numero']."')");
        }

        $db->commit();
      } catch (Exception $e) {
        $db->rollback();
      }
    }
  }

