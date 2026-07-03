<?php
require 'db.php';

// Lógica para Adicionar Tarefa
if (isset($_POST['adicionar'])) {
    $titulo = $_POST['titulo'];
    if (!empty($titulo)) {
        $sql = "INSERT INTO tarefas (titulo, status) VALUES (:titulo, 'Pendente')";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->execute();
    }
}

// Lógica para Deletar Tarefa
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $sql = "DELETE FROM tarefas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: index.php");
}

// Lógica para Alterar Status
if (isset($_GET['concluir'])) {
    $id = $_GET['concluir'];
    $sql = "UPDATE tarefas SET status = 'Concluída' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: index.php");
}

// Ler todas as tarefas para exibir
$sql = "SELECT * FROM tarefas ORDER BY id DESC";
$stmt = $pdo->query($sql);
$tarefas_lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas - Fase 2</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .concluida { text-decoration: line-through; color: gray; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2 f2 f2; }
    </style>
</head>
<body>

    <h1>Minha Lista de Tarefas (Banco de Dados MySQL)</h1>

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
            <?php foreach ($tarefas_lista as $tarefa): ?>
            <tr>
                <td class="<?php echo ($tarefa['status'] == 'Concluída') ? 'concluida' : ''; ?>">
                    <?php echo htmlspecialchars($tarefa['titulo']); ?>
                </td>
                <td><?php echo $tarefa['status']; ?></td>
                <td>
                    <?php if ($tarefa['status'] == 'Pendente'): ?>
                        <a href="index.php?concluir=<?php echo $tarefa['id']; ?>">Concluir</a> |
                    <?php endif; ?>
                    <a href="index.php?deletar=<?php echo $tarefa['id']; ?>" onclick="return confirm('Deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
