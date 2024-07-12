<?php
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Productos.csv');

$host = "localhost";
$user = "root";
$password = "";
$database = "tienda";

$conexion = new mysqli($host, $user, $password, $database);
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query = "SELECT id, nombre, descripcion, color, precio, cantidad, cantidad_min, categorias FROM productos";
$resultado = $conexion->query($query);

$salida = fopen('php://output', 'w');

fputcsv($salida, array('Codigo', 'Nombre', 'Descripcion', 'Color', 'Precio', 'Cantidad', 'Cantidad Minima', 'Categoria'));

while ($fila = $resultado->fetch_assoc()) {
    fputcsv($salida, $fila);
}

fclose($salida);
$conexion->close();
?>
