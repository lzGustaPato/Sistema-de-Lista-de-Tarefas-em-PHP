<?php
$arquivo = 'tarefas.txt';

// Se o arquivo não existir, cria um vazio
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, "");
}

// Lógica para Adicionar Tarefa
if (isset($_POST['adicionar'])) {
    $titulo = $_POST['titulo'];
    if (!empty($titulo)) {
        $nova_tarefa = $titulo . ";Pendente\n";
        file_put_contents($arquivo, $nova_tarefa, FILE_APPEND);
    }
}

// Lógica para Deletar Tarefa
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $tarefas = file($arquivo);
    unset($tarefas[$id]);
    file_put_contents($arquivo, implode("", $tarefas));
    header("Location: index.php");
}

// Lógica para Alterar Status
if (isset($_GET['concluir'])) {
    $id = $_GET['concluir'];
    $tarefas = file($arquivo);
    if (isset($tarefas[$id])) {
        $partes = explode(";", trim($tarefas[$id]));
        $titulo = $partes[0];
        $tarefas[$id] = $titulo . ";Concluída\n";
        file_put_contents($arquivo, implode("", $tarefas));
    }
    header("Location: index.php");
}

// Ler todas as tarefas para exibir
$tarefas_lista = file($arquivo);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas - Fase 1</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .concluida { text-decoration: line-through; color: gray; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2 f2 f2; }
    </style>
</head>
<body>

    <h1>Minha Lista de Tarefas (Arquivo .txt)</h1>

    <form method="POST">
        <input type="text" name="titulo" placeholder="Digite uma nova tarefa..." required>
        <button type="submit" name="adicionar">Adicionar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Tarefa</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tarefas_lista as $index => $linha): 
                $dados = explode(";", trim($linha));
                if (count($dados) < 2) continue;
                $titulo = $dados[0];
                $status = $dados[1];
            ?>
            <tr>
                <td class="<?php echo ($status == 'Concluída') ? 'concluida' : ''; ?>">
                    <?php echo $titulo; ?>
                </td>
                <td><?php echo $status; ?></td>
                <td>
                    <?php if ($status == 'Pendente'): ?>
                        <a href="index.php?concluir=<?php echo $index; ?>">Concluir</a> |
                    <?php endif; ?>
                    <a href="index.php?deletar=<?php echo $index; ?>" onclick="return confirm('Deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
