<?php
$_SESSION['count']=0;
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if (isset($_SESSION['count'])) {
    $_SESSION['count']++;
    }
    else {
    $_SESSION['count']=0;
    }
    session_start();
    $valor = $_GET['valor'];
    $dia = $_GET['dia'];
    $mes = $_GET['mes'];
    $mensualidad= $_GET['mensualidad'];
    $salario = $_GET['salario_base'];
    // Obtener la hora actual
    date_default_timezone_set('Europe/Madrid'); // Reemplaza "tu_zona_horaria" con la zona horaria deseada
    $fechaHoraActual = date('Y-m-d H:i:s');

    // Abrir el archivo de registro en modo "append" (agregar al final)
    $archivo = fopen("registro.txt", "a");

    // Escribir la fecha y hora en el archivo
    fwrite($archivo, $fechaHoraActual ." " .$_SESSION['count']."\n");

    // Cerrar el archivo
    fclose($archivo);
    $session=$_SESSION['id'];
    
}
$servername = "localhost";
$username = "id20296615_willy";
$password = "Gui@lle2005";
$dbname = "id20296615_1smr";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO 1smr (mensualidad, valor, dia , mes, salario_base, fecha)
    VALUES ('$mensualidad', '$valor', '$dia', '$mes', '$salario', '$fechaHoraActual')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>