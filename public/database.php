<?php 
$db = new mysqli('db523356312.db.1and1.com', 'dbo523356312', '4dm1np4ssw0rd', 'db523356312');

$sql  = "CREATE PROCEDURE CrearTelefono(IN i1 INT, IN i2 VARCHAR(8), IN i3 VARCHAR(16)) BEGIN \n";
$sql .= "INSERT INTO telefonos (id,tipo,numero) VALUES (i1,i2,i3);\n";
$sql .= "END\n";

if(!$result = $db->query($sql)){
    die('There was an error running the query [' . $db->error . ']');
}
?>