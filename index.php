<?php
session_start();
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta a la base de datos
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Inicio de sesión exitoso
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role']
        ];

        // Redirigir según el rol del usuario
        if ($user['role'] === 'doctor') {
            header('Location: dashboard_doctor.php');
        } elseif ($user['role'] === 'informatico') {
            header('Location: dashboard_informatico.php');
        }
        exit();
    } else {
        // Credenciales incorrectas
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            
            font-family: Arial, sans-serif;
            margin: 0;
            height: 100vh;
            background: url('https://scontent.flim7-1.fna.fbcdn.net/v/t39.30808-6/378155873_288219303963362_9177207338515795415_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=cc71e4&_nc_eui2=AeHUgKHDnETweyynjtxnkbBoilFX9ETeLN-KUVf0RN4s34gOg0PsHQfVDgdLbRqzNr0PYFUmLyqSYqHVGhLHVryk&_nc_ohc=5wNRCU2SISYQ7kNvgEHDlBo&_nc_zt=23&_nc_ht=scontent.flim7-1.fna&_nc_gid=Az_5MhR7MLPEJSasUEV8zwe&oh=00_AYAIHO40VS_FqhOKTiPPs7GKYx2HrAg44422CrIwz2-WBg&oe=674C3082');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco semi-transparente */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #00538C; /* Azul EsSalud */
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #000000; /* Azul fuerte EsSalud */
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #9B7E2D; /* Azul más oscuro */
        }

        .error-message {
            color: #e74c3c; /* Rojo de error */
            margin-bottom: 15px;
        }

        label {
            color: #333;
            text-align: left;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .login-container {
                padding: 20px;
            }

            h2 {
                font-size: 20px;
            }

            button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="index.php">
            <div>
                <label for="username">Nombre de usuario:</label>
                <input type="text" name="username" id="username" class="input-field" placeholder="Nombre de usuario" required>
            </div>
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" class="input-field" placeholder="Contraseña" required>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>
</body>
</html>
