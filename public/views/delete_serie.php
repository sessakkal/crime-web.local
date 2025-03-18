<!-- /public/views/delete_serie.php -->
<div class="container form-container">
    <h1 class="mb-4">Eliminar Serie</h1>

    <form action="/admin/delete_serie.php" method="POST">
        <div class="mb-3">
            <label for="serie_id" class="form-label">ID de la Serie</label>
            <input type="number" class="form-control" id="serie_id" name="serie_id" required>
        </div>
        <button type="submit" class="btn btn-danger">Eliminar Serie</button>
    </form>
</div>
