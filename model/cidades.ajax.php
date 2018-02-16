<?php
	
	include('db_class.php');

    $conexao = new Mysql_db();
    $conexao->conectar();

	$uf = mysql_real_escape_string( $_REQUEST['cod_estados'] );

	$cidades = array();

	$sql = "select * from tbl_cidade where uf = '".$uf."' ";
			
	$res = mysql_query( $sql );
	
	while ( $row = mysql_fetch_assoc( $res ) ) {
		$cidades[] = array(
			'cod_cidades'	=> $row['id_cidade'],
			'nome'			=> $row['cidade'],
		);
	}

	echo( json_encode( $cidades ) );