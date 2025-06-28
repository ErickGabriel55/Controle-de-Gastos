<?php
include("conexao.php");

// Faz a consulta no banco
$sql = "SELECT * FROM gastos ORDER BY data DESC"; // Consulta MySQL
$resultado = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Controle de Gastos</title>
    <link rel="stylesheet" href="css/listar.css">
    <link rel="shortcut icon" href="img/icons8-saco-de-dinheiro-96.ico" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Gastos Cadastrados</h1>
    </header>

    <main>
        <section>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Valor (R$)</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($linha = mysqli_fetch_assoc($resultado)): /* fetch - buscar, recuperar, trazer de volta. mysqli_fetch_assoc() extrai uma linha de resultado da consulta SQL como um array associativo, onde as chaves do array são os nomes das colunas do banco. e com o while é inha por linha */?>
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
                </tbody>
            </table>
            <div class="voltar-centralizado">
                <a href="index.html" class="btn-voltar">&#x1F519; Voltar</a>
            </div>
        </section>
    </main>

    <footer>
        <div>
            <p>&copy; 2025 - Projeto de Controle de Gastos</p>
        </div>
    </footer>

</body>
</html>
