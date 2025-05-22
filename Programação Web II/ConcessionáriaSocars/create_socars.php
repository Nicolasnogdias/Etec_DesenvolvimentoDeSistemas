<?php
require 'conexao_socars.php';

// Buscar todas as marcas
$marcas = $pdo->query("SELECT * FROM marca")->fetchAll(PDO::FETCH_ASSOC);

// Buscar todas as categorias
$categorias = $pdo->query("SELECT * FROM categoria")->fetchAll(PDO::FETCH_ASSOC);

// Cadastrar modelo ao enviar o form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_modelo = $_POST['nome_modelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $preco = $_POST['preco'];
    $status = $_POST['status'];
    $descricao = $_POST['descricao']; 
    $id_categoria = $_POST['id_categoria'];

    $sql = "INSERT INTO modelo (nome_modelo, ano, cor, preco, status, descricao, categoria_id)
            VALUES (:nome_modelo, :ano, :cor, :preco, :status, :descricao, :id_categoria)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome_modelo', $nome_modelo);
    $stmt->bindParam(':ano', $ano, PDO::PARAM_INT);
    $stmt->bindParam(':cor', $cor);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Modelo cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar modelo.";
    }
}
?>

<form method="POST" action="">
    <label>Nome do Modelo:</label><br>
    <input type="text" name="nome_modelo" required><br><br>

    <label>Ano:</label><br>
    <input type="number" name="ano" required><br><br>

    <label>Cor:</label><br>
    <input type="text" name="cor" required><br><br>

    <label>Preço:</label><br>
    <input type="number" step="0.01" name="preco" required><br><br>

    <label>Status:</label><br>
    <select name="status" required>
        <option value="Disponível">Disponível</option>
        <option value="Vendido">Vendido</option>
        <option value="Reservado">Reservado</option>
    </select><br><br>

    <label>Descrição:</label><br>
    <input type="text" name="descricao" required><br><br>

    <label>Marca:</label><br>
    <select disabled>
        <?php foreach($marcas as $marca): ?>
            <option><?= htmlspecialchars($marca['nome_marca']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Categoria:</label><br>
    <select name="id_categoria" required>
        <option value="">Selecione a Categoria</option>
        <?php foreach($categorias as $categoria): ?>
            <option value="<?= $categoria['id_categoria'] ?>">
                <?= htmlspecialchars($categoria['nome_categoria']) ?>
                (Marca ID: <?= $categoria['marca_id'] ?>)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Cadastrar Modelo</button>
</form>
