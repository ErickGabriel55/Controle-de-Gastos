<?php
include("conexao.php");

$sql = "SELECT * FROM gastos ORDER BY data DESC";
$resultado = mysqli_query($mysqli, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Controle de Gastos</title>
    <link rel="stylesheet" href="css/listar.css">
    <link rel="shortcut icon" href="img/dinheiro.ico" type="image/x-icon">
</head>
<body>
    <header>
        <h1>Controle de Gastos</h1>
    </header>

    <main>
        <section>
            <?php if (isset($_GET["mensagem"]) && !empty($_GET["mensagem"])): ?>
                <div class="alert-mensagem">
                    <?= htmlspecialchars($_GET["mensagem"]) ?>
                </div>
            <?php endif; ?>

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
                    <?php while($linha = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?= htmlspecialchars($linha['descricao']) ?></td>
                            <td><?= number_format($linha['valor'], 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($linha['categoria']) ?></td>
                            <td><?= date('d/m/Y', strtotime($linha['data'])) ?></td>
                            <td>
                                <a href="excluir.php?id=<?= urlencode($linha['id']) ?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="botao-excluir">&#x1F5D1; Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div class="voltar-centralizado">
                <a href="index.html" class="btn-voltar">&#x1F519; Voltar</a>
            </div>

            <?php
                $sql_total = "SELECT SUM(valor) AS total_gastos FROM gastos";
                $resultado_total = mysqli_query($mysqli, $sql_total);
                $linha_total = mysqli_fetch_assoc($resultado_total);
                $total = $linha_total['total_gastos'] ?? 0;
            ?>

            <p class="total-gastos">
                <strong>Total de Gastos:</strong> R$ <?= number_format($total, 2, ',', '.') ?>
            </p>
        </section>
    </main>

    <footer>
        <div>
            <p>&copy; 2025 - Projeto de Controle de Gastos</p>
        </div>
    </footer>
</body>
</html>
