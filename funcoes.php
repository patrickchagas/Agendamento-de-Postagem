<?php

	function publicarAgendado()
	{
		global $pdo;
		$dataAgora = date('d/m/Y H:i:s');

		$selecionar_agendados = $pdo->prepare("SELECT * FROM `posts` WHERE status = '0' AND agendado != '0000-00-00 00:00:00' ");
		$selecionar_agendados->execute();
		while ($pubAgd = $selecionar_agendados->fetchObject()):

			$data_banco = date("d/m/Y H:i:s", strtotime($pubAgd->agendado));
			if($data_banco <= $dataAgora):
				$atualizar = $pdo->prepare("UPDATE `posts` SET `status` = '1' WHERE id = ? ");
				$atualizar->execute(array($pubAgd->id));

			endif;	
		endwhile; 
	}

?>