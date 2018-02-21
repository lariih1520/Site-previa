<?php
/**
    Data: 10/02/2018
    Objetivo: Controle de dados de clientes
    Arquivos relacionados: cliente_class.php
**/

class Cliente{
    
    public $id_estado;
    public $estado;
    public $codigo_uf;
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
    public $datetime;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $conexao->conectar();
        
    }
    
    public function Login($cliente){
        $sql = "select * from tbl_cliente where email = '".$cliente->email."' ";
        $sql = $sql." and senha =  '".$cliente->senha."'";
        
        $select = mysql_query($sql);
        
        if(mysql_affected_rows() > 0){
            
            while($rs = mysql_fetch_array($select)){
                $id = $rs['id_cliente'];
            }
            session_start();
            $_SESSION['id_cliente'] = $id;
            
            header('location:perfil-cliente.php');
            
        }else{
            header('location:login.php?erro-ao-logar');
        }
        
    }
    
    public function SelectClienteById($id){
        $sql = 'call VwDadosUsuario('.$id.')';
        
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
                $ddd = $telddd[0];
                $numero = $tel[0];
                
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
                
                if(!empty($rs['enteresse'])){
                    $cliente->enteresse = $rs['enteresse'];
                    
                }else{
                    $cliente->enteresse = '';
                }
                
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
        
            $sql = "insert into tbl_cliente(nome, email, senha, sexo, celular, nasc, enteresse, id_cidade, data_cadastro)";
            $sql = $sql." values ('".
                        $cliente->nome."', '".$cliente->email."' , '".$cliente->senha."', ".
                        $cliente->sexo.", '".$cliente->celular."', '".$cliente->nasc."', ".
                        $cliente->enteresse.", ".$cliente->id_cidade.", '".$cliente->datetime."') ";
            
            if(mysql_query($sql)){
                $sql = "select * from tbl_cliente where email = '".$cliente->email."' ";
        
                if($slct = mysql_query($sql)){
                    
                    while($rs = mysql_fetch_array($slct)){
                        $id = $rs['id_cliente'];
                        /******
                            Codigo da session aqui
                        ******/
                        header('location:perfil.php?perfil=cliente&codigo='.$id);
                    }
                    
                }else{
                    header('location:login.php?perfil=cliente');
                }
                

            }else{
              //header('location:index.php');
                echo $sql;
            }
                    
            
            
        }
        
    }
    
    public function SelectEstados(){
        
        /******** ERRAAADO *********/
        if ($slct = mysql_query("select * from tbl_estado") ) {
           
            $conta = 0;
            while($rst = mysql_fetch_array($slct)){
                
                $estado[] = new Cliente();
                
                $estado[$conta]->id_estado = $rst['id_estado'];
                $estado[$conta]->codigo_uf = $rst['codigo_uf'];
                $estado[$conta]->estado = $rst['estado'];
                $estado[$conta]->uf = $rst['uf'];
               
                $conta++;
                
            }
            return $estado;
            
        } else {
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
                    $cliente->nasc."', enteresse = ".$cliente->enteresse.",  id_cidade = '".$cliente->id_cidade."'
                    where id_cliente = ".$cliente->id;

                if(mysql_query($sql)){
                    header('location:perfil.php?perfil=cliente&editar=sucesso');
                    
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
                            /*    , id_cidade = '".$cliente->id_cidade."'   */
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