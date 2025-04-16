<?php
	$host = "localhost";
	$dbname = "livraria";
	$user = "root";
	$password = "";
	
	try 
	{
		$pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Conexão realizada com sucesso";
	}
	catch (PDOExcepetion $e) 
	{
		echo "Erro na conexão". $e->getMenssage();
	}
	$sql = "SELECT l.titulo, a.nome AS autor, e.nome AS editora FROM livros l JOIN autores a ON l.autor_id = a.id JOIN editoras e ON l.editora_id = e.id;";
	$result = $pdo->query($sql);
?>

<html>
	<head>
		<title> Seleção de livros</title>
	</head>
	<body>
		<h3>Lista de livros</h3>
		<table border=1>
			<tr>
				<th>Título</th>
				<th>Autor</th>
				<th>Editora</th>
			</tr>
			<?php
				foreach ($result as $livro) {
					echo "<tr>";
					echo "<td>".$livro['titulo']."</td>";
					echo "<td>".$livro['autor']."</td>";
					echo "<td>".$livro['editora']."</td>";
					echo "</tr>";
				}
			?>
		</table>
	</body>
</html>