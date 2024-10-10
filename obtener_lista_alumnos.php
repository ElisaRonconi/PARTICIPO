<?php
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

// Obtener los valores seleccionados
$idInstituto = $_POST['instituto'];
$idMateria = $_POST['materia'];

// Obtener la lista de alumnos que cursan esa materia en ese instituto
$sql_alumnos = "SELECT a.idAlumno, a.nombre, a.apellido FROM alumnos a
                JOIN alumno_materia am ON a.idAlumno = am.idAlumno
                JOIN materias m ON am.numeroMateria = m.numeroMateria
                WHERE m.idInstituto = ? AND m.numeroMateria = ?";
$stmt_alumnos = $conexion->prepare($sql_alumnos);
$stmt_alumnos->bind_param("ii", $idInstituto, $idMateria);
$stmt_alumnos->execute();
$result_alumnos = $stmt_alumnos->get_result();
?>

    
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alumnos</title>
	<link rel="stylesheet" href="styles/inicio.css">
    <link rel="shortcut icon" href="IMG/logo.png" />
</head>
<body>
<header>
    <img src="IMG/logo.png" alt="Logo" class="logo-header">
    <div id="logo1"><h1>PARTICIPO</h1></div>
    <div id="logo2"><h2>Sistema de Asistencias</h2></div>
</header>

<nav class="navMenu">
    <a href="inicio.php">Inicio</a>
    <a href="alta_alumno.php">Altas</a>
    <a href="consultar_asistencia.php">Asistencias</a>
    <a href="resistro_alumno.php">Registros</a>
    <a href="#">Calendario</a>
    <div class="animation start-home"></div>
</nav>
<div class="container">
    <h1>Lista de Alumnos de la Materia</h1>
    
    <?php if ($result_alumnos->num_rows > 0): ?>
        <form action="tomar_asistencia.php" method="POST">
            <table border="1">
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Apellido</th>
                        <th>Asistencia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($alumno = $result_alumnos->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($alumno['apellido']); ?></td>
                            <td>
                                <!-- Usamos checkbox para marcar si el alumno asistió -->
                                <input type="checkbox" name="asistencia[<?php echo $alumno['idAlumno']; ?>]" value="1">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Guardar el id de la materia y del instituto para procesar la asistencia -->
            <input type="hidden" name="idMateria" value="<?php echo htmlspecialchars($idMateria); ?>">
            <input type="hidden" name="idInstituto" value="<?php echo htmlspecialchars($idInstituto); ?>">

            <button type="submit">Tomar asistencia</button>
        </form>
    <?php else: ?>
        <style>
        p {color:#239eb1; text-align:center; position: relative;  margin-left: 20px; margin-top: 20px; font-size: 20px; font-weight: bold;} ></style>
        <p  > No hay alumnos inscritos en esta materia. <br><br>  Verificar la correcta selección de Instituto </p>
    <?php endif; ?>
    </div>
</body>
</html>

<?php
// Cerrar conexiones
$stmt_alumnos->close();
$conexion->close();
?>