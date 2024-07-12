<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php'; ?>
<?php require '../../includes/_header.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <style>
        .problema {
            background-color: #F78E8E;
            color: #000000;
        }
    </style>
</head>

<body>
    <div id="content">
        <section>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <center><h1>Productos</h1></center>
                        <a href="producto_agregar.php"><input class="btn btn-primary" type="button" value="Agregar producto"></a>
                    </div>
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table id="productosTable" class="table table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th> <!-- Columna ID invisible -->
                                        <th style="display: none;">Código</th> <!-- Columna Código invisible -->
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Color</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th style="display: none;">Cantidad mínima</th> <!-- Columna Cantidad mínima invisible -->
                                        <th>Categorías</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $categoria = $_GET['categoria'];
                                    $sql = "SELECT * FROM productos WHERE categorias = '$categoria'";
                                    $productos = mysqli_query($conexion, $sql);
                                    if ($productos->num_rows > 0) {
                                        foreach ($productos as $key => $row) {
                                            if ($row['cantidad'] <= $row['cantidad_min']) {
                                                $color = '#F78E8E';
                                                $clase = 'problema';
                                            } else {
                                                $clase = 'correcto';
                                            }
                                    ?>
                                            <tr>
                                                <td style="display: none;"><?php echo $row['id']; ?></td>
                                                <td style="display: none;"><?php echo $row['codigo']; ?></td>
                                                <td><?php echo $row['nombre']; ?></td>
                                                <td><?php echo $row['descripcion']; ?></td>
                                                <td><?php echo $row['color']; ?></td>
                                                <td><?php echo $row['precio']; ?></td>
                                                <td class="<?php echo $clase; ?>"><?php echo $row['cantidad']; ?></td>
                                                <td style="display: none;"><?php echo $row['cantidad_min']; ?></td>
                                                <td><?php echo $row['categorias']; ?></td>
                                                <td><img width="100" src="data:image;base64,<?php echo base64_encode($row['imagen']); ?>" alt="Imagen de producto"></td>
                                                <td>
                                                    <a href="producto_editar.php?id=<?php echo $row['id'] ?>">Editar</a> |
                                                    <a href="producto_eliminar.php?id=<?php echo $row['id'] ?>">Eliminar</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                    ?>
                                        <tr class="text-center">
                                            <td colspan="11">No existen registros</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php require '../../includes/_footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#productosTable').DataTable({
                "paging": true, // Activar paginación
                "lengthMenu": [10, 25, 50, 75, 100], // Opciones de cantidad de filas por página
                "ordering": true, // Permitir ordenamiento en todas las columnas
                "info": true, // Mostrar información de la tabla (por ejemplo, "Mostrando 1 a 10 de 100 registros")
                "searching": true // Permitir búsqueda dentro de la tabla
            });
        });
    </script>
</body>

</html>
