<?php 
    include "conexao.php";

    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = intval($_GET["id"]);

        $stmt = $mysqli->prepare("DELETE FROM gastos WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: listar.php?mensagem=Excluído com sucesso!");
        } else {
            header("Location: listar.php?mensagem=Erro ao excluir.");
        }

        $stmt->close();
        exit();
    } else {
        header("Location: listar.php?mensagem=Selecione um gasto válido para apagar!");
        exit();
    }
?>
