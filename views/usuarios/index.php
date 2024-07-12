<!DOCTYPE html>
<html lang="es-MX">
<?php require '../../includes/_db.php'; ?>
<?php require '../../includes/_header.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuento de Stock - Base de datos</title>
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

        .container {
            margin-top: 20px;
        }

        .chart-container {
            margin-bottom: 40px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .col-lg-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 15px;
            box-sizing: border-box;
        }

        #menorPrecioChart,
        #mayorPrecioChart {
            max-width: 400px;
            margin: 0 auto;
        }

        .btn-register {
            display: block;
            margin: 20px auto 0 auto;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            width: fit-content;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="icon-384x384.png" type="image/x-icon">
</head>

<body>
    <div id="content" class="container mt-5">
        <section>
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <center>
                        <h1>Recuento de Stock</h1>
                    </center>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 chart-container">
                        <h3>10 Productos con menor stock</h3>
                        <canvas id="menorStockChart" width="400" height="200"></canvas>
                    </div>
                    <div class="col-lg-6 chart-container">
                        <h3>10 Productos con mayor stock</h3>
                        <canvas id="mayorStockChart" width="400" height="200"></canvas>
                    </div>
                    <div class="col-lg-6 chart-container">
                        <h3>10 Productos más caros</h3>
                        <canvas id="mayorPrecioChart" width="400" height="200"></canvas>
                    </div>
                    <div class="col-lg-6 chart-container">
                        <h3>10 Productos más baratos</h3>
                        <canvas id="menorPrecioChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php require '../../includes/_footer.php'; ?>

    <script>
        $(document).ready(function () {
            // Datos de productos desde PHP
            <?php
            $sqlMenorStock = "SELECT nombre, cantidad FROM productos ORDER BY cantidad ASC LIMIT 10";
            $resultMenorStock = mysqli_query($conexion, $sqlMenorStock);
            $productosMenorStock = [];
            while ($row = mysqli_fetch_assoc($resultMenorStock)) {
                $productosMenorStock[] = $row;
            }

            $sqlMayorStock = "SELECT nombre, cantidad FROM productos ORDER BY cantidad DESC LIMIT 10";
            $resultMayorStock = mysqli_query($conexion, $sqlMayorStock);
            $productosMayorStock = [];
            while ($row = mysqli_fetch_assoc($resultMayorStock)) {
                $productosMayorStock[] = $row;
            }

            $sqlMayorPrecio = "SELECT nombre, precio FROM productos ORDER BY precio DESC LIMIT 10";
            $resultMayorPrecio = mysqli_query($conexion, $sqlMayorPrecio);
            $productosMayorPrecio = [];
            while ($row = mysqli_fetch_assoc($resultMayorPrecio)) {
                $productosMayorPrecio[] = $row;
            }

            $sqlMenorPrecio = "SELECT nombre, precio FROM productos ORDER BY precio ASC LIMIT 10";
            $resultMenorPrecio = mysqli_query($conexion, $sqlMenorPrecio);
            $productosMenorPrecio = [];
            while ($row = mysqli_fetch_assoc($resultMenorPrecio)) {
                $productosMenorPrecio[] = $row;
            }
            ?>

            // Preparación de datos para gráficos
            var nombresMenorStock = <?php echo json_encode(array_column($productosMenorStock, 'nombre')); ?>;
            var cantidadesMenorStock = <?php echo json_encode(array_column($productosMenorStock, 'cantidad')); ?>;

            var nombresMayorStock = <?php echo json_encode(array_column($productosMayorStock, 'nombre')); ?>;
            var cantidadesMayorStock = <?php echo json_encode(array_column($productosMayorStock, 'cantidad')); ?>;

            var nombresMayorPrecio = <?php echo json_encode(array_column($productosMayorPrecio, 'nombre')); ?>;
            var preciosMayorPrecio = <?php echo json_encode(array_column($productosMayorPrecio, 'precio')); ?>;

            var nombresMenorPrecio = <?php echo json_encode(array_column($productosMenorPrecio, 'nombre')); ?>;
            var preciosMenorPrecio = <?php echo json_encode(array_column($productosMenorPrecio, 'precio')); ?>;

            // Configuración de gráficos usando Chart.js
            var ctxMenorStock = document.getElementById('menorStockChart').getContext('2d');
            var menorStockChart = new Chart(ctxMenorStock, {
                type: 'bar',
                data: {
                    labels: nombresMenorStock,
                    datasets: [{
                        label: 'Cantidad',
                        data: cantidadesMenorStock,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var ctxMayorStock = document.getElementById('mayorStockChart').getContext('2d');
            var mayorStockChart = new Chart(ctxMayorStock, {
                type: 'bar',
                data: {
                    labels: nombresMayorStock,
                    datasets: [{
                        label: 'Cantidad',
                        data: cantidadesMayorStock,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var ctxMayorPrecio = document.getElementById('mayorPrecioChart').getContext('2d');
            var mayorPrecioChart = new Chart(ctxMayorPrecio, {
                type: 'bar',
                data: {
                    labels: nombresMayorPrecio,
                    datasets: [{
                        label: 'Precio',
                        data: preciosMayorPrecio,
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var ctxMenorPrecio = document.getElementById('menorPrecioChart').getContext('2d');
            var menorPrecioChart = new Chart(ctxMenorPrecio, {
                type: 'bar',
                data: {
                    labels: nombresMenorPrecio,
                    datasets: [{
                        label: 'Precio',
                        data: preciosMenorPrecio,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
