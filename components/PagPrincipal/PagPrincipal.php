<?php
    session_start();

    // Verifica se o usuário está logado
    if (!isset($_SESSION['usuario'])) {
        // se o usuário não estiver logado, redireciona para a página de login
        $_SESSION['mensagemErro'] = "Faça login para acessar a página.";
        header("Location: ../../index.php");
        exit();
    }

    // Vai verificar se o formulário de logout foi acionado
    if (isset($_POST['logout'])) {
        // se sim, finaliza a sessão
        session_destroy();

        // e redireciona para a página de login
        header("Location: ../../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PagPrincipal.css">

    <!-- Google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
    
        const btnHome = document.getElementById('btnHome');
        const btnFecharHome = document.getElementById('btnFecharHome');
        
        function abrirHome(){
            const aside = document.getElementById('aside');
            if(aside.style.display !== 'flex'){
                aside.style.display = 'flex';
                btnFecharHome.style.display = 'block';
                btnHome.style.display = 'none'
            }else{
                aside.style.display = 'none';
                btnHome.style.display = 'flex'
                btnFecharHome.style.display = 'none';
            }
        }

        function fecha(){
            if (window.innerWidth < 800) {
                const aside = document.getElementById('aside');
    
                setTimeout(() => {
                    aside.style.display = 'none';
                    btnHome.style.display = 'flex'
                    btnFecharHome.style.display = 'none';
                }, 200);
            }
        }
        

    </script>

    <title>Home</title>
</head>
<body>
    <section>
        <button class="btnHome" onClick="abrirHome()" id="btnHome">
            <span class="material-symbols-outlined">home</span>
        </button>
        <aside id="aside">
            <div class="divLogo">
                <a href="">
                    <img src="../../img/logoColor200x90.png" alt="imagem Logo">
                </a>
                <button id="btnFecharHome" onClick="abrirHome()">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <nav>
                <ul>
                    <li onClick="fecha()">
                        <!-- botão Inicio -->
                        <a href="../PagHome/PagHome.php" target="conteudo">
                            <span class="material-symbols-outlined">home</span>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li onClick="fecha()">
                        <!-- botão Entrada -->
                        <a href="../PagEntrada/PagEntrada.php" target="conteudo">
                            <span class="material-symbols-outlined">screenshot_region</span>
                            <p>Entrada</p>
                        </a>
                    </li>
                    <li onClick="fecha()">
                        <!-- botão Estoque -->
                        <a href="../PagEstoque/PagEstoque.php" target="conteudo">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <p>Estoque</p>
                        </a>
                    </li>
                    <li onClick="fecha()">
                        <!-- botão Financeiro -->
                        <a href="../PagFinanceiro/PagFinanceiro.php" target="conteudo">
                            <span class="material-symbols-outlined">
                                account_balance_wallet
                                </span>
                            <p>Financeiro</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <form method="post">
                <!-- botão logout -->
                <button type="submit" name="logout">
                    <div>
                        <span class="material-symbols-outlined">power_settings_new</span>
                    </div>
                </button>
                <p id="infoVersion">InovaGest version 1.0.03</p>
            </form>
        </aside>


        <div class="divIframePrincipal">
            <iframe src="../PagHome/PagHome.php" frameborder="0" name="conteudo" id="iframe">

            </iframe>
        </div>
    </section>
</body>
</html>