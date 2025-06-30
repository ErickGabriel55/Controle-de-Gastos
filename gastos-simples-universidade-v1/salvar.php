<?php 
    include ('conexao.php');
    
    // Recebidos através do action do form.html
    $descricao = $_POST['descricao']; // coleta através do metodo e do name
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $data = $_POST['data'];
    
    $sql = "INSERT INTO controle_gastos.gastos(descricao, valor, categoria, data) VALUES ('$descricao', $valor, '$categoria', '$data')";

    if (mysqli_query($mysqli, $sql)){ 
        header("Location: listar.php?mensagem=Gasto salvo com sucesso!");/* envia um cabeçalho http ao navegador, antes  do conteudo ser exibido, inclusive só pode ser usada antes de um echo, normalmente usada para redirecionamento, como acima. */
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