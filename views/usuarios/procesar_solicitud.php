<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../../includes/_db.php'); // Ajusta la ruta según la ubicación real de _db.php

if (isset($_POST['fecha'], $_POST['titulo'], $_POST['descripcion'], $_POST['dato'])) {
    // Recibir y sanitizar datos
    $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
    $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $dato = mysqli_real_escape_string($conexion, $_POST['dato']);

    // Insertar en la base de datos
    $consulta = "INSERT INTO solicitude (fecha, titulo, descripcion, dato) 
                 VALUES ('$fecha', '$titulo', '$descripcion', '$dato')";

    if (mysqli_query($conexion, $consulta)) {
        header("Location: solicitud_exitosa.php"); // Redireccionar si la inserción fue exitosa
        exit();
    } else {
        echo "Error al procesar la solicitud: " . mysqli_error($conexion);
    }
} else {
    echo "No se recibieron todos los datos necesarios.";
}
?>
