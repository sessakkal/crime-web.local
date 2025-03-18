<!-- /public/views/add_pelicula.php -->
<div class="container form-container">
    <h1 class="mb-4">Añadir Nueva Película</h1>

    <form action="/admin/add_pelicula.php" method="POST">
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
        <button type="submit" class="btn btn-primary">Añadir Película</button>
    </form>
</div>
