<?php
require 'conexao_socars.php';

$sql = "SELECT mo.id, mo.nome_modelo, mo.preco, mo.motor, ma.nome_marca, mo.imagem
        FROM modelo mo 
        INNER JOIN marca ma ON ma.id = mo.id_marca
        INNER JOIN categoria c ON c.id = mo.id_categoria
        WHERE c.nome_categoria = 'Sedan'";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$modelos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
<body>

<h1>Modelos Sedan</h1>

<?php foreach ($modelos as $modelo): ?>
    <div>
        <img src="<?php echo htmlspecialchars($modelo['imagem']); ?>" alt="Imagem do modelo" width="200">
        <h3><?php echo htmlspecialchars($modelo['nome_modelo']); ?></h3>
        <p><strong>Preço:</strong> <?php echo htmlspecialchars($modelo['preco']); ?></p>
        <p><strong>Motor:</strong> <?php echo htmlspecialchars($modelo['motor']); ?></p>
        <p><strong>Marca:</strong> <?php echo htmlspecialchars($modelo['nome_marca']); ?></p>
        <a href="modelo_info.php?id=<?php echo $modelo['id']; ?>">
            <button type="button">Ver Mais</button>
        </a><br><br>
        <a href="edit.php?id=<?php echo $modelo['id']; ?>">
            <button type="button">Editar</button>
        </a>
    </div>
    <hr>
<?php endforeach; ?>
</body>
</html>
<script>
window.addEventListener('pageshow', function(event) {
    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        // Se foi acessado via cache do histórico, força recarregar
        window.location.reload();
    }
});
</script>