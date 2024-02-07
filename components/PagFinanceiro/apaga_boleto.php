<?php
// apaga_boleto.php

// Inclua o arquivo de conexão com o banco de dados
include_once('../../conexao.php');

// Verifique se o parâmetro 'codBoleto' foi passado na requisição POST
if(isset($_POST['codBoleto'])) {
    // Obtenha o valor do parâmetro
    $codBoleto = $_POST['codBoleto'];

    // Execute a consulta para excluir o boleto do banco de dados
    $deleta = mysqli_query($conexao, "DELETE FROM boletos WHERE cod_boleto = '$codBoleto'");

    if($deleta) {
        // Se a exclusão foi bem-sucedida, você pode retornar uma resposta adequada
        echo "Boleto excluído com sucesso!";

    } else {
        // Se houver um erro na exclusão, você pode retornar uma mensagem de erro
        echo "Erro ao excluir o boleto.";
    }
} else {
    // Se 'codBoleto' não foi passado na requisição, retorne uma mensagem de erro
    echo "Parâmetro 'codBoleto' não encontrado na requisição.";
}
?>