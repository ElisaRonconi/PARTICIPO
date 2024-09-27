<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta</title>
    <link rel="stylesheet" href="styles/alta.css">
    <link rel="shortcut icon" href="IMG/logo.png" />
</head>
<body>
<header>
    <img src="IMG/logo.png" alt="Logo" class="logo-header">
    <div id="logo1"><h1>PARTICIPO</h1></div>
    <div id="logo2"><h2>Sistema de Asistencias</h2></div>
</header>

<nav class="navMenu">
    <a href="#">Inicio</a>
    <a href="alta.php">Altas</a>
    <a href="#">Asistencias</a>
    <a href="#">Registros</a>
    <a href="#">Calendario</a>
    <div class="animation start-home"></div>
</nav>

    
<div class="login-content"> 
        <h2>Alta de Alumno</h2>
        <form action="alta_alumno.php" method="POST">
<div class="formulario">

  <label for="Usuario">Usuario:</label>
  <input type="usuario" id="usuario" name="usuario" required><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br>

  <label for="clave">Contraseña:</label>
  <input type="password" id="clave" name="clave" required><br>

  <label for="institucion">Institución:</label>
  <select id="institucion" name="institucion">
    <!-- Opciones de instituciones desde la base de datos -->
  </select><br>

  <label for="materia">Materia:</label>
  <select id="materia" name="materia">
    <!-- Opciones de materias desde la base de datos -->
  </select><br>

  <input type="submit" value="Registrar Alumno">
</form>
</div>
    </div>
</body>
</html>