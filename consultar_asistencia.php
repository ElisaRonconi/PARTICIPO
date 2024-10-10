 <?php
// Iniciar la sesión si no está activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

 //Verificar si el profesor ha iniciado sesión
if (!isset($_SESSION['idProfesor'])) {
    header("Location: login.php");
    exit();
}

 //Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "db_participo", 3306);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

 //Obtener la fecha y la materia seleccionadas del formulario
$fecha = $_POST['fecha'];
$idMateria = $_POST['materia'];

 //Realizar la consulta para obtener la lista de alumnos y sus asistencias en la fecha seleccionada
$consulta = $conexion->prepare('SELECT a.idAlumno, a.nombre, a.apellido, asis.fecha FROM alumnos a JOIN asistencias asis ON a.idAlumno = asis.idAlumno WHERE asis.idMateria = ? AND asis.fecha = ?');
$consulta->bind_param("is", $idMateria, $fecha); // "i" para idMateria (entero), "s" para fecha (cadena)
$consulta->execute();
$resultado = $consulta->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Asistencias</title>
    <link rel="stylesheet" href="styles/inicio.css">
</head>
<body>
    <header>
        <h1>Consultar Asistencias</h1>
    </header>
    
    <form action="consultar_asistencia.php" method="POST">
        <!-- Aquí iría un formulario con la selección de fecha y materia -->
        <input type="date" name="fecha" required>
        <select name="materia" required>
            <!-- Opciones de materias, probablemente generadas dinámicamente -->
        </select>
        <button type="submit">Consultar</button>
    </form>

    <?php if ($resultado->num_rows > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($fila['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron asistencias para la fecha y materia seleccionadas.</p>
    <?php endif; ?>

</body>
</html>

<?php
// Cerrar la consulta y la conexión a la base de datos
$consulta->close();
$conexion->close();
?>

<?php
$stmt_materias->close();
$conexion->close();
?>



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
$fecha = $_POST['fecha'];
$idMateria = $_POST['materia'];

// Obtener la lista de alumnos con su asistencia en esa fecha y materia
$sql_asistencia = "SELECT a.idAlumno, a.nombre, a.apellido, 
                          CASE WHEN asis.idAsistencia IS NOT NULL THEN 'Presente' ELSE 'Ausente' END AS estado_asistencia
                   FROM alumnos a
                   LEFT JOIN asistencia asis ON a.idAlumno = asis.idAlumno AND asis.fecha = ? AND asis.idMateria = ?
                   JOIN alumno_materia am ON a.idAlumno = am.idAlumno
                   WHERE am.numeroMateria = ?";
$stmt_asistencia = $conexion->prepare($sql_asistencia);
$stmt_asistencia->bind_param("sii", $fecha, $idMateria, $idMateria);
$stmt_asistencia->execute();
$result_asistencia = $stmt_asistencia->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Asistencia</title>
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
    <a href="listado.php">Asistencias</a>
    <a href="resistro_alumno.php">Registros</a>
    <a href="#">Calendario</a>
    <div class="animation start-home"></div>
</nav>

<div class="container">
    <h1>Asistencia para la fecha: <?php echo htmlspecialchars($fecha); ?></h1>

    <?php if ($result_asistencia->num_rows > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>Apellido</th>
                    <th>Estado de Asistencia</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $result_asistencia->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($fila['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($fila['estado_asistencia']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay registros de asistencia para la fecha seleccionada.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
// Cerrar conexiones
$stmt_asistencia->close();
$conexion->close();
?>
