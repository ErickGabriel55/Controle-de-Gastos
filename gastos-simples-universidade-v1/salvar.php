<?php 
    include ('conexao.php');
    
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $data = $_POST['data'];
    
    $sql = "INSERT INTO controle_gastos.gastos(descricao, valor, categoria, data) VALUES ('$descricao', $valor, '$categoria', '$data')";

    if (mysqli_query($mysqli, $sql)){ // a mysqli_query($mysqli, $sql) envia a consulta ao banco de dados de forma mais segura
        header("Location: listar.php");
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