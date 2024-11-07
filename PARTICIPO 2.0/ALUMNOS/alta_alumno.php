<?php
include 'conexionBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $fechaNacimiento = !empty($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : null;
    $dni = !empty($_POST['dni']) ? $_POST['dni'] : null;
    $idInstituto = $_POST['instituto'];
    $numeroMateria = $_POST['materia'];

    try {
        // Iniciar una transacción
        $pdo->beginTransaction();

        // Insertar en la tabla alumno
        $stmt = $pdo->prepare("INSERT INTO alumnos (nombre, apellido, email, fechaNacimiento, dni) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellido, $email, $fechaNacimiento, $dni]);

        // Obtener el ID del alumno recién insertado
        $idAlumno = $pdo->lastInsertId();

        // Insertar en la tabla alumno_materia para asociar el alumno con la materia
        $stmt = $pdo->prepare("INSERT INTO alumno_materia (idAlumno, numeroMateria) VALUES (?, ?)");
        $stmt->execute([$idAlumno, $numeroMateria]);

        // Finalizar la transacción
        $pdo->commit();

        echo "Alumno dado de alta con éxito.";
    } catch (Exception $e) {
        // Si ocurre algún error, revertir la transacción
        $pdo->rollBack();
        echo "Error al dar de alta el alumno: " . $e->getMessage();
    }
}
?>
