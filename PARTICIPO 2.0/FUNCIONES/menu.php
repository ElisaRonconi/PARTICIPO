<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio - PARTICIPO</title>
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>


   <!-- Topbar Start -->
     <div class="row">
      <a>'</a>
     </div>
       
    <!-- Topbar End -->
    <header>
        <div class="container">
            <img src="IMG/participoL.png" alt="Logo" class="logo-header">
            <div class="logo">PARTICIPO </div>
            <nav>
                <ul class="navMenu">
                    <li class="active"><a href="index.php" class="nav-item nav-link" active>Inicio</a></li>
                    <li><a href="asistencia.php"class="nav-item nav-link">Asistencias</a></li>
                    <li><a href="notas.php"class="nav-item nav-link">Notas</a></li>
                    <li class="dropdown">
                        <a href="registros.php"class="nav-item nav-link">Registros <small>▼</small></a>
                        <ul class="dropdown-menu">
                            <li><a href=listado_alumnos.php>Registro de Alumnos</a></li>
                            <li><a href=registroAsistencia.php>Registro de Asistencias</a></li>
                            <li><a href="INSTITUTOS\listado_institutos.php">Registro de Institutos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#"class="nav-item nav-link">Altas <small>▼</small></a>
                        <ul class="dropdown-menu">
                            <li><a href="altaAlumno.php" class="dropdown-item">Alta de Alumnos</a></li>
                            <li><a href="INSTITUTOS\altaInstituto.php" class="dropdown-item">Alta de Instituto</a></li>
                            <li><a href="altaMateria.php" class="dropdown-item">Alta de Materia</a></li>
                
                        </ul>
                    </li>
                    <li><a href="#">Calendario</a></li>
                    <li> <a href="cerrarSesion.php" class="logout-icon" title="Cerrar Sesión">
                        <img src="IMG\logout.png" alt="Cerrar Sesión" style="width: 20px; height: 20px;">
                         </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>