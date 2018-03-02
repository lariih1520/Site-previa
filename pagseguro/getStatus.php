<?php
	require_once("PagSeguro.class.php");

	if(isset($_GET['codigo'])){
		$PagSeguro = new PagSeguro();
		$P = $PagSeguro->getStatusByReference($_GET['codigo']);
		echo $PagSeguro->getStatusText($P->status);
	}else{
	    echo "Parâmetro \"reference\" não informado!";
	}

?>