<?php 

	date_default_timezone_set("America/Sao_Paulo");
	include_once 'config.php';
	include_once 'funcoes.php';
	publicarAgendado();
	
?>

<!DOCTYPE html="pt-br">
<html>
<head>
	<title>Publicação Agendada</title>
</head>


	<body bgcolor="#ebebeb">
		<ul>
			<?php 
				$selecionar_post = $pdo->prepare("SELECT * FROM `posts` WHERE `status` = '1' ");
				$selecionar_post->execute();
				while ($post = $selecionar_post->fetchObject()):
			?>
				<li><?php echo $post->titulo; ?></li>
			<?php endwhile ?>
		</ul>
	</body>
</html>