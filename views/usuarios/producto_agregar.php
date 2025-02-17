<!DOCTYPE html>
<html lang="es-MX">
<?php require '../../includes/_db.php' ?>
<?php require '../../includes/_header.php' ?>
<body>

<div class="container">
<div class="col-sm-6 offset-3 mt-5">
<form action="../../includes/_functions.php" method="POST" enctype="multipart/form-data">

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="nombre" class="form-label">Nombre *</label>
<input type="text" id="nombre" name="nombre" class="form-control" required>
</div>
</div>

<div class="col-sm-6">
<div class="mb-3">
<label for="descripcion" class="form-label">Descripcion *</label>
<input type="text" id="descripcion" name="descripcion" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="color" class="form-label">Color *</label>
<input type="text" id="color" name="color" class="form-control" required>
</div>
</div>

<div class="col-sm-6">
<div class="mb-3">
<label for="precio" class="form-label">Precio *</label>
<input type="number" id="precio" name="precio" class="form-control" required>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="mb-3">
<label for="cantidad" class="form-label">Cantidad *</label>
<input type="number" id="cantidad" name="cantidad" class="form-control" required>
</div>
</div>

<div class="col-sm-6">
<div class="mb-3">
<label for="cantidad" class="form-label">Cantidad mínima *</label>
<input type="number" id="cantidad_min" name="cantidad_min" class="form-control" required value="1">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="mb-3">
<label for="categorias" class="form-label">Categorias *</label>
<select name="categorias" id="categorias" class="form-control" required>
    <option value="electronico">Electronica</option>
    <option value="cocina">Cocina</option>
    <option value="jugueteria">Juguetería</option>
    <option value="vestimenta">Vestimenta</option>
    <option value="deportes">Deportes</option>
</select>
</div>
</div>
</div>
<div class="mb-3">
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <input type="file" class="form-control-file" name="foto" id="foto" required onchange="previewImage(event)">
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <img id="preview" src="" alt="Previsualización de la imagen" style="max-width: 100%; height: auto; display: none;">
        </div>
    </div>
</div>

<div class="mb-3">
<input type="hidden" name="accion" value="insertar_productos">
<button type="submit" class="btn btn-success">Guardar</button>
</div>
</form>
</div>
</div>

<script>
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<?php require '../../includes/_footer.php' ?>
</body>
</html>
