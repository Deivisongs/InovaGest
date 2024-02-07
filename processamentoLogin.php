<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$username'";
    $resultado = $conexao->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();

        // Vai comparar a senha diretamente
        if ($password === $row['senha']) {
            
            // Se a senha estiver correta, vai iniciar a sessão e redireciona para a página seguinte
            $_SESSION['usuario'] = $username;
            header("Location: ./components/PagPrincipal/PagPrincipal.php");
            exit();
        } else {

            // se a senha for incorreta, exibi a mensagem de erro
            $_SESSION['mensagemErro'] = "Senha incorreta, verifique novamente!";
            header("Location: index.php");
            exit();
        }
    } else {
        // se o usuário não for encontrado, exibi a mensagem de erro
        $_SESSION['mensagemErro'] = "Usuário não encontrado,verifique novamente!";
        header("Location: index.php");
        exit();
    }
}

$conexao->close();
?>
