<?php
	//BUSCA ALBUM PELO ID DO USUÁRIO - FOLHA DE CADASTRO DE ALBUM E POST
	function usuario_album($idUsuario){
		$PDO = db_connect();
		$sql = "SELECT idAlbum, album FROM album_usuarios where idUsuario = $idUsuario order by RAND() asc";
		$stmt = $PDO->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	//VERIFICA QUAIS AS PÁGINAS O USUÁRIO TEM ACESSO
	function usuario_pagina($idUsuario){
		$PDO = db_connect();
		$sql_pagina = "SELECT * FROM ext_paginas where idUsuario = $idUsuario OR idUsuario2 = $idUsuario OR idUsuario3 = $idUsuario order by nomePagina asc";
		$stmt_pagina = $PDO->prepare($sql_pagina);
		$stmt_pagina->execute();
		return $stmt_pagina;
	}
	//BUSCA TORRES
	function busca_torre ($preferencia){
		$PDO = db_connect();
		$sql_torre = "SELECT * FROM ext_torre WHERE setorTorre LIKE '%$preferencia%' order by RAND() LIMIT 10";
		$stmt_torre = $PDO->prepare($sql_torre);
		$stmt_torre->execute();
		return $stmt_torre;
	}
	//TOPO TORRES
	function topo_torre ($topoTorre){
		$PDO = db_connect();
		$sql_torre = "SELECT * FROM ext_torre WHERE idTorre = $topoTorre";
		$stmt_torre = $PDO->prepare($sql_torre);
		$stmt_torre->execute();
		$stmt_torre = $stmt_torre->fetch(PDO::FETCH_ASSOC);
		return $stmt_torre;
	}
	//CONSULTA A TORRE DE PREFERÊNCIA DO USUÁRIO - FOLHA DE CADASTRO
	function banco_torre($idAlbum){
		$PDO = db_connect();
		$sql_torre = "SELECT idTorre, nomeTorre FROM ext_torre where torreSistema = 'sim' order by RAND() asc";
		$stmt_torre = $PDO->prepare($sql_torre);
		$stmt_torre->execute();
		return $stmt_torre;
	}
	//FILTRO PARA APRESENTAÇÃO - PÁGINA DE INICIO
	function pagina_inicio ($postagem){
		$PDO = db_connect();
		$sql_inicio = "SELECT * FROM ext_fans FROM idUsuario = $idLogado";
		$sql_inicio = $PDO->prepare($sql_inicio);
		$sql_inicio->execute();
	}
	// CONSULTA PARA SABER SE ALBUM PERTENCE AO USUÁRIO QUE ESTA EDITANDO
	// BUSCA OS ALBUNS DO USUÁRIO COM PARÂMETRO INFORMADO VIA GET
	//verifica o nome do album
	function banco_album($idLogado, $idAlbum){
		$PDO = db_connect();
		$sql_album = "SELECT album FROM album_usuarios where idUsuario = $idLogado and idAlbum = $idAlbum";
		$stmt_album = $PDO->prepare($sql_album);
		$stmt_album->execute();
		$albumResposta = $stmt_album->fetch(PDO::FETCH_ASSOC);
		return $albumResposta;
	}
	//contar os registros / ALBUNS DO USUÁRIO
	function album_total($idLogado){
		$PDO = db_connect();
		$sql_count = "SELECT COUNT(*) AS total FROM album_usuarios where idUsuario = $idLogado ORDER BY album ASC";
		$stmt_count = $PDO->prepare($sql_count);
		$stmt_count->execute();
		$total = $stmt_count->fetchColumn();
		return $total;
	}
	//criar um loop com as informações do album
	function album_while($idLogado){
		$PDO = db_connect();
		$sql = "SELECT * FROM album_usuarios where idUsuario = $idLogado order by album asc";
		$stmt = $PDO->prepare($sql);
		$stmt->execute();
		return $stmt;
	}


	//CONSULTA AS IMAGENS QUE PERTENCE AO ALBUM SELECIONADO
	function banco_imagem($idAlbum){
		$PDO = db_connect();
		$sql_fotos = "SELECT * FROM img_usuarios where usuEstilo = $idAlbum"; //arrumar id estilo porque não pesquisa mais pelo id
		$albumImagemResposta = $PDO->prepare($sql_fotos);
		$albumImagemResposta->execute();
		return $albumImagemResposta;
	}
	


	//CONSULTA PARA EXIBIR OS CONTEÚDOS DA PÁGINA PRINCIPAL

	//contar os registros / ALBUNS PARA POSTAGEM
	function inicio_total($idTorre){
		try{
		$PDO = db_connect();
		$sql_count = "SELECT COUNT(*) AS total FROM img_usuarios where publicarTorre = $idTorre";
		$stmt_count = $PDO->prepare($sql_count);
		$stmt_count->execute();
		$total = $stmt_count->fetchColumn();
		return $total;
	}catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
}

	// BUSCA NO BANCO DE DADOS DE IMAGENS
	function banco_inicio($idTorre, $inicio, $fim){
		try{
		$PDO = db_connect();
		$sql_fotos = "SELECT * FROM img_usuarios where publicarTorre = $idTorre ORDER BY idImg desc LIMIT $inicio, $fim";
		$albumImagemResposta = $PDO->prepare($sql_fotos);
		$albumImagemResposta->execute();
		return $albumImagemResposta;
		}catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
	}



?>