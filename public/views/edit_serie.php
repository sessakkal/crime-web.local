<!-- /public/views/edit_serie.php -->
<div class="container form-container">
    <h1 class="mb-4">Editar Serie</h1>

    <form action="/admin/edit_serie.php" method="POST">
        <div class="mb-3">
            <label for="serie_id" class="form-label">ID de la Serie</label>
            <input type="number" class="form-control" id="serie_id" name="serie_id" required>
        </div>
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="mb-3">
            <label for="imagen_url" class="form-label">URL de Imagen</label>
            <input type="text" class="form-control" id="imagen_url" name="imagen_url" required>
        </div>
        <button type="submit" class="btn btn-primary">Editar Serie</button>
    </form>
</div>
