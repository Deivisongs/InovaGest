<!DOCTYPE html>

<?php
include_once('../../conexao.php');
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PagEstoque.css">

    <!-- Google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <section class="container">
        <div class="divTitle">
            <h2>Estoque</2>
        </div>

        <form action="PagEstoque.php" class="form" method="post">
            <input type="text" placeholder="Busque aqui..." name="busca">

            <!-- botão pesquisa -->
            <button type="submit">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
        <div  class="tableConteudo">
            <table>
                <?php
                    
                    // Realiza a busca caso tenha algum item na barra de busca
                    // Caso não tenha somente mostra os item na tabela estoque
                    $busca = isset($_POST['busca']) ? $_POST['busca'] : '';

                    echo "<tr class='table-topo'>
                    <th class='tableCod'>Cod</th>
                    <th class='tableDescricao'>Descrição</th>
                    <th class='tableQtd'>Quant</th>
                    <th class='vlr'>Valor</th>
                    <th class='vlrEstoque'>Vlr Estoque</th>
                </tr>";

                    if($busca != ''){
                        $consulta = mysqli_query($conexao, "SELECT * FROM estoque WHERE descricao LIKE '%$busca%'" );

                        while($resultado = mysqli_fetch_array($consulta)){
                            echo "<tr>
                            <td class='tableCod'>
                                <p>". $resultado["cod_fornecedor"] ."</p>
                            </td>
                            <td class='tableDescricao'>". $resultado['descricao'] ."</td>
                            <td class='tableQtd'>". $resultado['quantidade'] ."</td>
                            <td class='vlr'>R$ ". $resultado['valor'] ."</td>
                            <td class='vlrEstoque'>R$". $resultado['vlrEstoque'] ."</td>
                        </tr>";
                        }
                    }else{
                        $consulta = mysqli_query($conexao, "SELECT * FROM estoque" );

                        while($resultado = mysqli_fetch_array($consulta)){
                            echo "<tr>
                            <td class='tableCod'>
                                <p>". $resultado["cod_fornecedor"] ."</p>
                            </td>
                            <td class='tableDescricao'>". $resultado['descricao'] ."</td>
                            <td class='tableQtd'>". $resultado['quantidade'] ."</td>
                            <td class='vlr'>R$ ". $resultado['valor'] ."</td>
                            <td class='vlrEstoque'>R$ ". $resultado['vlrEstoque'] ."</td>
                        </tr>";
                        }
                    }








                ?>

            </table>
        </div>
        

    </section>
</body>
</html>