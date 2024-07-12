<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../../includes/_db.php'; ?>
    <?php require '../../includes/_header.php'; ?>
    <title>Categorías de Productos</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center my-3"> <!-- Alineación centrada -->
            <div class="col-sm-4">
                <a class="catelectronico" href="productosCategoria.php?categoria=electronico">Electrónica</a>
            </div>
            <div class="col-sm-4">
                <a class="catcocina" href="productosCategoria.php?categoria=cocina">Cocina</a>
            </div>
            <div class="col-sm-4">
                <a class="catjugueteria" href="productosCategoria.php?categoria=jugueteria">Juguetería</a>
            </div>
        </div>
        <div class="row justify-content-center my-3"> <!-- Alineación centrada -->
            <div class="col-sm-4">
                <a class="catvestimenta" href="productosCategoria.php?categoria=vestimenta">Vestimenta</a>
            </div>
            <div class="col-sm-4">
                <a class="catdeportes" href="productosCategoria.php?categoria=deportes">Deportes</a>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-sm-12 text-center">
                <input class="btn btn-secondary" type="button" value="Más categorías próximamente">
            </div>
        </div>
    </div>
    <?php require '../../includes/_footer.php'; ?>
</body>
</html>
