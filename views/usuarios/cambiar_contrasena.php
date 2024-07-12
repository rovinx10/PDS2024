<?php
require_once("../_db.php");

if (isset($_POST['accion']) && $_POST['accion'] == 'cambiar_contrasena') {
    // Obtener datos del formulario
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conexion, $_POST['confirm_password']);

    // Validar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        die("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
    }

    // Encriptar la nueva contraseña (ejemplo básico, usar métodos más seguros en producción)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $sql = "UPDATE user SET password = '$hashed_password' WHERE correo = '$correo'";

    if (mysqli_query($conexion, $sql)) {
        // Contraseña cambiada correctamente
        echo "Contraseña cambiada exitosamente.";
    } else {
        // Error al cambiar la contraseña
        echo "Error al cambiar la contraseña: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>




<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña</title>
    <link rel="stylesheet" href="../../css/login.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <form action="cambiar_contrasena.php" method="POST">
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center">Cambio de Contraseña</h3>
                                <div class="form-group">
                                    <label for="correo">Correo Electrónico</label><br>
                                    <input type="email" name="correo" id="correo" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Nueva Contraseña</label><br>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirmar Nueva Contraseña</label><br>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                                    <input type="hidden" name="accion" value="cambiar_contrasena">
                                </div>
                                <div class="mb-3">
                                    <input type="submit" name="cambiar" class="btn btn-primary" value="CAMBIAR CONTRASEÑA">
                                    <a href="login.php" class="btn btn-secondary">REGRESAR</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
