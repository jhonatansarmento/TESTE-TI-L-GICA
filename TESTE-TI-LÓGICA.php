<?php

// Configuração do banco de dados
$host = 'localhost';
$user = 'usuario';
$pass = 'senha';
$db = 'nome_do_banco';

// Conexão com o banco de dados
$conn = mysqli_connect($host, $user, $pass, $db);

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
    die('Não foi possível conectar ao banco de dados: ' . mysqli_connect_error());
}

// Query para selecionar os dados desejados
$query = "
    SELECT 
        Tb_banco.nome AS nome_banco, 
        Tb_convenio.verba, 
        Tb_contrato.codigo AS codigo_contrato, 
        Tb_contrato.data_inclusao, 
        Tb_contrato.valor, 
        Tb_contrato.prazo 
    FROM 
        Tb_contrato 
        INNER JOIN Tb_convenio_servico ON Tb_contrato.convenio_servico = Tb_convenio_servico.codigo 
        INNER JOIN Tb_convenio ON Tb_convenio_servico.convenio = Tb_convenio.codigo 
        INNER JOIN Tb_banco ON Tb_convenio.banco = Tb_banco.codigo;
";

// Executa a query e armazena o resultado em uma variável
$resultado = mysqli_query($conn, $query);

// Verifica se a query foi executada com sucesso
if (!$resultado) {
    die('Não foi possível executar a consulta: ' . mysqli_error($conn));
}

// Exibe os dados em uma tabela HTML
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>Nome do Banco</th>';
echo '<th>Verba</th>';
echo '<th>Código do Contrato</th>';
echo '<th>Data de Inclusão</th>';
echo '<th>Valor</th>';
echo '<th>Prazo</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($resultado)) {
    echo '<tr>';
    echo '<td>' . $row['nome_banco'] . '</td>';
    echo '<td>' . $row['verba'] . '</td>';
    echo '<td>' . $row['codigo_contrato'] . '</td>';
    echo '<td>' . $row['data_inclusao'] . '</td>';
    echo '<td>' . $row['valor'] . '</td>';
    echo '<td>' . $row['prazo'] . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';

// Fecha a conexão com o banco de dados
mysqli_close($conn);

?>
