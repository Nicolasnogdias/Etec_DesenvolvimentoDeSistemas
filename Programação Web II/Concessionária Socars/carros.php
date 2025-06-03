<?php
require 'conexao_socars.php';

// Pega todas as marcas para popular o select
$marcas = $pdo->query("SELECT * FROM marca")->fetchAll(PDO::FETCH_ASSOC);

// Pega o filtro da marca pela URL (GET)
$filtroMarca = $_GET['id_marca'] ?? '';

// Monta a consulta base
$sql = "SELECT mo.id, mo.nome_modelo, mo.preco, mo.motor, ma.nome_marca, mo.imagem
        FROM modelo mo 
        INNER JOIN marca ma ON ma.id = mo.id_marca";

// Se tiver filtro, adiciona condição WHERE
$params = [];
if ($filtroMarca) {
    $sql .= " WHERE ma.id = :id_marca";
    $params[':id_marca'] = $filtroMarca;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$modelos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<body>
<h1>Todos os Carros</h1>

<!-- Formulário para filtro -->
<form method="GET" action="">
    <label>Filtrar por marca:</label><br>
    <select name="id_marca" onchange="this.form.submit()">
        <option value="">Todas as marcas</option>
        <?php foreach($marcas as $marca): ?>
            <option value="<?= $marca['id'] ?>" <?= ($marca['id'] == $filtroMarca) ? 'selected' : '' ?>>
                <?= htmlspecialchars($marca['nome_marca']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<hr>

<!-- Listagem dos modelos -->
<?php foreach ($modelos as $modelo): ?>
    <div>
        <img src="<?= htmlspecialchars($modelo['imagem']) ?>" alt="Imagem do modelo" width="200">
        <h3><?= htmlspecialchars($modelo['nome_modelo']) ?></h3>
        <p><strong>Preço:</strong> <?= htmlspecialchars($modelo['preco']) ?></p>
        <p><strong>Motor:</strong> <?= htmlspecialchars($modelo['motor']) ?></p>
        <p><strong>Marca:</strong> <?= htmlspecialchars($modelo['nome_marca']) ?></p>
        <a href="modelo_info.php?id=<?= $modelo['id'] ?>">
            <button type="button">Ver Mais</button>
        </a>
    </div>
    <hr>
<?php endforeach; ?>

</body>
</html>
