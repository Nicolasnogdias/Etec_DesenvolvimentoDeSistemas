<?php
require 'conexao_socars.php';

// Cadastro da categoria
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_categoria = $_POST['nome_categoria'];

    $sql = "INSERT INTO categoria (nome_categoria) VALUES (:nome_categoria)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome_categoria', $nome_categoria);

    if ($stmt->execute()) {
        header("Location: cadastrar_modelo.php?sucesso=categoria");
        exit();
    } else {
        header("Location: cadastrar_categoria.php?erro=categoria");
        exit();
    }
}
?>
<form method="POST" action="">
    <label>Nome da Categoria:</label><br>
    <input type="text" name="nome_categoria" required><br><br>
    <button type="submit">Cadastrar Categoria</button>
</form>