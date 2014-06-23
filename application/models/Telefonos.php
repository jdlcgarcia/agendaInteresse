<?php 
/**
 * Modelo para Telefonos
 *
 * @package    Agenda
 * @subpackage Telefonos
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Juan de la Cruz García García <jcruzgar@gmail.com>
 */
class Application_Model_Telefonos
{
    protected $_id;
    protected $_tipo;
    protected $_numero;

    /**
    * Construye la lista de telefonos
    *
    * Comprueba si hay opciones definidas y construye la lista según estas o una por defecto.
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
            throw new Exception('Método de telefono no válido');
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
            throw new Exception('Método de telefono no válido');
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
    * Setter de tipo
    *
    * Establece un valor al parámetro Tipo
    * 
    * @param string $tipo valor que queremos darle a Tipo
    * @return el propio objeto
    */
    public function setTipo($tipo)
    {
        $this->_tipo = (string) $tipo;
        return $this;
    }

    /**
    * Getter de tipo
    *
    * Obtiene el valor del parámetro Tipo para el objeto
    * 
    * @return string tipo del objeto
    */
    public function getTipo()
    {
        return $this->_tipo;
    }

    /**
    * Setter de número
    *
    * Establece un valor al parámetro Número
    * 
    * @param string $número valor que queremos darle a Número
    * @return el propio objeto
    */
    public function setNumero($numero)
    {
        $this->_numero = (string) $numero;
        return $this;
    }

    /**
    * Getter de número
    *
    * Obtiene el valor del parámetro número para el objeto
    * 
    * @return string número del objeto
    */
    public function getNumero()
    {
        return $this->_numero;
    }
}

?>