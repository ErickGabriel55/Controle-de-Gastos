<?php 
    $hostname = "localhost"; /* Endereço do servidor onde se encontra o banco de dados. */ 
    $bancoDeDados = "controle_gastos"; /* Nome do banco de dados que queremos criar */ 
    $usuario = "root";
    $senha = "";

    $mysqli = new mysqli($hostname, $usuario,  $senha, $bancoDeDados,); /* Variavel com o objeto do tipo mysqli, a sequencia acima é obrigatória para funcionamento correto.*/
    if ($mysqli->connect_errno){
        echo "Falha ao conectar: (" . $mysqli->connect_errno . ")" . $mysqli->connect_errno;
    } 
    else {
        echo "Conectado com sucesso ao banco de dados!";
    }
?>