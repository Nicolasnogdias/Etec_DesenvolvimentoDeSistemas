<?php
session_start();
require 'conexao_socars.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_usuario = $_POST['nome_usuario']; 
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];
    $acesso_usuario = 'cliente';

    $validade = "SELECT * FROM usuario WHERE email = :email_usuario"; 
    $stmt = $pdo->prepare($validade); 
    $stmt ->bindParam(':email_usuario', $email_usuario); 
    $stmt-> execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC); 

    if ($usuario) {
        // REDIRECIONAMENTO
        echo "<script>
            alert('Email já cadastrado, redirecionando para o login.');
            window.location.href = 'login.php';
          </script>";
        exit;
    } else {
        $senha_hash = password_hash($senha_usuario, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuario (nome, email, senha, acesso) VALUES (:nome_usuario, :email_usuario, :senha_usuario, :acesso)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome_usuario', $nome_usuario);
        $stmt->bindParam(':email_usuario', $email_usuario);
        $stmt->bindParam(':senha_usuario', $senha_hash);
        $stmt->bindParam(':acesso', $acesso_usuario);
        
        if ($stmt->execute()) {
            $_SESSION['nome'] = $nome_usuario;
            $_SESSION['email'] = $email_usuario;
            $_SESSION['acesso'] = $acesso_usuario;
            header('Location: home.php');
        } else {
            echo "Erro!";
        }
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
    <h2>Registro de usuário </h2>
    <form action="registro_user.php" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome_usuario" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" name="email_usuario" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" name="senha_usuario" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
