
<?php
require ("conexionBD.php");
session_start();

// Verificar si el profesor ha iniciado sesión
if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "db_participo", 3306);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el id del profesor de la sesión
$idProfesor = $_SESSION['idProfesor'];

/* Obtener los institutos asociados al profesor
$sql_institutos = "SELECT i.idInstituto, i.nombre FROM profesor_instituto pi 
                   JOIN institutos i ON pi.idInstituto = i.idInstituto
                   WHERE pi.idProfesor = ?";
$stmt_institutos = $conexion->prepare($sql_institutos);
$stmt_institutos->bind_param("i", $idProfesor);
$stmt_institutos->execute();
$result_institutos = $stmt_institutos->get_result();

// Obtener las materias asociadas al profesor
$sql_materias = "SELECT m.numeroMateria, m.materia FROM materias m 
                 WHERE m.idProfesor = ?";
$stmt_materias = $conexion->prepare($sql_materias);
$stmt_materias->bind_param("i", $idProfesor);
$stmt_materias->execute();
$result_materias = $stmt_materias->get_result();
*/
?>