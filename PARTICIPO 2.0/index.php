
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

    <?php require("FUNCIONES/menu.php"); 
    ?>
 

  <section class="welcome-section">
    <div class="welcome-text">
      <?php require("FUNCIONES/consultas.php"); ?>
      <h2><?php echo htmlspecialchars($_SESSION['nombreProfesor']); ?></h2>
      <h1>¡Bienvenido!</h1>
      <button onclick="window.location.href='asistencia.php';">Tomar Asistencia</button>
    </div>
  </section>

  <div class="copyright">
    <p class="m-0 text-white-50">Copyright &copy; <a href="#">ERonconi</a>. All Rights Reserved.</p>
  </div>

  <?php $conexion->close(); ?>
</body>
</html>
