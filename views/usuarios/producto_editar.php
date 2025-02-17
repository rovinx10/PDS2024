<?php
$id = $_GET['id'];
require_once("../../includes/_db.php");
$consulta = "SELECT * FROM productos WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$productos = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es-MX">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>

<head>
    <style>
        .form-group img {
            max-width: 100px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="col-sm-6 offset-3 mt-5">
            <form action="../../includes/_functions.php" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre *</label>
                            <input type="text" id="nombre" name="nombre" value="<?php echo $productos['nombre']; ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción *</label>
                            <input type="text" id="descripcion" name="descripcion" value="<?php echo $productos['descripcion']; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="color" class="form-label">Color *</label>
                            <input type="text" id="color" name="color" value="<?php echo $productos['color']; ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio *</label>
                            <input type="number" id="precio" name="precio" value="<?php echo $productos['precio']; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad *</label>
                            <input type="number" id="cantidad" name="cantidad" value="<?php echo $productos['cantidad']; ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="cantidamin" class="form-label">Cantidad mínima *</label>
                            <input type="number" id="cantidamin" name="cantidamin" value="<?php echo $productos['cantidad_min']; ?>" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label for="categorias" class="form-label">Categorías *</label>
                            <select name="categorias" id="categorias" class="form-control" required>
                                <option value="electronico" <?php echo ($productos['categorias'] == 'electronico') ? 'selected' : ''; ?>>Electrónico</option>
                                <option value="cocina" <?php echo ($productos['categorias'] == 'cocina') ? 'selected' : ''; ?>>Cocina</option>
                                <option value="farmaceutico" <?php echo ($productos['categorias'] == 'farmaceutico') ? 'selected' : ''; ?>>Farmacéutico</option>
                                <option value="mascotas" <?php echo ($productos['categorias'] == 'mascotas') ? 'selected' : ''; ?>>Mascotas</option>
                                <option value="jugueteria" <?php echo ($productos['categorias'] == 'jugueteria') ? 'selected' : ''; ?>>Juguetería</option>
                                <option value="automovilstico" <?php echo ($productos['categorias'] == 'automovilstico') ? 'selected' : ''; ?>>Automovilístico</option>
                                <option value="vestimenta" <?php echo ($productos['categorias'] == 'vestimenta') ? 'selected' : ''; ?>>Vestimenta</option>
                                <option value="telefonia" <?php echo ($productos['categorias'] == 'telefonia') ? 'selected' : ''; ?>>Telefonía</option>
                                <option value="deportes" <?php echo ($productos['categorias'] == 'deportes') ? 'selected' : ''; ?>>Deportes</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control-file" name="foto" id="foto">
                                <?php if ($productos['imagen']) : ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($productos['imagen']); ?>" alt="Imagen actual">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="hidden" name="accion" value="editar_producto">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
<?php require '../../includes/_footer.php' ?>
</html>
