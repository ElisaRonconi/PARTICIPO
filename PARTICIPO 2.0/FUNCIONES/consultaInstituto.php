<?php
session_start();
$idProfesor = $_SESSION['idProfesor'];

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "db_participo", 3306);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar los institutos relacionados al profesor
$consulta_institutos = $conexion->prepare("
    SELECT i.idInstituto, i.nombre 
    FROM institutos i
    JOIN profesor_instituto pi ON i.idInstituto = pi.idInstituto
    WHERE pi.idProfesor = ?
");
$consulta_institutos->bind_param("i", $idProfesor);
$consulta_institutos->execute();
$resultado_institutos = $consulta_institutos->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['seleccionarInstituto'])) {
    $idInstituto = $_POST['idInstituto'];

    // Consultar materias del instituto seleccionado
    $consulta_materias = $conexion->prepare("
        SELECT m.numeroMateria, m.materia 
        FROM materias m
        JOIN alumno_materia am ON m.numeroMateria = am.numeroMateria
        WHERE am.idInstituto = ?
    ");
    $consulta_materias->bind_param("i", $idInstituto);
    $consulta_materias->execute();
    $resultado_materias = $consulta_materias->get_result();
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['obtenerAlumnos'])) {
        $numeroMateria = $_POST['numeroMateria'];
        $idInstituto = $_POST['idInstituto'];
        $fecha = $_POST['fecha'];
    
        // Consultar alumnos de la materia y el instituto seleccionados
        $consulta_alumnos = $conexion->prepare("
            SELECT a.idAlumno, a.nombre, a.apellido 
            FROM alumnos a
            JOIN alumno_materia am ON a.idAlumno = am.idAlumno
            WHERE am.numeroMateria = ? AND a.idInstituto = ?
        ");
        $consulta_alumnos->bind_param("ii", $numeroMateria, $idInstituto);
        $consulta_alumnos->execute();
        $resultado_alumnos = $consulta_alumnos->get_result();
    
    }
?>



