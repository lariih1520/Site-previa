<?php
    
    require_once('model/db_class.php');

    $conexao = new Mysql_db();
    $conect = $conexao->conectar();

    $pasta = "../imagens/";
    
    $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
 
    if(isset($_POST)){
        $nome_imagem = $_FILES['flFoto']['name'];
        //$tamanho_imagem = $_FILES['flFoto']['size'];
        
        $ext = strtolower(strrchr($nome_imagem,"."));
        
        if(in_array($ext, $permitidos)){
            $nome_atual = uniqid(time()).$ext;
            
            //$nome_atual = md5(uniqid(time())).$ext; //nome que dará a imagem
            $tmp = $_FILES['flFoto']['tmp_name'];

            if(move_uploaded_file($tmp, $pasta.$nome_atual)){

                mysqli_query($conect, 'insert into tbl_home_slide (imagem) values ("imagens/'.$nome_atual.'")');

                echo "<img src='../imagens/".$nome_atual."' id='previsualizar'>"; //imprime a foto na tela
            }else{
                echo "Falha ao enviar";
            }
            
        }else{
            echo "Somente são aceitos arquivos do tipo Imagem";
        }
        
    }else{
        echo "Selecione uma imagem";
        exit;
    }

?>
    