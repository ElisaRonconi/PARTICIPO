<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARTICIPO</title>
    <link rel="stylesheet" href="styles/login.css">
    <link rel="shortcut icon" href="IMG/logo.png" />

</head>
<body>
    <header>
        <img src="IMG/logo.png" alt="Logo" class="logo-header">
        <div id="logo1"><h1 >PARTICIPO</h1> </div>
        <div id="logo2"> <h2 >Sistema de Asistencias</h2></div>
    </header>
    <div class="login-content"> 
        <form method="post" action="">
        <img src="IMG/logo.png" alt="Logo" class="logo">
        <h2 class="title">Bienvenido</h2>
        <?php
        include("conexionBD.php");
        include("controlador.php");
        ?>
        <div class="divUs">
            <div class="i">
                <i class="fas fa-user"></i>
            </div>
            <div class="div">
                <h5>Usuario</h5>
                <input id="usuario" type="text" class="input" name="usuario">
            </div>
        </div>

        <div class="divPass">
            <div class="i">
                <i class="fas fa-user"></i>
            </div>
            <div class="div">
                <h5>Contraseña</h5>
                <input id="input" type="password" class="input" name="password">
            </div>
        </div>
        <div class="view">
            <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
        </div>

         <div class="text-center">
        <a class="font-italic" href=""> Olvide mi contraseña </a>    
        </div>
        <input name="btningresar" class="btn" type="submit" value="INICIAR SESIÓN">
        
        </form>
    </div>

</body>
</html>