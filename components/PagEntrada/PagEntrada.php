<!DOCTYPE html>
<html lang="pt-br">
<?php
    include_once('../../conexao.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PagEntrada.css">

    <!-- Google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>

                <?php
                    // Realiza o cadastro do produto
                    if (isset($_POST['cadastrar'])) {
                        $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']);
                        $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
                        $qtde = mysqli_real_escape_string($conexao, $_POST['qtde']);
                        $valor = mysqli_real_escape_string($conexao, $_POST['valor']);


                        $consulta = mysqli_query($conexao, "SELECT cod_fornecedor FROM estoque WHERE cod_fornecedor = '$codigo'");

                        $resultado = mysqli_fetch_array($consulta);

                        if($resultado > 0){
                            header("Location: ./cadastro/ProdutoCadastrado.php");
                        }else{
                            if($codigo != '' && $descricao != '' && $qtde != '' && $valor != ''){

                                $vlrEstoque = $valor * $qtde;
            
                                $insere = mysqli_query($conexao, "INSERT INTO estoque(descricao, quantidade, valor, vlrEstoque, cod_fornecedor, data_cadastro)VALUES ('$descricao','$qtde','$valor','$vlrEstoque','$codigo', CURDATE())");

                                // retorno da mensagem produto cadastrado
                                header("Location: ./cadastro/confirmaEntrada.php");
                            }else{
                                // retorno da mensagem preencha os Campos Obrigatorios
                                header("Location: ./cadastro/erroEntrada.php");
                            }
                            
                        }
                
                    }
                    
                    //Leva a pagina de Estoque
                    if (isset($_POST['consultar'])) {
                        header("Location: ../PagEstoque/PagEstoque.php");
                    }

                    //Atualiza o produto
                    if (isset($_POST['atualizar'])) {
                        $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']);

                        $consulta = mysqli_query($conexao, "SELECT cod_fornecedor FROM estoque WHERE cod_fornecedor = '$codigo'");


                        $numLinhas = mysqli_num_rows($consulta);

                        
                        
                        if($codigo != ""){
                            if($numLinhas > 0  ){

                                $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
                                if($descricao != ''){

                                    $insere = mysqli_query($conexao, "UPDATE estoque SET descricao = '$descricao' WHERE cod_fornecedor = '$codigo'");
                                    
                                    
                                }
                                
                                $qtde = intval(mysqli_real_escape_string($conexao, $_POST['qtde']));
                                if($qtde != 0){

                                    $consultaVlrEstoque = mysqli_query($conexao, "SELECT valor FROM estoque WHERE cod_fornecedor = '$codigo'");
                                    $resultVlrEsstoque = mysqli_fetch_array($consultaVlrEstoque);
                                    $vlrFinal = $resultVlrEsstoque['valor'] * $qtde;


                                    $insere = mysqli_query($conexao, "UPDATE estoque SET quantidade = '$qtde', vlrEstoque = '$vlrFinal' WHERE cod_fornecedor = '$codigo'");

                                }
                                
                                $valor = mysqli_real_escape_string($conexao, $_POST['valor']);
                                if($valor != ''){

                                    $consultaQtde = mysqli_query($conexao, "SELECT quantidade FROM estoque WHERE cod_fornecedor = '$codigo'");
                                    $resultQtde = mysqli_fetch_array($consultaQtde);
                                    $qtdeFinal = $resultQtde['quantidade'] * $valor;


                                    $insere = mysqli_query($conexao, "UPDATE estoque SET valor = '$valor', vlrEstoque = '$qtdeFinal' WHERE cod_fornecedor = '$codigo'");
                                }
                                // retorno da mensagem produto atualizado
                                header("Location: ../PagEntrada/Atualiza/Atualiza.php");

                            }else{
                                // retorno da mensagem produto não encontrado
                                header("Location: ../PagEntrada/Atualiza/AtualizaNaoEncontrado.php");
                            }
                        }else{
                            // retorno da mensagem preencha o codigo
                            header("Location: ../PagEntrada/Atualiza/AtualizaErro.php");
                        }

                            
                    }

                    // Deleta p produto do Banco de Dados
                    if (isset($_POST['deletar'])) {

                        $codigo = mysqli_real_escape_string($conexao, $_POST['codigo']);

                        if($codigo != ""){

                            

                            $consulta = mysqli_query($conexao, "SELECT cod_fornecedor FROM estoque WHERE cod_fornecedor = '$codigo'");


                            $numLinhas = mysqli_num_rows($consulta);

                            if($numLinhas > 0  ){

                                $deleta = mysqli_query($conexao, "DELETE FROM estoque WHERE cod_fornecedor = '$codigo'");

                                // retorno da mensagem produto deletado
                                header("Location: ../PagEntrada/Delet/ProdutoDeletado.php");
                            }else{
                                // retorno da mensagem produto não encontrado
                                header("Location: ../PagEntrada/Atualiza/AtualizaNaoEncontrado.php");
                            }
                        }else{
                            // retorno da mensagem preencha o codigo
                            header("Location: ../PagEntrada/Atualiza/AtualizaErro.php");
                        }

                    }
                
                ?>



    </script>

    <title>Document</title>
</head>
<body>
    <section class="container">
        <div class="divTitle">
            <h2>Central Cadastro</2>
        </div>
        <form action="PagEntrada.php" class="form" method="post">
            <input type="text" name="codigo" id="codigo" placeholder="Código*" value="">
            <div class="divDescricao">
                <p>Descrição do Produto</p>
                <input type="text" name="descricao" id="descricao" placeholder="Descrição*">
            </div>
            <div class="divInputs">
                <div class="divQtde">
                    <p>Qtde</p>
                    <input type="text" name="qtde" id="qtde" placeholder="Qtde*">
                </div>
                <div class="divPreco">
                    <p>Preço
                        <span class="material-symbols-outlined">sell</span>
                    </p>
                    <input type="text" name="valor" id="preco" placeholder="Preço (R$)*">
                </div>
                <div>
                    
                </div>
            </div>
            <div class="divButtons">
                <form method="post">
                    <button id="btnCadastrar1">
                        <span class="material-symbols-outlined">add_box</span>
                        <p>Cadastrar</p>
                    </button>

                    <!-- Botão Cadastra Produto -->
                    <button id="btnCadastrar" name="cadastrar">
                        <span class="material-symbols-outlined">add_box</span>
                        <p>Cadastrar</p>
                    </button>

                    <!-- Botão leva a pagina de Estoque -->
                    <button id="btnConsultar" name="consultar">
                            <span class="material-symbols-outlined">search</span>
                            <p>Consultar</p>
                    </button>

                    <!-- Botão Atualiza Produto -->
                    <button id="btnAtulizar" name="atualizar">
                        <span class="material-symbols-outlined">edit</span>
                        <p>Atualizar</p>
                    </button>

                    <!-- Botão Deleta Produto -->
                    <button id="btnDeletar" name="deletar">
                        <span class="material-symbols-outlined">delete</span>    
                        <p>Deletar</p>
                    </button>
                </form>
            </div>
        </form>


    </section>
</body>
</html>