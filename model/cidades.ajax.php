<?php
	
	include('db_class.php');

    $conexao = new Mysql_db();
    $conect = $conexao->conectar();

	$uf = mysqli_real_escape_string($conect, $_REQUEST['cod_estados'] );

	$cidades = array();

	$sql = "select * from tbl_cidade where uf = '".$uf."' ";
			
	$res = mysqli_query($conect, $sql );
	
	while ( $row = mysqli_fetch_assoc( $res ) ) {
		$cidades[] = array(
			'cod_cidades'	=> $row['id_cidade'],
			'nome'			=> $row['cidade'],
		);
	}

    mysqli_close($conect);
        
	echo( json_encode( $cidades ) );