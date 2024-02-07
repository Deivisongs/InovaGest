<!DOCTYPE html>
<?php
    include_once('../../conexao.php');
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="PagFinanceiro.css">

    <!-- Google icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <?php

        // Função que realiza o cadastro dos boletos
        if (isset($_POST['cadastra'])) {
            
            $beneficiario = $_POST['beneficiario'];
            $data = $_POST['data'];
            $valor = $_POST['valor'];


            if($beneficiario != '' || $data != '' || $valor != ''){
                if(is_numeric($valor)){
                    $cadastro = mysqli_query($conexao, "INSERT INTO boletos(beneficiario, vlrPagamento,vencimento) VALUES('$beneficiario','$valor','$data')");
                }else{
                }
            }else{
                echo "Insira um valor";
            }

        }
    ?>

    <script>

        // Função apaga boleto
        function apaga(codBoleto) {
           
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "apaga_boleto.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    
                    console.log(xhr.responseText);
                }
            };
            xhr.send("codBoleto=" + codBoleto);
            window.location.href = window.location.href;
        }
        
    </script>



    <title>Document</title>
</head>
<body>
    <section class="container">
        <div class="divContas">
            <div class="divContentLeft">
                <div class="infoText">
                    <span class="material-symbols-outlined">attach_money</span>
                    <p>Contas a Pagar</p>
                </div>
                <hr>
                <div class="infoConteudo">
                    <div>
                        <p>R$</p>
                    </div>
                    <div class="infoConteudoDiv">

                        <?php
                            // Informações de Boletos referente aos próximos 30 Dias
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
            </div>

            <div class="divContentRigth">
                <div class="infoText">
                    <p>Hoje</p>
                </div>
                <div class="infoConteudos">
                    <p>R$</p>

                    <?php
                            // Informações boletos do dia de Hoje
                            $totalBoletos = mysqli_query($conexao, "SELECT *, SUM(vlrPagamento) AS vlrTotal FROM boletos WHERE vencimento = CURDATE();");

                            $resultTotalBoletos = mysqli_fetch_array($totalBoletos);

                            $totalBoletosFormatado = number_format($resultTotalBoletos['vlrTotal'], 2, ',' , '.');
                            
                            if(is_numeric($resultTotalBoletos['vlrTotal']) ){
                                echo "<h2>". $totalBoletosFormatado ."</h2>";
                            }else{
                                echo "<h2>0,00</h2>";
                            }

                        ?>
                    <h2>

                    </h2>
                    <span class="material-symbols-outlined">sell</span>
                </div>
            </div>
        </div>

        <div class="divCadastrar">
            <div class="infoText">
                <span class="material-symbols-outlined">request_quote</span>
                <p>Cadastrar Boleto</p>
            </div>
            <hr>
            <div class="divForm">
                <form action="PagFinanceiro.php" method="post">
                    <input type="text" placeholder="Beneficiário" id="beneficiario" name="beneficiario" required>
                    <input type="date" id="date" name="data" required>
                    <input type="text" placeholder="Vlr a Pagar (R$)" id="valor" name="valor" required>

                    <!-- Botão de cadastrar boleto -->
                    <input type="submit" value="Cadastrar" id="btnCadastrar" name="cadastra">
                </form>
            </div>
        </div>
        <div class="divTabela">
            <div class="infoText">
                <div class="infoTextleft">
                    <span class="material-symbols-outlined">attach_money</span>
                    <p>Boletos a Pagar</p>
                </div>
                
            </div>
            <hr>
            
            <div class="tableList">
                <table>

                <?php

                // Resultado da tabela vindo do Banco de Dados

                $consulta = mysqli_query($conexao, "SELECT cod_boleto, beneficiario, vlrPagamento, DATE_FORMAT(vencimento, '%d-%m-%Y') as vencimento FROM boletos ORDER BY vencimento");

                echo "<tr class='topo-tabela'>
                <th class='tableCod'>Cod</th>
                <th class='tableBeneficiario'>Beneficiario</th>
                <th class='tableVlrTopo'>Valor</th>
                <th class='tableVencimentoTopo'>Vencimento</th>
                <th class='tableBtnTopo'>
                    <span class='material-symbols-outlined'>delete</span>
                </th>
            </tr>";
                            
                while($resultado = mysqli_fetch_array($consulta)){
                    echo "<tr>
                    <td class='tableCod'>" . $resultado['cod_boleto'] . "</td>
                    <td class='tableBeneficiario'>" . $resultado['beneficiario']."</td>
                    <td class='tableVlr'>" . $vlrFormatado = number_format($resultado['vlrPagamento'], 2, '.', ''). "</td>
                    <td class='tableVencimento'>" . $resultado['vencimento'] . "</td>
                    <td class='tableBtnTopo'> <button class='btnDelet' onClick='apaga(". $resultado['cod_boleto'] .")'> 
                    <span class='material-symbols-outlined'>delete</span>
                </button> </td>
                </tr>";
                }
                ?>
            </table>
            </div>
        </div>
    </section>
</body>
</html>