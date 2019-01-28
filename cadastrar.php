<?php 

	date_default_timezone_set("America/Sao_Paulo");
	include_once 'config.php';
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Publicação Agendada - Cadastrar</title>
</head>

	<body bgcolor="#ebebeb">
		<?php 

			if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') :
				$filtrar = array(
					'titulo' => FILTER_SANITIZE_STRING,
					'agendado'=> FILTER_SANITIZE_STRING
				);

				$posts = filter_input_array(INPUT_POST, $filtrar);

				if($posts['titulo'] == ''):

					echo "Preencha o titulo!";

				elseif ($posts['agendado'] == ''):
					//SE COLOCAR SEM DATA DE AGENDAMENTO
					$data_agendar = '0000-00-00 00:00:00';
					$inserir = $pdo->prepare("INSERT INTO `posts` SET `titulo` = ?, agendado = ?, status = ? ");
					if($inserir->execute(array($posts['titulo'], $data_agendar, 1))):
						echo "Post publicado com sucesso";
					endif;

				else:
					//QUANDO COLOCAR UMA DATA DE AGENDAMENTO
					$separar = explode(' ', $posts['agendado']);
					$separar_data = explode('/', $separar[0]);
					$data_agendar = $separar_data[2].'-'.$separar_data[1].'-'. $separar_data[0].' '.$separar[1].':00';

					$inserir = $pdo->prepare("INSERT INTO `posts` SET `titulo` = ?, agendado = ?, status = ? ");
					if($inserir->execute(array($posts['titulo'], $data_agendar, 0))):
						echo "Publicação agendada com sucesso";
					endif;	

				endif;	
			endif;	
		?>
		<form action="" method="post" enctype="multipart/form-data">
			<label>
				<span>Titulo</span><br>
				<input type="text" name="titulo">
			</label><br/>

			<label>
				<span>Agendar para:</span><br>
				<input type="text" name="agendado" id="data">
			</label><br/>

			<input type="hidden" name="acao" value="cadastrar">
			<input type="submit" value="Cadastrar">

		</form>
	</body>
</html>