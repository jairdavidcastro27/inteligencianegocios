<?php
session_start();

// Verificar si el usuario está autenticado y tiene el rol de doctor
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'doctor') {
    header('Location: index.php');
    exit();
}

require 'db_connection.php';

// Cerrar sesión
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante y Sanguchería MISTER JUGO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body >

    <!-- Cerrar sesión -->
    <form method="POST" action="dashboard_doctor.php" class="d-inline">
        <button class="btn btn-danger" type="submit" name="logout">Cerrar Sesión</button>
    </form>
      <!-- Contenedor de emojis flotantes -->
      <div class="emoji-container">
        <div class="emoji">🍔</div>
        <div class="emoji">🥪</div>
        <div class="emoji">🍟</div>
        <div class="emoji">🥤</div>
        <div class="emoji">🍔</div>
        <div class="emoji">🥪</div>
        <div class="emoji">🍕</div>
        <div class="emoji">🍣</div>
    </div>

    <!-- Encabezado -->
    <header>
        <h1>INTELIGENCIA DE NEGOCIOS PARA MISTER JUGO</h1>
    </header>

    <!-- Contenedor Principal -->
    <main class="container">
        <div class="power-bi-space">
            <iframe title="proyecto_inteligencia_bi" src="https://app.powerbi.com/view?r=eyJrIjoiNmI4MWJmNzgtZTg2MC00MzhhLWIzYzYtM2MxMzEwYmQ0NDM1IiwidCI6IjEzODQxZDVmLTk2OGQtNDYyNC1hN2RhLWQ2OGE2MDA2YTg0YSIsImMiOjR9" frameborder="0" allowFullScreen="true"></iframe>
        </div>
    </main>

    <!-- Pie de Página -->
    <footer>
        <p>&copy; 2024 Restaurante & Sanguchería Mister Jugo. Todos los derechos reservados.</p>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
