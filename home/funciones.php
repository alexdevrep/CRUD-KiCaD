<?php
//Datos necesarios para poder conectarnos a mySQL
$password='root';
$user='root';
$direccion="127.0.0.1";

//Creamos la conexion con la base de datos
$conexion= new mysqli($direccion,$user,$password);
if ($conexion->connect_error){
    die("Conexión fallida: ".$conexion->connect_error);
}
echo "Conectado correctamente";
//Función para crear la base de datos
function new_db($db){
    global $conexion;
    $sql= "CREATE DATABASE ".$db;
    if ($conexion->query($sql) === TRUE) {
        echo "Base de datos creada exitosamente";
    } else {
        echo "Error al crear la base de datos: " . $conexion->error;
    }


}

//Borramos una base de datos existente
function delete_db($delete_db){
    global $conexion;
    $sql= "DROP DATABASE ".$delete_db;
    if ($conexion->query($sql) === TRUE) {
        echo "Base de datos borrada exitosamente";
    } else {
        echo "Error al borrar la base de datos: " . $conexion->error;
    }
}


//Nos conectamos a una base de datos
function conectarBaseDatos() {
    global $direccion, $db, $user, $password;
    try {
        $dsn = "mysql:host=$direccion;dbname=$db;charset=utf8";
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "<h1>Error de conexión:</h1> <p>" . $e->getMessage() . "</p>";
        exit;
    }
}

//Creamos la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = $_POST['database'] ?? null;
    $delete_db = $_POST['delete'] ?? null;

    if ($db) {
        new_db($db);
    }

    if ($delete_db) {
        delete_db($delete_db);
    }
}
?>