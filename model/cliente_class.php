<?php
/**
    Data: 10/02/2018
    Objetivo: Controle de dados de clientes
    Arquivos relacionados: cliente_class.php
**/

class Cliente{
    
    public $estado;
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
    public $conect;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function Login($cliente){
        $sql = "select * from tbl_cliente where email = '".$cliente->email."' ";
        $sql = $sql." and senha = '".$cliente->senha."'";
        
        $select = mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            
            while($rs = mysqli_fetch_array($select)){
                $id = $rs['id_cliente'];
            }
            if(empty($_SESSION)){
                session_start();
            }
            
            $_SESSION['id_cliente'] = $id;
            
            mysqli_close($this->conect);
            
            if(!empty($_GET['redirect'])){
                $cod = $_GET['redirect'];
                $redirect = 'contratar.php?codigo='.$cod;
                
            }else{
                $redirect = 'perfil-cliente.php';
            }
            
            ?>
                <script>
                    window.location.href = "<?php echo $redirect ?>";
                </script>
            <?php
            //header('location:perfil-cliente.php');
            
        }else{
            mysqli_close($this->conect);
            if(!empty($_GET['redirect'])){
                $cod = $_GET['redirect'];
                $link = 'login.php?erro-ao-logar&redirect=contrate&codigo='.$cod;
                    
            }else{
                $link = 'login.php?erro-ao-logar';
            }
            
        ?>
            <script>
                window.location.href = "<?php echo $link ?>";
            </script>
        <?php
            //header('location:login.php?erro-ao-logar');
        }
        
    }
    
    public function SelectClienteById($id){
        $sql = 'select * from tbl_cliente where id_cliente = '.$id.';';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
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
                $cliente->cidade = $rs['cidade'];
                
                if(!empty($rs['enteresse'])){
                    $cliente->enteresse = $rs['enteresse'];
                    
                }else{
                    $cliente->enteresse = '';
                }
                
                $cliente->nmrenteresse = $rs['enteresse'];
                $cliente->dia = $dia;
                $cliente->mes = $mes;
                $cliente->ano = $ano;
                
            }
            
            mysqli_close($this->conect);
            return $cliente;
            
        } else {
            mysqli_close($this->conect);
            return false;
            
        }
        
        
    }
    
    public function InsertCliente($cliente){
        
        $sql = "select * from tbl_cliente where email = '".$cliente->email."' ";
        
        mysqli_query($this->conect, $sql);
        
        if (mysqli_affected_rows($this->conect) > 0) {
            
        ?>
            <script>
                window.location.href = "seja-cliente.php?erro=email";
            </script>

        <?php 
            //header('location:seja-cliente.php?erro=email');
            
        }else{
        
            $sql = "insert into tbl_cliente(nome, email, senha, sexo, celular, nasc, enteresse, cidade, uf, data_cadastro)";
            $sql = $sql." values ('".
                        $cliente->nome."', '".$cliente->email."' , '".$cliente->senha."', ".
                        $cliente->sexo.", '".$cliente->celular."', '".$cliente->nasc."', ".
                        $cliente->enteresse.", '".$cliente->cidade."', '".$cliente->estado."', '".$cliente->datetime."') ";
            
            if(mysqli_query($this->conect, $sql)){
                $sql = "select * from tbl_cliente where email = '".$cliente->email."' ";
        
                if($slct = mysqli_query($this->conect, $sql)){
                    
                    while($rs = mysqli_fetch_array($slct)){
                        $id = $rs['id_cliente'];
                        $_SESSION['id_cliente'] = $id;
                        mysqli_close($this->conect);
                        
                        ?>
                            <script>
                                window.location.href = "perfil-cliente.php";
                            </script>

                        <?php 
                        
                        //header('location:perfil-cliente.php?codigo='.$id);
                    }
                    
                }else{
                    
                    mysqli_close($this->conect);
                    
                    ?>
                        <script>
                            window.location.href = "login.php?perfil=cliente";
                        </script>

                    <?php 
                    
                    //header('location:login.php?perfil=cliente');
                }
                

            }else{
                
                ?>

                <script>
                    window.location.href = "filiado-fotos.php";
                </script>

                <?php 
                //header('location:index.php');
                //echo $sql;
            }
                    
            
            
        }
        
    }
    
    public function UpdateCliente($cliente){
        
        $sql = "select * from tbl_cliente where email = '".$cliente->email."' and id_cliente != ".$cliente->id;
        
        mysqli_query($this->conect, $sql);
        
        if (mysqli_affected_rows($this->conect) > 0) {
            
        ?>
            <script>
                window.location.href = "seja-cliente.php?erro=email";
            </script>

        <?php 
            
            //header('location:seja-cliente.php?erro=email');
            
        }else{
            
            $arq = basename($_FILES['flFotoPerfil']['name']);
            
            if($arq == null){
                
                $sql = "update tbl_cliente set nome = '".$cliente->nome."', email = '".$cliente->email."', ";
                $sql = 
                $sql."sexo = ".$cliente->sexo.", celular = '".$cliente->celular."', nasc = '". $cliente->nasc.
                    "', enteresse = ".$cliente->enteresse.",  uf = '".$cliente->uf."',  cidade = '".$cliente->cidade."'
                    where id_cliente = ".$cliente->id;

                if(mysqli_query($this->conect, $sql)){
                    
                    mysqli_close($this->conect);
        ?>
                    <script>
                        window.location.href = "perfil-cliente.php?editar=sucesso";
                    </script>
        <?php
                    
                    //header('location:perfil-cliente.php?editar=sucesso');
                    
                }else{
        ?>
                    <script>
                        window.location.href = "perfil-cliente.php?perfil=cliente&erro";
                    </script>
        <?php
                    //header('location:perfil-cliente.php?perfil=cliente&erro');
                    //echo $sql;
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
                        
                        if(mysqli_query($this->conect, $sql)){
                            
                            mysqli_close($this->conect);
                            
                            ?>
                                <script>
                                    window.location.href = "perfil-cliente.php?editar=sucesso";
                                </script>

                            <?php 
                            
                            //header('location:perfil-cliente.php?editar=sucesso');

                        }else{
                            mysqli_close($this->conect);
                            //header('location:perfil-cliente.php?perfil=cliente&erro');
                            echo $sql;
                        }


                    }else{
                        echo 'ERRO na imagem';
                    }

                }else{
                    mysqli_close($this->conect);
                    echo "<script> alert('Erro na extensão do arquivo'); </script>";
                    
                    ?>
                        <script>
                            window.location.href = "perfil-cliente.php?editar=erro";
                        </script>

                    <?php 
                }
            }
            
        }
        
    }
    
}