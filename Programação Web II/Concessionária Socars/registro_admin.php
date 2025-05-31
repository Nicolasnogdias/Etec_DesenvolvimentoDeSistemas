<?php
session_start();
require 'conexao_socars.php';

if (!isset($_SESSION['acesso']) || $_SESSION['acesso'] !== 'admin') {
    echo 'Permissão negada. Somente administradores podem interagir nesta página.';
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome_admin = $_POST['nome_admin'];
    $email_admin = $_POST['email_admin'];   
    $senha_admin = $_POST['senha_admin'];
    $acesso = 'admin';

    $senha_cript = password_hash($senha_admin, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuario (nome, email, senha, acesso) VALUES 
    (:nome, :email, :senha, :acesso)";
    $stmt = $pdo->prepare($sql);

    $stmt-> bindParam(':nome', $nome_admin);
    $stmt-> bindParam(':email', $email_admin);
    $stmt-> bindParam(':senha', $senha_cript);
    $stmt-> bindParam(':acesso', $acesso);

    if ($stmt -> execute()){
        $_SESSION['nome'] = $nome_admin;
        $_SESSION['email'] = $email_admin;
        $_SESSION['acesso'] = $acesso;
        header('Location: home.php');
    } else {
        echo "Erro ao cadastrar usuário.";
        
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulário de Cadastro</title>
</head>
<body>
    <h2>Registro de Administrador </h2>
    <form action="registro_admin.php" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome_admin" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" name="email_admin" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" name="senha_admin" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>


