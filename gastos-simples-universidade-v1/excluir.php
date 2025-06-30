<?php 
    include "conexao.php";

    if (isset($_GET["id"]) && !empty($_GET["id"]))
    {
        $sql = "DELETE FROM gastos WHERE id = " .$_GET["id"];
        $resultado = mysqli_query($mysqli, $sql);

        if($resultado)
        {
            header("Location: ./listar.php?mensagem=Excluído com sucesso!");
            exit();
        }
        else
        {
            header("Location: ./listar.php?mensagem=Ocorreu algum erro!");
            exit();
        }
    }
    else
    {
        header("Location: ./listar.php?mensagem=Selecione um gasto para apagar!!!");
        exit();
    }
?>