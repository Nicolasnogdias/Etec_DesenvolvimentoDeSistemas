<?php
require 'conexao_socars.php';

// Buscar todas as marcas para exibir no select
$marcas = $pdo->query("SELECT * FROM marca")->fetchAll(PDO::FETCH_ASSOC);

// Cadastro da categoria
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_categoria = $_POST['nome_categoria'];
    $id_marca = $_POST['marca_id'];

    $sql = "INSERT INTO categoria (nome_categoria, marca_id) VALUES (:nome_categoria, :marca_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome_categoria', $nome_categoria);
    $stmt->bindParam(':marca_id', $id_marca, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Categoria cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar categoria.";
    }
}
?>

<form method="POST" action="">
    <label>Nome da Categoria:</label><br>
    <input type="text" name="nome_categoria" required><br><br>

    <label>Marca:</label><br>
    <select name="marca_id" required>
        <option value="">Selecione a Marca</option>
        <?php foreach($marcas as $marca): ?>
            <option value="<?= $marca['marca_id'] ?>">
                <?= htmlspecialchars($marca['nome_marca']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Cadastrar Categoria</button>
</form>
 