<?php 
    include('conexao.php');

    if (
        isset($_POST['descricao'], $_POST['valor'], $_POST['categoria'], $_POST['data']) &&
        !empty($_POST['descricao']) &&
        !empty($_POST['valor']) &&
        !empty($_POST['data']) // categoria pode estar vazia
    ) {
        $descricao = $_POST['descricao'];
        $valor = floatval($_POST['valor']);
        $categoria = $_POST['categoria'];
        $data = $_POST['data'];

        $stmt = $mysqli->prepare("INSERT INTO gastos (descricao, valor, categoria, data) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $descricao, $valor, $categoria, $data);

        if ($stmt->execute()) {
            header("Location: listar.php?mensagem=Gasto salvo com sucesso!");
            exit();
        } else {
            echo "Erro ao salvar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        header("Location: listar.php?mensagem=Preencha os campos obrigatórios.");
        exit();
    }

    $mysqli->close();
?>
