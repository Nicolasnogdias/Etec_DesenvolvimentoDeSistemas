<?php
session_start();
require 'conexao_socars.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Document</title>
</head>
<body>
    <h1>EU NÃO AGUENTO MAIS</h1>
    <h1>SOCORRO EU JÁ NÃO AGUENTO MAIS</h1>

    <?php if (isset($_SESSION['acesso']) && $_SESSION['acesso'] == 'cliente'): ?>
        <h3>O seu acesso é de <?php echo htmlspecialchars($_SESSION['acesso']); ?></h3>
        <h3>O seu nome é <?php echo htmlspecialchars($_SESSION['nome']); ?></h3>
        <a href="logout.php"><button>Sair</button></a>

    <?php elseif (isset($_SESSION['acesso']) && $_SESSION['acesso'] == 'admin'): ?>
        <h3>O seu acesso é de <?php echo htmlspecialchars($_SESSION['acesso']); ?></h3>
        <h3>O seu nome é <?php echo htmlspecialchars($_SESSION['nome']); ?></h3>
        <a href="registro_admin.php"><p>CLIQUE AQUI PARA CADASTRAR ADMINISTRADORES</p></a>
        <a href="logout.php"><button>Sair</button></a>

    <?php else: ?>
        <a href="login.php"><button>Login</button></a><br><br>
        <a href="registro_user.php"><button>Deseja se cadastrar bobão?</button></a><br><br>
    <?php endif; ?>

</body>
</html>
