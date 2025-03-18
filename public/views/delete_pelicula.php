<!-- /public/views/delete_pelicula.php -->
<div class="container form-container">
    <h1 class="mb-4">Eliminar Película</h1>

    <form action="/admin/delete_pelicula.php" method="POST">
        <div class="mb-3">
            <label for="pelicula_id" class="form-label">ID de la Película</label>
            <input type="number" class="form-control" id="pelicula_id" name="pelicula_id" required>
        </div>
        <button type="submit" class="btn btn-danger">Eliminar Película</button>
    </form>
</div>
