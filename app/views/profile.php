<!-- En views/profile.php -->
<form method="POST" action="/profile">
    <label for="username">Nombre de Usuario</label>
    <input type="text" name="username" value="<?= $usuario['username'] ?>" required>

    <label for="email">Email</label>
    <input type="email" name="email" value="<?= $usuario['email'] ?>" required>

    <label for="bio">Biografía</label>
    <textarea name="bio"><?= $usuario['bio'] ?></textarea>

    <button type="submit">Guardar Cambios</button>
</form>