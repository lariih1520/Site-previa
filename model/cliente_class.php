<?php
/**
    Data: 10/02/2018
    Objetivo: Controle de dados de clientes
    Arquivos relacionados: cliente_class.php
**/

class Cliente{
    
    public $id_estado;
    public $estado;
    public $id_cidade;
    public $cidade;
    public $uf;
    public $nome;
    public $email;
    public $senha;
    public $confrmSenha;
    public $sexo;
    public $celular;
    public $enteresse;
    public $nasc;
    public $foto;
    public $dia;
    public $mes;
    public $ano;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $conexao->conectar();
        
    }
    
    public function Login($cliente){
        $sql = "select * from tbl_cliente where email = '".$cliente->email."' ";
        $sql = $sql." and senha =  '".$cliente->senha."'";
        
        mysql_query($sql);
        
        if(mysql_affected_rows() > 0){
            echo ('Yeah você foi logado!');
            
        }else{
            header('location:login.php?erro-ao-logar');
        }
        
    }
    
    public function SelectClienteById($id){
        $sql = 'call VwDadosUsuarioById('.$id.')';
        
        if($select = mysql_query($sql)){
            
            $cont = 0;
            while($rs = mysql_fetch_array($select)){
                $cliente = new Cliente();
                
                $data = explode('-', $rs['nasc']);
                
                $ano = $data[0];
                $mes = $data[1];
                $dia = $data[2];
                
                $tel = explode(')', $rs['celular']);
                
                $telddd = explode('(', $tel[0]);
                $ddd = $telddd[1];
                $numero = $tel[1];
                
                $cliente->id = $rs['id_cliente'];
                $cliente->nome = $rs['nome'];
                $cliente->email = $rs['email'];
                $cliente->senha = $rs['senha'];
                $cliente->sexo = $rs['sexo'];
                $cliente->foto = $rs['foto_perfil'];
                $cliente->ddd = $ddd;
                $cliente->celular = $numero;
                $cliente->uf = $rs['uf'];
                $cliente->id_cidade = $rs['id_cidade'];
                $cliente->estado = $rs['estado'];
                $cliente->cidade = $rs['cidade'];
                $cliente->enteresse = $rs['enteresse'];
                $cliente->dia = $dia;
                $cliente->mes = $mes;
                $cliente->ano = $ano;
                
            }
            
            return $cliente;
            
        } else {
            return false;
            
        }
        
        
    }
    
    public function InsertCliente($cliente){
        
        $sql = "select * from tbl_cliente where email = '".$cliente->email."' ";
        
        mysql_query($sql);
        
        if (mysql_affected_rows() > 0) {
            header('location:seja-cliente.php?erro=email');
            
        }else{
        
            $sql = "insert into tbl_cliente(nome, email, senha, sexo, celular, nasc, enteresse)";
            $sql = $sql." values ('".
                        $cliente->nome."', '".$cliente->email."' , '".$cliente->senha."', ".
                        $cliente->sexo.", '".$cliente->celular."', '".$cliente->nasc."', ".
                        $cliente->slc_enteresse.") ";
            
            if(mysql_query($sql)){
                
                $sql = "select id_cliente from tbl_cliente where email = '".$cliente->email."' ";
                
                if($select = mysql_query($sql)){
                    
                    while($rs = mysql_fetch_array($select)){
                        $id = $rs['id_cliente'];
                    }
                    
                    $sql = "insert into tbl_cliente_endereco(id_cliente, id_cidade)";
                    $sql = $sql."values(".$id.", ".$cliente->cidade.")";
                    
                    
                    if(mysql_query($sql)){
                        //echo ('Cadastrado');
                        header('location:perfil-cliente.php?codigo='.$id);

                    }else{
                      header('location:index.php');

                    }
                    
                }
                    
            }
            
        }
        
    }
    
    public function SelectEstados(){
        $sql = "select * from db_tonight.tbl_estado";
        
        if($select = mysql_query($sql)){
           
            $cont = 0;
            while($rs = mysql_fetch_array($select)){
                
                $estado[] = new Cliente();
                
                $estado[$cont]->id_estado = $rs['id_estado'];
                $estado[$cont]->estado = $rs['estado'];
                $estado[$cont]->uf = $rs['uf'];
               
                $cont++;
            }
            return $estado;
            
        }else{
            return false;
            
        }
    }
    
    public function SelectCidade(){
        $sql = "select * from tbl_cidade";
        
        if($select = mysql_query($sql)){
           
            $cont = 0;
            while($rs = mysql_fetch_array($select)){
                
                $estado = new Cliente();
                
                $estado[$cont]->id_cidade = $rs['id_cidade'];
                $estado[$cont]->cidade = $rs['cidade'];
                $estado[$cont]->uf = $rs['uf'];
                
                $cont++;
            }
            return $estado;
            
        }else{
            return false;
            
        }
        
    }
    
    public function UpdateCliente($cliente){
        
        $sql = "select * from tbl_cliente where email = '".$cliente->email."' and id_cliente != ".$cliente->id;
        
        mysql_query($sql);
        
        if (mysql_affected_rows() > 0) {
            header('location:seja-cliente.php?erro=email');
            
        }else{
            
            $arq = basename($_FILES['flFotoPerfil']['name']);
            
            if($arq == null){
                
                $sql = "update tbl_cliente set nome = '".$cliente->nome."', email = '".$cliente->email."', ";
                $sql = 
                $sql."sexo = ".$cliente->sexo.", celular = '".$cliente->celular."', nasc = '".
                    $cliente->nasc."', enteresse = ".$cliente->enteresse." where id_cliente = ".$cliente->id;

                if(mysql_query($sql)){
                    header('location:perfil.php?perfil=cliente&editar=sucesso');
                    /*
                        $sql = "update tbl_cliente_endereco(id_cliente, id_cidade)";
                        $sql = $sql."values(".$id.", ".$cliente->cidade.")";

                        if(mysql_query($sql)){
                            header('location:perfil-cliente.php?codigo='.$id);

                        }else{
                          header('location:index.php');

                        }


                 */       
                
                }else{
                    //header('location:perfil.php?perfil=cliente&erro');
                    echo $sql;
                }
                
            }else{
                
                $imagem =  'midia/'.$arq;

                $extArq = strtolower(substr($arq, strlen($arq)-3, 3));

                if($extArq == 'jpg' || $extArq == 'png' || $extArq == 'jpeg' || $extArq == 'Bitmap'){
                    
                    if(move_uploaded_file($_FILES['flFotoPerfil']['tmp_name'], $imagem)){
                        
                        $sql = "update tbl_cliente set nome = '".$cliente->nome."', email = '".$cliente->email."', ";
                        $sql = 
                        $sql."sexo = ".$cliente->sexo.", celular = '".$cliente->celular."', nasc = '".
                            $cliente->nasc."', enteresse = ".$cliente->enteresse.", foto_perfil = '".$imagem."'
                            where id_cliente = ".$cliente->id;

                        if(mysql_query($sql)){
                            header('location:perfil.php?perfil=cliente&editar=sucesso');

                        }else{
                            //header('location:perfil.php?perfil=cliente&erro');
                            echo $sql;
                        }


                    }else{
                        echo 'ERRO na imagem';
                    }

                }else{
                    echo "<script> alert('Erro na extensão do arquivo'); </script>";
                }
            }
            
        }
        
    }
    
    public function SelectSugestoes($id){
        
    }
    
}