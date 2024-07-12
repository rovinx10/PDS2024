<!DOCTYPE html>
<html lang="es">
<?php require '../../includes/_header.php'; ?>
<?php require '../../includes/_db.php'; // Ajusta la ruta según la ubicación real de _db.php ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Solicitudes</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <style>
        .container {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Formulario de Solicitudes</h1>
                <form action="procesar_solicitud.php" method="POST">
                    <div class="form-group">
                        <label for="fecha">Fecha de Recordatorio:</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="dato">Dato Adicional:</label>
                        <input type="text" id="dato" name="dato" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-submit">Enviar Solicitud</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <h2>Solicitudes Registradas</h2>
                <table id="solicitudesTable" class="display">
                    <thead>
                        <tr>
                            <th style="display: none;">ID</th>
                            <th>Fecha</th>
                            <th>Titulo</th>
                            <th>Descripción</th>
                            <th>Dato Adicional</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta para obtener las solicitudes
                        $consulta = "SELECT * FROM solicitude";
                        $resultado = mysqli_query($conexion, $consulta);

                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>{$fila['id']}</td>";
                            echo "<td>{$fila['fecha_solicitud']}</td>";
                            echo "<td>{$fila['titulo']}</td>";
                            echo "<td>{$fila['descripcion']}</td>";
                            echo "<td>{$fila['dato']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require '../../includes/_footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#solicitudesTable').DataTable();
        });
    </script>
</body>

</html>
