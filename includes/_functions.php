<?php

require_once("_db.php");

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'eliminar_producto':
            eliminar_producto();
            break;
        case 'editar_producto':
            editar_producto();
            break;
        case 'insertar_productos':
            insertar_productos();
            break;
    }
}

function insertar_productos()
{
    global $conexion;
    extract($_POST);

    // Variables donde se almacenan los valores de nuestra imagen
    $tamanoArchvio = $_FILES['foto']['size'];

    // Se realiza la lectura de la imagen
    $imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
    $binariosImagen = fread($imagenSubida, $tamanoArchvio);
    // Se realiza la consulta correspondiente para guardar los datos

    $imagenFin = mysqli_escape_string($conexion, $binariosImagen);

    $consulta = "INSERT INTO productos (nombre, descripcion, color, precio, cantidad, cantidad_min, categorias, imagen)
    VALUES ('$nombre', '$descripcion', '$color', $precio, $cantidad, $cantidad_min, '$categorias', '$imagenFin');";

    mysqli_query($conexion, $consulta);

    header("Location: ../views/usuarios/");
}

function editar_producto()
{
    global $conexion;
    extract($_POST);

    if ($_FILES['foto']['size'] > 0) {
        // Variables donde se almacenan los valores de nuestra imagen
        $tamanoArchvio = $_FILES['foto']['size'];

        // Se realiza la lectura de la imagen
        $imagenSubida = fopen($_FILES['foto']['tmp_name'], 'r');
        $binariosImagen = fread($imagenSubida, $tamanoArchvio);
        $imagenFin = mysqli_escape_string($conexion, $binariosImagen);

        $consulta = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', color = '$color', precio = '$precio', cantidad = '$cantidad', cantidad_min = '$cantidadmin', categorias = '$categorias', imagen = '$imagenFin' WHERE id = $id";
    } else {
        $consulta = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', color = '$color', precio = '$precio', cantidad = '$cantidad', cantidad_min = '$cantidadmin', categorias = '$categorias' WHERE id = $id";
    }

    mysqli_query($conexion, $consulta);
    header("Location: ../views/usuarios/");
}

function eliminar_producto()
{
    global $conexion;
    extract($_POST);
    $id = $_POST['id'];
    $consulta = "DELETE FROM productos WHERE id = $id";
    mysqli_query($conexion, $consulta);
    header("Location: ../views/usuarios/");
}
?>
