<!-- En views/movie.php o views/series.php -->
<div class="comments">
    <h3>Comentarios</h3>
    <form method="POST" action="/comment">
        <textarea name="contenido" required></textarea>
        <input type="hidden" name="pelicula_id" value="<?= $pelicula['id'] ?>">
        <input type="hidden" name="serie_id" value="<?= $serie['id'] ?>">
        <button type="submit">Enviar Comentario</button>
    </form>
    <?php foreach ($comentarios as $comentario): ?>
        <div class="comment">
            <p><?= $comentario['contenido'] ?></p>
            <small>Por <?= $comentario['username'] ?> el <?= $comentario['fecha'] ?></small>
        </div>
    <?php endforeach; ?>
</div>

<div class="ratings">
    <h3>Valoraciones</h3>
    <form method="POST" action="/rate">
        <select name="puntuacion" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="hidden" name="pelicula_id" value="<?= $pelicula['id'] ?>">
        <input type="hidden" name="serie_id" value="<?= $serie['id'] ?>">
        <button type="submit">Enviar Valoración</button>
    </form>
</div>