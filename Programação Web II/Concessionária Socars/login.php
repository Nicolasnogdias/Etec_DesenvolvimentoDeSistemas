<?php
session_start();
require 'conexao_socars.php';

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST['email_usuario'];
    $senha = $_POST['senha_usuario'];

    $sql = "SELECT * FROM usuario WHERE email = :email_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt ->bindParam(':email_usuario', $email);
    $stmt-> execute();

    $user = $stmt-> fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($senha, $user['senha'])) {
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['acesso'] = $user['acesso'];
        header('Location: home.php');
        exit;
    } else {
        echo 'Dados Inválidos!';
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulário de Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">

        <label for="email">E-mail:</label><br>
        <input type="email" name="email_usuario" required><br><br>

        <label for="senha">Senha:</label><br>
        <input type="password" name="senha_usuario" required><br><br>

        <input type="submit" value="Entrar">
    </form>
    <br>
    <a href="registro_user.php">
        <button> Deseja se cadastrar bobão?</button>
    </a>
</body>
</html>