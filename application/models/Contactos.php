<?php 
/**
 * Modelo para Contactos
 *
 * @package    Agenda
 * @subpackage Contactos
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Juan de la Cruz García García <jcruzgar@gmail.com>
 */
class Application_Model_Contactos
{
    protected $_id;
    protected $_nombre;
    protected $_apellido;
    protected $_direccion;
    protected $_email;
    protected $_telefonos = array();
    protected $_creado;

    /**
    * Construye la agenda
    *
    * Comprueba si hay opciones definidas y construye la agenda según estas o una por defecto.
    * 
    * @param arr $opciones
    */
    public function __construct(array $opciones = null)
    {
        if (is_array($opciones)) {
            $this->setOpciones($opciones);
        }
    }

    /**
    * Setter de parámetros individuales
    *
    * Establece un valor a un atributo concreto
    * 
    * @param string $nombre atributo al que queremos acceder
    * @param string $valor valor que queremos darle al atributo
    * @throws Exception Si el método construido no existe
    */
    public function __set($nombre, $valor)
    {
        $metodo = 'set' . $nombre;
        if (('mapper' == $nombre) || !method_exists($this, $metodo)) {
            throw new Exception('Método de agenda no válido');
        }
        $this->$metodo($valor);
    }

    /**
    * Getter de parámetros individuales
    *
    * Obtiene el valor de un atributo concreto
    * 
    * @param string $nombre atributo del que queremos el valor
    * @return string valor del atributo 
    * @throws Exception Si el método construido no existe
    */
    public function __get($nombre)
    {
        $metodo = 'get' . $nombre;
        if (('mapper' == $nombre) || !method_exists($this, $metodo)) {
            throw new Exception('Método de agenda no válido');
        }
        return $this->$metodo();
    }

    /**
    * Setter de opciones
    *
    * Añade valores para construir un objeto concreto
    * 
    * @param arr $opciones valores que tendrá nuestro objeto
    * @return objeto creado con las opciones que hemos definido
    */
    public function setOpciones(array $opciones)
    {
        $metodos = get_class_methods($this);
        foreach ($opciones as $key => $value) {
            $metodo = 'set' . ucfirst($key);
            if (in_array($metodo, $metodos)) {
                $this->$metodo($value);
            }
        }
        return $this;
    }

    /**
    * Setter de ID
    *
    * Establece un valor al parámetro ID
    * 
    * @param string $id valor que queremos darle a ID
    * @return el propio objeto
    */
    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    /**
    * Getter de ID
    *
    * Obtiene el valor del parámetro ID para el objeto
    * 
    * @return string ID del objeto
    */
    public function getId()
    {
        return $this->_id;
    }

    /**
    * Setter de nombre
    *
    * Establece un valor al parámetro Nombre
    * 
    * @param string $nombre valor que queremos darle a Nombre
    * @return el propio objeto
    */
    public function setNombre($nombre)
    {
        $this->_nombre = (string) $nombre;
        return $this;
    }

    /**
    * Getter de nombre
    *
    * Obtiene el valor del parámetro Nombre para el objeto
    * 
    * @return string nombre del objeto
    */
    public function getNombre()
    {
        return $this->_nombre;
    }

    /**
    * Setter de apellido
    *
    * Establece un valor al parámetro Apellido
    * 
    * @param string $apellido valor que queremos darle a Apellido
    * @return el propio objeto
    */
    public function setApellido($apellido)
    {
        $this->_apellido = (string) $apellido;
        return $this;
    }

    /**
    * Getter de apellido
    *
    * Obtiene el valor del parámetro Apellido para el objeto
    * 
    * @return string apellido del objeto
    */
    public function getApellido()
    {
        return $this->_apellido;
    }

    /**
    * Setter de Dirección
    *
    * Establece un valor al parámetro Dirección
    * 
    * @param string $direccion valor que queremos darle a Dirección
    * @return el propio objeto
    */
    public function setDireccion($direccion)
    {
        $this->_direccion = (string) $direccion;
        return $this;
    }

    /**
    * Getter de Dirección
    *
    * Obtiene el valor del parámetro Dirección para el objeto
    * 
    * @return string Dirección del objeto
    */
    public function getDireccion()
    {
        return $this->_direccion;
    }

    /**
    * Setter de Email
    *
    * Establece un valor al parámetro Email
    * 
    * @param string $email valor que queremos darle a Email
    * @return el propio objeto
    */
    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }

    /**
    * Getter de Email
    *
    * Obtiene el valor del parámetro Email para el objeto
    * 
    * @return string Email del objeto
    */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
    * Setter de fecha de creación
    *
    * Establece un valor al parámetro Creado
    * 
    * @param string $fecha valor que queremos darle a Fecha de creación
    * @return el propio objeto
    */
    public function setCreado($creado)
    {
        $this->_creado = $creado;
        return $this;
    }

    /**
    * Getter de Fecha de creación
    *
    * Obtiene el valor del parámetro Fecha de creación para el objeto
    * 
    * @return string Fecha de creación del objeto
    */
    public function getCreated()
    {
        return $this->_created;
    }



     /**
    * Setter de telefonos
    *
    * Establece un listado de teléfonos
    * 
    * @param arr $telefonos valores que tendrán los teléfonos
    * @return el propio objeto
    */
    public function setTelefonos($telefonos)
    {
        $this->_telefonos = $telefonos;
        return $this;
    }

    /**
    * Getter de telefonos
    *
    * Obtiene el listado de telefonos del objeto
    * 
    * @return string lista de telefonos del objeto
    */
    public function getTelefonos()
    {
        return $this->_telefonos;
    }
    
}

?>