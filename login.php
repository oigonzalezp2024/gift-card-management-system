<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        /* Estilos generales */
        body {
            background-color: #000000;
            color: #c7f3ff;
            font-family: 'Consolas', 'Courier New', monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            color: #00ffff;
            text-shadow: 0 0 10px #00ffff;
            text-transform: uppercase;
            letter-spacing: 3px;
            border-bottom: 2px solid #00ffff;
            padding-bottom: 5px;
            display: inline-block;
            margin-bottom: 30px;
        }

        /* Contenedor principal del formulario de login */
        .login-container {
            background-color: #0c1a2c;
            border: 2px solid #00ffff;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.5) inset, 0 0 15px rgba(0, 255, 255, 0.5);
            padding: 40px;
            width: 350px;
            text-align: center;
        }

        /* Estilos para los grupos de entrada (input y label) */
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #00ffff;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Estilos para los campos de entrada de texto */
        .input-group input {
            width: 100%;
            padding: 10px;
            background-color: #1a2c3d;
            border: 1px solid #00ffff;
            color: #fff;
            font-family: 'Consolas', monospace;
            box-shadow: inset 0 0 5px rgba(0, 255, 255, 0.3);
            outline: none;
            transition: box-shadow 0.3s;
            box-sizing: border-box;
        }

        .input-group input:focus {
            border-color: #00e0e0;
            box-shadow: inset 0 0 8px rgba(0, 255, 255, 0.5);
        }

        /* Estilos para el botón "Entrar" */
        .btn {
            width: 100%;
            padding: 12px;
            font-size: 1.1em;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 15px;
            background-color: #00ffff;
            color: #0c1a2c;
            border: none;
            border-radius: 2px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
            transition: all 0.3s ease;
            cursor: pointer;
            font-family: 'Consolas', monospace;
        }

        .btn:hover {
            background-color: #00e0e0;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.9);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <main class="login-container">
        <h2>INICIAR SESIÓN</h2>
        <form action="./" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input hidden="" id="orden" name="orden" value="logueo">
            <button type="submit" class="btn">Entrar</button>
        </form>
    </main>
</body>
</html>