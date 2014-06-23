<?php 
/**
 * Modelo para mapeador de contactos
 *
 * @package    Agenda
 * @subpackage Contactos
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Juan de la Cruz García García <jcruzgar@gmail.com>
 */
class Application_Model_ContactosMapper
{
    protected $_dbTable;
    
    /**
    * Lee todos los contactos
    *
    * Llama al Stored Procedure TodosContactos y devuelve una lista con todos los contactos y su nombre y apellido
    * 
    * @return arr $contactos
    */
    public function leerTodos()
    {
        $db = new Zend_Db_Adapter_Pdo_Mysql(array(
            'host'     => 'localhost',
            'username' => 'jdlcgarcia',
            'password' => '4dm1np4ssw0rd',
            'dbname'   => 'agenda',
            'charset' => 'utf8'));
        $todosContactos = $db->fetchAll("CALL TodosContactos()", array(25));
        
        $contactos   = array();
        foreach ($todosContactos as $fila) {
            $contacto = new Application_Model_Contactos();
            $contacto->setId($fila['id'])
            ->setNombre($fila['nombre'])
            ->setApellido($fila['apellido'])
            /*->setDireccion($fila['direccion'])
            ->setEmail($fila['email'])
            ->setCreado($fila['creado'])*/;
            
            $contactos[] = $contacto;
        }
      

        return $contactos;
    }

    /**
    * Lee un contacto
    *
    * Llama al Stored Procedure datosDe y devuelve un objeto Contacto con todos los datos personales y teléfonos
    * 
    * @return arr $contactos
    */
    public function leerContacto($id)
    {
        $db = new Zend_Db_Adapter_Pdo_Mysql(array(
            'host'     => 'localhost',
            'username' => 'jdlcgarcia',
            'password' => '4dm1np4ssw0rd',
            'dbname'   => 'agenda',
            'charset' => 'utf8'));
        $datosContacto = $db->fetchAll("CALL datosDe(".$id.")", array(25));

        foreach ($datosContacto as $fila) {
            $contacto = new Application_Model_Contactos();
            $contacto->setId($fila['id'])
            ->setNombre($fila['nombre'])
            ->setApellido($fila['apellido'])
            ->setDireccion($fila['direccion'])
            ->setEmail($fila['email'])
            ->setCreado($fila['creado']);
        }
        
        $telefonos = $db->fetchAll("CALL TelefonosDe(".$id.")", array(25));
        $numeros = array();
        foreach ($telefonos as $filatel) {
            $telefono = new Application_Model_Telefonos();
            $telefono->setId($filatel['id'])->setTipo($filatel['tipo'])->setNumero($filatel['numero']);
            $numeros[] = $telefono;
        }
        if (count($numeros)!= 0)
            $contacto->setTelefonos($numeros);
        return $contacto;
    }
}
?>