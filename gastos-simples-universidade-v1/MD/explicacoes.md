Conexao.php
$hostname = "localhost"; /* Endereço do servidor onde se encontra o banco de dados. */ 
$bancoDeDados = "controle_gastos"; /* Nome do banco de dados que queremos criar */ 
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario,  $senha, $bancoDeDados,); /* Variavel com o objeto do tipo mysqli, a sequencia acima é obrigatória para funcionamento correto.*/
if ($mysqli->connect_errno){
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ")" . $mysqli->connect_errno;
} 

excluir.php


listar.php

<?php
include("conexao.php");

// Faz a consulta no banco
$sql = "SELECT * FROM gastos ORDER BY data DESC"; // Consulta MySQL
$resultado = mysqli_query($mysqli, $sql); /* executa a $sql através do que está no arquivo conexao.php e com a extensão mysqli improved. sintaxe: mysqli_query(conexao, consulta_sql). DQL retorna mysqli_result para ser usado com o fetch, DML retorna true (sucesso) ou false (erro) em caso de erro para checar se funcionou.*/
?>

<?php while($linha = mysqli_fetch_assoc($resultado)): /* Fetch - buscar, recuperar, trazer de volta. mysqli_fetch_assoc() extrai uma linha de resultado da consulta SQL como um array associativo, onde as chaves do array são os nomes das colunas do banco. E com o while é linha por linha */?>
    <tr>
        <td><?= htmlspecialchars($linha['descricao']) ?></td> <!-- htmlspecialchars() evita problemas com acentos ou codigos maliciosos -->
        <td><?= number_format($linha['valor'], 2, ',', '.') ?></td> <!-- Formata o valor com vírgula e duas casas decimais. -->
        <td><?= htmlspecialchars($linha['categoria']) ?></td>
        <td><?= date('d/m/Y', strtotime($linha['data'])) ?></td> <!-- formata a data no estilo brasileiro dd/mm/yyyy -->
        <td>
            <a href="excluir.php?id=<?= $linha['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="botao-excluir">&#x1F5D1; Excluir</a>
        </td>
    </tr>
<?php endwhile; ?>

salvar.php
<?php 
    include ('conexao.php');
    
    // Recebidos através do action do form.html
    $descricao = $_POST['descricao']; // coleta através do metodo e do name
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $data = $_POST['data'];
    
    $sql = "INSERT INTO controle_gastos.gastos(descricao, valor, categoria, data) VALUES ('$descricao', $valor, '$categoria', '$data')";

    if (mysqli_query($mysqli, $sql)){ 
        header("Location: listar.php");/* envia um cabeçalho http ao navegador, antes  do conteudo ser exibido, inclusive só pode ser usada antes de um echo, normalmente usada para redirecionamento, como acima. */
        exit();
        /*echo '<pre>';
        print_r($_POST);
        echo '</pre>';*/
    }
    else{
        echo "Erro " . mysqli_connect_error($mysqli);
    }
    mysqli_close($mysqli);

?>
    