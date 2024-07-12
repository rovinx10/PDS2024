<!DOCTYPE html>
<html lang="en">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Sesión Actual</title>
    <style>
        .btn-register {
            display: block;
            margin: 20px auto;
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

<div id="content">
    <section>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <center><h1>Información de Sesión Actual</h1></center>
                </div>
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT nombre, password, telefono, correo, registro FROM user WHERE correo ='$actualsesion'";
                                $usuarios = mysqli_query($conexion, $sql);
                                if($usuarios -> num_rows > 0){
                                    foreach($usuarios as $key => $row){
                                ?>
                                <tr>
                                    <td><?php echo $row['nombre']; ?></td>
                                    <td><?php echo $row['telefono']; ?></td>
                                    <td><?php echo $row['correo']; ?></td>
                                    <td id="form-password" style="display: none;"><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['registro']; ?></td>
                                </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                <tr class="text-center">
                                    <td colspan="6">No existen registros</td>
                                </tr>
                                <?php
                                }
                                ?>
                               
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require '../../includes/_footer.php' ?>

<script>
    function onSubmit(token) {
        document.getElementById("form-password").style.display = "block";
        document.getElementById("captcha-container").style.display = "none";
    }
</script>

</body>

</html>
