<?php

require ("FUNCIONES\consultas.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO</title>
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

<div class="container" styles="   background-color: #005866;">
 <h3> <i>Bienvenido/a, <?php echo htmlspecialchars($_SESSION['nombreProfesor']); ?></i></h3>   
 <style>
        h4 {margin-top: 20px;} ></style>
        
<h4>Selecciona el instituto:</h4>
    <form action="obtener_lista_alumnos.php" method="POST">
        <select name="instituto" id="instituto" required>
            <option value="">Selecciona un instituto</option>
            <?php while ($instituto = $result_institutos->fetch_assoc()) : ?>
                <option value="<?php echo $instituto['idInstituto']; ?>">
                    <?php echo htmlspecialchars($instituto['nombre']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <h2>Selecciona la materia:</h2>
        <select name="materia" id="materia" required>
            <option value="">Selecciona una materia</option>
            <?php while ($materia = $result_materias->fetch_assoc()) : ?>
                <option value="<?php echo $materia['numeroMateria']; ?>">
                    <?php echo htmlspecialchars($materia['materia']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit" name="btn"><strong>Obtener lista de alumnos</button>
    </form>
            </div>
</body>
</html>

<?php
// Cerrar conexiones
$stmt_institutos->close();
$stmt_materias->close();
$conexion->close();
?>
