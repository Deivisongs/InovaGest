<?php
    session_start();

    if (isset($_SESSION['mensagemErro'])) {
        echo '<script>alert("' . $_SESSION['mensagemErro'] . '");</script>';
        unset($_SESSION['mensagemErro']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Google Icons-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>InovaGest Login</title>

</head>
<body>

    <div class="login-container">
        
        <div class="login-form">
            <div class="logo">
                <img src="img/logoColor200x90.png" alt="imagem logo">
            </div>
            <p>Login</p>
            <form action="processamentoLogin.php" method="post" class="form">
                <div>
                    <span class="material-symbols-outlined">person</span>
                    <input type="text" id="username" name="username" required placeholder="Usuario" autocomplete="off">
                </div>
                <div>
                    <span class="material-symbols-outlined">lock</span>
                    <input type="password" id="password" name="password" required placeholder="Senha">
                </div>
                <input type="submit" class="login-button" value="Entrar">
            </form>
            <button class="Esqueci">Esqueci a senha</button>
            <p id="infoVersion">InovaGest version 1.0.03</p>
        </div>
    </div>

</body>
</html>
