<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Zona Crimen</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/peliculas">Películas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/series">Series</a>
                </li>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['rol'] == 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/panel_admin.php">Panel de Administración</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>