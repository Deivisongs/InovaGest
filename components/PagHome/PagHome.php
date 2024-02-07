<!DOCTYPE html>
<?php
    include_once("../../conexao.php")
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./PagHome.css">

    <!-- Google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    
    <title>Home</title>
</head>
<body>
    <section class="container">
        <div class="divTopo">
            <div class="divLeft">
                <span>
                <span class="material-symbols-outlined">moving</span>
                    <p>Movimentações</p>
                </span>
                <hr>
                <div class="conteudo">
                    <?php
                        // faz a consulta no banco de dados e retorna o valor nas movimentações
                        $movimentos = mysqli_query($conexao, "SELECT COUNT(*) as res FROM estoque WHERE data_cadastro >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");

                        $resultMovimetos = mysqli_fetch_array($movimentos);

                        echo "<h1>". $resultMovimetos['res'] ."</h1>";

                    ?>
                    <p>Últimos 7 dias</p>
                </div>
            </div>
            <div class="divRigth">
                <span>
                <span class="material-symbols-outlined">account_balance_wallet</span>
                    <p>Contas a Pagar</p>
                </span>
                <hr>
                <div class="cardContasApagar">
                    <div class="divHoje">
                        <p>Hoje</p>
                        <div>
                            <p>R$</p>
                            <?php

                            // faz a consulta no banco de dados e retorna o valor nas contas a pagar Hoje
                            $totalBoletos = mysqli_query($conexao, "SELECT *, SUM(vlrPagamento) AS vlrTotal FROM boletos WHERE vencimento = CURDATE();");

                            $resultTotalBoletos = mysqli_fetch_array($totalBoletos);

                            $totalBoletosFormatado = number_format($resultTotalBoletos['vlrTotal'], 2, ',' , '.');
                            
                            if(is_numeric($resultTotalBoletos['vlrTotal']) ){
                                echo "<h2>". $totalBoletosFormatado ."</h2>";
                            }else{
                                echo "<h2>0,00</h2>";
                            }

                        ?>
                        </div>
                    </div>
                    <div class="div30dias">
                        <div>
                            <p>R$</p>
                            <div>
                                <?php

                                    // faz a consulta no banco de dados e retorna o valor nas contas a pagar dos proximos 30 dias
                                    $dataAtual = date("Y-m-d");
                                    $query = "SELECT DATE_ADD('$dataAtual', INTERVAL 30 DAY) AS data30";
                                    $resul = mysqli_query($conexao, $query);

                                    $row = mysqli_fetch_assoc($resul);
                                    $data30 = $row['data30'];

                                    $consultaData = mysqli_query($conexao, "SELECT *, SUM(vlrPagamento) AS dia FROM boletos WHERE vencimento <= '$data30';");

                                    $resultdata30 = mysqli_fetch_array($consultaData);

                                    echo "<h2>" . $resultdata30formatdo = number_format($resultdata30['dia'], 2, ',', '.') . "</h2>";

                                ?>
                                <p>Próximos 30 Dias</p>
                            </div>
                        </div>
                        <div class="divButton">
                            <!-- botão que leva a pagina Financeiro -->
                            <button>
                                <a href="../PagFinanceiro/PagFinanceiro.php">
                                    Financeiro >
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divTable">
            <span>
                <span class="material-symbols-outlined">inventory</span>
                <p>Últimos Itens adicionados</p>
            </span>
            <hr>
            
            <div>
                <table>
                    <?php
                        // resultado da tabela estoque dos ultimos item cadastrados 
                        $consulta = mysqli_query($conexao, "SELECT * FROM estoque ORDER BY cod_produto LIMIT 10" );

                        echo "<tr class='tableTopo'>
                        <th class='cod'>Cod</th>
                        <th class='descricao'>Descrição</th>
                        <th class='qtde'>Qtde</th>
                        <th class='vlr'>Valor</th>
                    </tr>";

                        while($resultado = mysqli_fetch_array($consulta)){
                            echo "<tr>
                            <td class='cod'>
                                <p>". $resultado["cod_fornecedor"] ."</p>
                            </td>
                            <td class='descricao'>". $resultado['descricao'] ."</td>
                            <td class='qtdee'>". $resultado['quantidade'] ."</td>
                            <td class='vlrr'>R$ ". $resultado['valor'] ."</td>
                        </tr>";
                        }

                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>