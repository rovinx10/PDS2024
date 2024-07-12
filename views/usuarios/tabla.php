<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php'; ?>
<?php require '../../includes/_header.php'; ?>

<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f6fc;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .container {
            margin-top: 20px;
        }

        .table {
            background-color: #fff;
            border-collapse: collapse;
            width: 100%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #007bff;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #e2e6ea;
        }

        .acciones a {
            text-decoration: none;
            color: #007bff;
        }

        .acciones a:hover {
            text-decoration: underline;
        }

        .problema {
            background-color: #F78E8E;
            color: #000000;
        }

        /* Estilo para ocultar la columna de código */
        .codigo-columna {
            display: none; /* Oculta la columna */
        }

        /* Estilo para ocultar la columna de cantidad mínima */
        .cantidad-minima-columna {
            display: none; /* Oculta la columna */
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link rel="icon" href="icon-384x384.png" type="image/x-icon">
</head>

<body>
    <div id="content" class="container mt-5">
        <section>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <center><h1>Productos</h1></center>
                    <a href="producto_agregar.php" class="btn btn-primary">Agregar Producto</a>
                    <a href="exportar.php" class="btn btn-primary">Exportar Productos</a>
                </div>
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table id="productosTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="codigo-columna">Codigo</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Color</th>
                                    <th>Precio ($)</th>
                                    <th>Cantidad</th>
                                    <th class="cantidad-minima-columna">Cantidad minima</th>
                                    <th>Categorias</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM productos";
                                $productos = mysqli_query($conexion, $sql);
                                if ($productos->num_rows > 0) {
                                    foreach ($productos as $key => $row) {
                                        $clase = $row['cantidad'] <= $row['cantidad_min'] ? 'problema' : 'correcto';
                                ?>
                                        <tr class="<?php echo $clase; ?>">
                                            <td class="codigo-columna"><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['nombre']; ?></td>
                                            <td><?php echo $row['descripcion']; ?></td>
                                            <td><?php echo $row['color']; ?></td>
                                            <td><?php echo '$ ' . $row['precio']; ?></td>
                                            <td><?php echo $row['cantidad']; ?></td>
                                            <td class="cantidad-minima-columna"><?php echo $row['cantidad_min']; ?></td>
                                            <td><?php echo $row['categorias']; ?></td>
                                            <td><img width="100" src="data:image;base64,<?php echo base64_encode($row['imagen']); ?>"></td>
                                            <td class="acciones">
                                                <a href="producto_editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                                                <a>|</a>
                                                <a href="producto_eliminar.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr class="text-center">
                                        <td colspan="10">No existen registros</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <!-- Contenido adicional si es necesario -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require '../../includes/_footer.php'; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#productosTable').DataTable();
        });
    </script>
</body>

</html>
