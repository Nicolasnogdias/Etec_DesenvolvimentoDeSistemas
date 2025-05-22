<?php
require 'conexao_socars.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_marca = $_POST['nome_marca'];

    $sql = "INSERT INTO marca (nome_marca) VALUES (:nome_marca)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome_marca', $nome_marca);

    if ($stmt->execute()) {
        echo "Marca cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar marca.";
    }
}
?>

<form method="POST" action="">
    <label>Nome da Marca:</label><br>
    <input type="text" name="nome_marca" required><br><br>
    <button type="submit">Cadastrar Marca</button>
</form>