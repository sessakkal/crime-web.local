<!-- En views/messages.php -->
<div class="messages">
    <h3>Mensajes</h3>
    <form method="POST" action="/send-message">
        <select name="destinatario_id" required>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?= $usuario['id'] ?>"><?= $usuario['username'] ?></option>
            <?php endforeach; ?>
        </select>
        <textarea name="contenido" required></textarea>
        <button type="submit">Enviar Mensaje</button>
    </form>

    <div class="message-list">
        <?php foreach ($mensajes as $mensaje): ?>
            <div class="message">
                <p><?= $mensaje['contenido'] ?></p>
                <small>De <?= $mensaje['username'] ?> el <?= $mensaje['fecha'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</div>