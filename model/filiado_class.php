<?php
/**
    Data: 10/02/2018
    Objetivo: Controle de dados de clientes
    Arquivos relacionados diretamente: 
        filiado_controller.php,
        pagseguro/notificacao.php
**/

class Acompanhante{
    
    public $cidade;
    public $uf;
    public $nome;
    public $sobrenome;
    public $cpf;
    public $cpfdc;
    public $cvv;
    public $cvvdc;
    public $numero_cartao;
    public $numero_cartaodc;
    public $expiracaoMes;
    public $expiracaoAno;
    public $email;
    public $senha;
    public $confrmSenha;
    public $sexo;
    public $celular1;
    public $celular2;
    public $ddd1;
    public $ddd2;
    public $nasc;
    public $foto;
    public $dia;
    public $mes;
    public $ano;
    public $datetime;
    public $id_etnia;
    public $etnia;
    public $apresentacao;
    public $altura;
    public $peso;
    public $conect;
    public $nmr;
    public $cor_cabelo;
    public $cobrar;
    public $acompanha;
    public $formaPagar;
    public $id_transfer;
    public $id_midia;
    public $excluido;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    /* Login do acompanhante */
    public function Login($filiado){
        $sql = "select * from tbl_filiado where email = '".$filiado->email."' ";
        $sql = $sql." and senha =  '".$filiado->senha."'";
        
        $select = mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            
            while($rs = mysqli_fetch_array($select)){
                $id = $rs['id_filiado'];
                $foto_perfil = $rs['foto_perfil'];
                $excluido = $rs['excluido'];
            }
            
            if($excluido == null or $excluido == 0000-00-00){
                $_SESSION['id_filiado'] = $id;
            
                if(empty($foto_perfil)){
                    mysqli_close($this->conect);
                
    ?>
            <script>
                window.location.href = "filiado-fotos.php";
            </script>

    <?php       }else{
                    $sql = "select * from tbl_filiado_midia where id_filiado = ".$id;
                    mysqli_query($this->conect, $sql);
                  
                    if(mysqli_affected_rows($this->conect) > 0){
                    mysqli_close($this->conect);
    ?>
                <script> window.location.href = "perfil-filiado.php"; </script>

    <?php           }else{ 
                    mysqli_close($this->conect);
    ?>
            <script>  window.location.href = "filiado-fotos.php";  </script>
    <?php
                    }

                }
            }else{
    ?>
                <script> window.location.href = "login.php?login=acompanhante&erro=contaexcluida"; </script>

    <?php
        
            }
            
        }else{
            mysqli_close($this->conect);
            
        ?>
            <script>
                window.location.href = "login.php?login=acompanhante&erro=login";
            </script>
        <?php
            
        }
        
    }
    
    /* Buscar dados do aompanhante  */
    public function SelectFiliadoById(){
        if(empty($_GET['codigo'])){
            $id = $_SESSION['id_filiado'];
        }else{
            $id = $_GET['codigo'];
        }

        $sql = 'select fi.*, et.*, ca.cor as cabelo, tc.foto,
                tc.titulo, tc.valor as valor_conta, tc.video
                from tbl_filiado as fi
                inner join tbl_etnia as et
                on fi.etnia = et.id_etnia
                inner join tbl_tipo_conta as tc
                on tc.id_tipo_conta = fi.id_tipo_conta
                left join tbl_cabelo as ca
                on fi.id_cabelo = ca.id_cabelo
                where fi.id_filiado = '.$id.'';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $filiado = new Acompanhante();
                
                $tel1 = explode(')', $rs['celular1']);
                
                $telddd1 = explode('(', $tel1[0]);
                $ddd1 = $telddd1[1];
                $numero1 = $tel1[1];
                
                if($rs['celular2'] != null){
                    $tel2 = explode(')', $rs['celular2']);

                    $telddd2 = explode('(', $tel2[0]);
                    $ddd2 = $telddd2[1];
                    $numero2 = $tel2[1];
                    
                    $filiado->ddd2 = $ddd2;
                    $filiado->celular2 = $numero2;
                    
                }else{
                    $filiado->celular2 = 'vazio';
                }
                
                $filiado->ddd1= $ddd1;
                $filiado->celular1 = $numero1;
                $filiado->estado = $rs['uf'];
                $filiado->cidade = $rs['cidade'];
                $filiado->nome = $rs['nome'];
                $filiado->apelido = $rs['apelido'];
                $filiado->email = $rs['email'];
                $filiado->senha = $rs['senha'];
                
                if($rs['sexo'] == 1){
                    $filiado->sexo = 'Feminino';
                    
                }elseif($rs['sexo'] == 2){
                    $filiado->sexo = 'Masculino';
                }
                
                if($rs['apresentacao'] == null or $rs['apresentacao'] == 0){
                    $filiado->apresentacao = 'Não há apresentação';
                    
                }else{
                    $filiado->apresentacao = $rs['apresentacao'];
                }
                
                if($rs['acompanha'] == 1){
                    $filiado->acompanha = 'Mulheres';
                    
                }elseif($rs['acompanha'] == 2){
                    $filiado->acompanha = 'Homens';
                    
                }elseif($rs['acompanha'] == 3){
                    $filiado->acompanha = 'Homens e mulheres';
                }
                
                $data = explode('-', $rs['nasc']);
                
                $ano = $data[0];
                $mes = $data[1];
                $dia = $data[2];
                
                $filiado->uf = $rs['uf'];
                $filiado->cidade = $rs['cidade'];
                $filiado->cobrar = $rs['cobrar'];
                
                if($rs['foto_perfil'] != null){
                    $filiado->foto = $rs['foto_perfil'];
                }else{
                    if($rs['sexo'] == 1){
                        $filiado->foto = 'icones/usuaria.jpg';
                    }else{
                        $filiado->foto = 'icones/usuario.jpg';
                    }
                }
                
                if($rs['foto_perfil'] == false){
                    if($rs['sexo'] == 1){
                        $filiado->foto = 'icones/usuaria.jpg';
                    }else{
                        $filiado->foto = 'icones/usuario.jpg';
                    }
                }
                
                $filiado->id_filiado = $rs['id_filiado'];
                $filiado->idetnia = $rs['id_etnia'];
                $filiado->etnia = $rs['etnia'];
                $filiado->cabelo = $rs['cabelo'];
                
                $alt = explode('.', $rs['altura']);
                $filiado->altura = $alt[0].','.$alt[1];
                
                
                $filiado->peso = $rs['peso'];
                $filiado->titulo = $rs['titulo'];
                $filiado->valor = $rs['valor_conta'];
                $filiado->qtd_fotos = $rs['foto'];
                $filiado->qtd_videos = $rs['video'];
                $filiado->dia = $dia;
                $filiado->mes = $mes;
                $filiado->ano = $ano;
                $filiado->excluido = $rs['excluido'];
                
            }
            
            return $filiado;
            
            mysqli_close($this->conect);
            
        } else {
            
            mysqli_close($this->conect);
            return false;
            
        }
    }
    
    /* Cadastrar novo acompanhante no site */
    public function InsertFiliado($tipo_conta){
        
        $filiado = new Filiado();
        $fld = $filiado->getFiliado();
        
        /* Pegar data de cadastro */
        date_default_timezone_set('America/Sao_Paulo');
        $datetime = (date('Y/m/d H:i'));
        
        if($fld->peso == null){ $fld->peso = 0; }
        
        $sql = "insert into tbl_filiado(nome, apelido, nasc, email, senha, celular1, celular2, etnia, sexo,
                altura, peso, acompanha, id_tipo_conta, cidade, uf, cobrar, data_cadastro, conta_ativa, status)
                values ('".$fld->nome."', '".
                         $fld->apelido."', '".
                         $fld->nasc."', '".
                         $fld->email."', '".
                         $fld->senha."', '".
                         $fld->celular1."', '".
                         $fld->celular2."', ".
                         $fld->etnia.", ".
                         $fld->sexo.", ".
                         $fld->altura.", ".
                         $fld->peso.", ".
                         $fld->acompanha.", ".
                         $tipo_conta.", '".
                         $fld->cidade."', '".
                         $fld->estado."', ".
                         $fld->cobra.", '".
                         $datetime."', 1, 1)";
        
        if(mysqli_query($this->conect, $sql)){
            
            /* Pegar id do acompanhante através do email cadastrado */
            $sql = 'select * from tbl_filiado where email = "'.$fld->email.'" ';
            
            if($select = mysqli_query($this->conect, $sql)){
                
                while($rs = mysqli_fetch_array($select)){
                    $_SESSION['id_filiado'] = $rs['id_filiado'];
                    $cpf = base64_encode($fld->cpf);
                    $sql2 = "insert into tbl_pagamento_filiado (id_filiado, cpf) values (".$rs['id_filiado'].", '".$cpf."')";
                    mysqli_query($this->conect, $sql2);
                    
                    $desconto = new Acompanhante();
                    $desc = $desconto->getStatusDesconto($tipo_conta);
                    
                    if($desc != 2){//Se a promoção está ativa
                        if($desc['status'] == 1){

                            $date = date('Y-m');
                            $time = date('H:i');
                            $dt = $date.'-10 '.$time;
                            $sql = "insert into tbl_mensalidade ";
                            $sql = $sql."(id_filiado, data_hora, valor, status, desconto, code, referencia, forma)";
                            $sql = $sql." values (".$rs['id_filiado'].", '".$dt."', 0, 3, ".$desc['valor'];
                            $sql = $sql.", 'ref".date('m-d')."', 'mensal".$rs['id_filiado']."', 'promocao')";
                            mysqli_query($this->conect, $sql);
                            
                            if(date('d') >= 28){
                                $ano = date('Y');
                                $mes = date('m');
                                $mes = $mes + 1;
                                $time = date('H:i');

                                if($mes <= 9){
                                    $mes = '0'.$mes;
                                }else{
                                    if($mes == 12){
                                        $mes = '01';
                                    }
                                }

                                $dt = $ano.'-'.$mes.'-10 '.$time;
                                $sql = "insert into tbl_mensalidade ";
                                $sql = $sql."(id_filiado, data_hora, valor, status, desconto, code, referencia, forma)";
                                $sql = $sql." values (".$rs['id_filiado'].", '".$dt."', 0, 3, ".$desc['valor'];
                                $sql = $sql.", 'ref".date('m-d')."', 'mensal".$rs['id_filiado']."', 'promocao')";
                                mysqli_query($this->conect, $sql);
                            }
                        }
                    }
                    
                   ?> <script> window.location.href = "filiado-fotos.php"; </script> <?php
                    
                }
                
            }else{
                
                ?> <script> window.location.href = "seja-filiado.php?Erro=cadastro&#erro"; </script> <?php
                    
            }
            
        }else{
            
            ?> <script> window.location.href = "seja-filiado.php?Erro=cadastro&#erro"; </script> <?php
        }
        
    }
    
    /* Verificar se há desconto */
    public function getStatusDesconto($tipo_conta){
        $sql = "select * from tbl_desconto";
        
        if($select = mysqli_query($this->conect, $sql)){

            while($rs = mysqli_fetch_array($select)){
                
                if($tipo_conta != null){
                    $sql2 = "select * from tbl_tipo_conta where id_tipo_conta = ".$tipo_conta;

                    if($select2 = mysqli_query($this->conect, $sql2)){
                        while($rs2 = mysqli_fetch_array($select2)){

                            $desc = [
                                "status" => $rs['status'],
                                "valor" => $rs2['valor'],
                            ];

                        }

                    }else{
                        $desc = 2;
                    }
                }else{
                    $desc = [ "status" => $rs['status'] ];
                }
            }
            return $desc;
        }else{
            return 2;
        }
        
    }
    
    /* Cadastrar dados do pagamento */
    public function InsertDadosPag($dadosPag){
        
        $q = $_GET['q'];
        $id = $_SESSION['id_filiado'];
        $forma = $dadosPag->formaPagar;
        
        if($q == 'pagar'){
            $link = 'pagar-mensalidade.php?confirmar&forma='.$forma;
            
        }elseif($q == 'dados-private'){
            $link = 'perfil-filiado.php';
        }
        
        $sql = 'select * from tbl_pagamento_filiado where id_filiado = '.$id;
        
        mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            $dadosPag->id = $id;
            $update = new Acompanhante();
            $update->UpdateDadosPag($dadosPag);
            
        }else{
            
            $sql = 'insert into tbl_pagamento_filiado (
            id_filiado, nome, sobrenome, telefone, rua, numero, bairro,
            cidade, uf, cep, desconto, cpf, numero_cartao,
            cvv, expiracaoMes, expiracaoAno)';
            
            $sql = $sql.'values ('.$id.', "'.$dadosPag->nome.'", "'.$dadosPag->sobrenome.'",
            "'.$dadosPag->telefone.'", "'.$dadosPag->rua.'", '.$dadosPag->numero.', "'.$dadosPag->bairro.'",
            "'.$dadosPag->cidade.'", "'.$dadosPag->uf.'", "'.$dadosPag->cep.'", 0, "'.$dadosPag->cpf.'",
            "'.$dadosPag->numeroCartao.'", "'.$dadosPag->cvv.'",
            "'.$dadosPag->mesExpira.'", "'.$dadosPag->anoExpira.'")';
            
            if(mysqli_query($this->conect, $sql)){
               
            
            ?> <script>  window.location.href = "<?php echo $link ?>"; </script> <?php
                
            }else{
                $link = $link.'?Erro';
                
            ?> <script> window.location.href = "<?php echo $link ?>"; </script> <?php
                
                //echo $sql;
                //header('location:'.$link.'?Erro');
            }
            
            
        }
        
    }
    
    /* Cadastrar novo acompanhante no site */
    public function UpdateDados($fld){
        
        $sql = "update tbl_filiado set ";
        
        $sql = $sql."nome = '".$fld->nome."' ";
        
        if($fld->apelido != null){
            $sql = $sql.", apelido = '".$fld->apelido."'";
        }
        
        if($fld->nasc != null and $fld->nasc != 0){
            $sql = $sql.", nasc = '".$fld->nasc."'";
        }
        
        if($fld->email != null){
            $sql = $sql.", email = '".$fld->email."'";
        }
        
        if($fld->celular1 != null){
            $sql = $sql.", celular1 = '".$fld->celular1."'";
        }
        
        if($fld->celular2 != null){
            $sql = $sql.", celular2 = '".$fld->celular2."'";
        }
        
        if($fld->etnia != 0){
            $sql = $sql.", etnia = ".$fld->etnia."";
        }
        
        if($fld->cor_cabelo != 0){
            $sql = $sql.", id_cabelo = ".$fld->cor_cabelo."";
        }
        
        if($fld->sexo != 0){
            $sql = $sql.", sexo = ".$fld->sexo."";
        }
        
        if($fld->altura != null and $fld->altura != 0){
            $sql = $sql.", altura = ".$fld->altura."";
        }
        
        if($fld->peso != null and $fld->peso != 0){
            $sql = $sql.", peso = ".$fld->peso."";
        }
        
        if($fld->acompanha != null and $fld->acompanha != 0){
            $sql = $sql.", acompanha = ".$fld->acompanha."";
        }
        
        if($fld->cidade != null){
            $sql = $sql.", cidade = '".$fld->cidade."'";
        }
        
        if($fld->estado != null){
            $sql = $sql.", uf = '".$fld->estado."'";
        }
        
        if($fld->cobrar != null and $fld->cobrar != 0){
            $sql = $sql.", cobrar = ".$fld->cobrar."";
            
        }
        if($fld->apresentacao != null){
            $sql=$sql.", apresentacao='".$fld->apresentacao."'";
            
        }
        if($fld->senha != 1){
            $sql=$sql.", senha = '".$fld->senha."'";
            
        }
        $sql = $sql." where id_filiado = ".$fld->id;
           
        if(mysqli_query($this->conect, $sql)){
                
        ?> <script> window.location.href = "perfil-filiado.php"; </script> <?php

        }else{
        
        ?> <script> window.location.href = "perfil-filiado.php?ERRO"; </script> <?php
            
        }
        
    }
    
    /* Atualizar plano */
    public function UpdatePlano(){
        
        $id = $_SESSION['id_filiado'];
        $contaAnterior = $_POST['txtConta'];
        $tipo = $_POST['txtTipo'];
        
        $sql = "select * from tbl_tipo_conta where id_tipo_conta = ".$contaAnterior;
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                $id_conta_anterior = $rs['id_tipo_conta'];
                $foto_anterior = $rs['foto'];
                $video_anterior = $rs['video'];
            }
        }
        
        $sql = "select * from tbl_tipo_conta where id_tipo_conta = ".$tipo;
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                $id_conta_atual = $rs['id_tipo_conta'];
                $foto_atual = $rs['foto'];
                $video_atual= $rs['video'];
            }
        }
        
        if($foto_anterior > $foto_atual){ //SE A QTD DE FOTOS DA CONTA ANTIGA FOR MAIOR DO QUE A ATUAL
            
            $sql = "select * from tbl_filiado_midia where descricao = 1 and id_filiado = ".$id;
            
            if($select = mysqli_query($this->conect, $sql)){
                $cont = 0;
                while($rs = mysqli_fetch_array($select)){
                    
                    if($cont >= $foto_atual){
                        $id_foto[$cont] = $rs['id_filiado_midia'];
                    }
                    $cont++;
                }
            }
            
            if($cont > $foto_atual){
                while($cont > $foto_atual){
                    $sql = "delete from tbl_filiado_midia where id_filiado_midia =".$id_foto[$foto_atual]." and id_filiado = ".$id;
                    mysqli_query($this->conect, $sql);
                    $foto_atual++;
                }
                
            }
            
            $alteração = true;
            
        }else{
            $alteração = true;
        }
        
        if($video_anterior > $video_atual){ //SE A QTD DE VIDEOS DA CONTA ANTIGA FOR MAIOR DO QUE A ATUAL
            $cont = 0;
            $sql = "select * from tbl_filiado_midia where descricao = 2 and id_filiado = ".$id;
            
            if($select = mysqli_query($this->conect, $sql)){
                
                while($rs = mysqli_fetch_array($select)){
                    
                    if($cont >= $foto_atual){
                        $id_video[$cont] = $rs['id_filiado_midia'];
                    }
                    $cont++;
                }
            }
            
            if($cont > $video_atual){
                while($cont > $video_atual){
                    $sql = "delete from tbl_filiado_midia where id_filiado_midia = ".$id_video[$video_atual]." and id_filiado = ".$id;
                    
                    mysqli_query($this->conect, $sql);
                    $video_atual++;
                    
                }
                
            }
            $alteração = true;
            
        }else{
            $alteração = true;
        }
        
        if($alteração == true){

            $sql = "update tbl_filiado set id_tipo_conta = ".$tipo."
                    where id_filiado = ".$id;

            if(mysqli_query($this->conect, $sql)){

                ?> <script> window.location.href = "perfil-filiado.php?Sucesso"; </script> <?php

                //header('location:perfil-filiado.php?Sucesso');
            }else{
                echo "<script>alert('Não foi possivel realizar a alteração')</script>";

                ?> <script> window.location.href = "perfil-filiado.php?Erro&#tipo_conta"; </script> <?php
                //header('location:perfil-filiado.php?Erro&#tipo_conta');
            }
        }else{
            echo "<script>alert('Não foi possivel realizar a alteração')</script>";
            ?> <script> window.location.href = "perfil-filiado.php?Erro&#tipo_conta"; </script> <?php
        }
    }
    
    /* Alterar Dados do Pagamento */
    public function UpdateDadosPag($dadosPag){
        $q = $_GET['q'];
        $forma = $dadosPag->formaPagar;
        $id = $_SESSION['id_filiado'];
        
        if($q == 'pagar'){
            $link = 'pagar-mensalidade.php?confirmar&forma='.$forma;
            
        }elseif($q =='dados-private'){
            $link = 'perfil-filiado.php';
        }
        
        $id = $dadosPag->id;
        $sql = 'select * from tbl_pagamento_filiado where id_filiado = '.$id;
        
        mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) > 0){
            
            if($forma == 'card' or !empty($dadosPag->numeroCartao)){
                $sql = 'update tbl_pagamento_filiado set nome = "'.$dadosPag->nome.'",
                sobrenome = "'.$dadosPag->sobrenome.'", telefone = "'.$dadosPag->telefone.'",
                rua = "'.$dadosPag->rua.'",
                numero = '.$dadosPag->numero.', bairro = "'.$dadosPag->bairro.'",
                cidade = "'.$dadosPag->cidade.'",
                uf = "'.$dadosPag->uf.'", cep = "'.$dadosPag->cep.'",
                cpf = "'.$dadosPag->cpf.'", numero_cartao = "'.$dadosPag->numeroCartao.'",
                cvv = "'.$dadosPag->cvv.'",
                expiracaoMes = "'.$dadosPag->mesExpira.'",
                expiracaoAno = "'.$dadosPag->anoExpira.'" where id_filiado ='.$id;
                
            }elseif($forma == 'boleto' or empty($dadosPag->numeroCartao)){
                $sql = 'update tbl_pagamento_filiado set nome = "'.$dadosPag->nome.'",
                sobrenome = "'.$dadosPag->sobrenome.'", telefone = "'.$dadosPag->telefone.'",
                rua = "'.$dadosPag->rua.'",
                numero = '.$dadosPag->numero.', bairro = "'.$dadosPag->bairro.'",
                cidade = "'.$dadosPag->cidade.'",
                uf = "'.$dadosPag->uf.'", cep = "'.$dadosPag->cep.'",
                cpf = "'.$dadosPag->cpf.'" where id_filiado ='.$id;
            }
            
            if(mysqli_query($this->conect, $sql)){
                
            ?>
                <script>
                    window.location.href = "<?php echo $link ?>";
                </script>

            <?php
                
            }else{
                $link = $link.'?Erro';
            ?>
                <script>
                    window.location.href = "<?php echo $link ?>";
                </script>

            <?php
                //echo $sql;
                //header('location:'.$link.'?Erro');
            }
            
        }
        
    }
    
    /* Apagar acompanhante */
    public function DeleteAcompanhante(){
        $id = $_SESSION['id_filiado'];
        
        date_default_timezone_set('America/Sao_Paulo');
        $datetime = date('Y-m-d H:i');
        
        $sql = "delete from tbl_filiado_midia where id_filiado = ".$id;
        if(mysqli_query($this->conect, $sql)){

            $sql = "update tbl_filiado set status = 0, conta_ativa = 0,
                    foto_perfil = '-', apresentacao = '-', excluido = '".$datetime."'
                    where id_filiado = ".$id;

            if(mysqli_query($this->conect, $sql)){
                session_destroy();
                
                ?> <script> window.location.href = "inicio.php"; </script> <?php
                
                //header('location:inicio.php');

            }else{
                //echo $sql;
                echo '<script> alert("Não foi possivel realizar a ação") </script>';
                
                ?> <script> window.location.href = "perfil-filiado.php?Erro"; </script> <?php
                    
                //header('location:perfil-filiado.php?Erro');
            }
        }else{
            //echo $sql;
            echo "<script>alert('Não foi possivel realizar a exclusão, tente novamente mais tarde')</script>";
            
            ?> <script> window.location.href = "perfil-filiado.php?Erro"; </script> <?php
                
            //header('location:perfil-filiado.php?Erro');
        }
    }
    
    /* Buscar dados do pagamento */
    public function SelectDadosPag(){
        
        $id = $_SESSION['id_filiado'];
        
        $sql = 'select pf.*, tp.valor, m.id_transferencia 
                from tbl_filiado as fi
                inner join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado
                inner join tbl_tipo_conta as tp
                on fi.id_tipo_conta = tp.id_tipo_conta
                left join tbl_mensalidade as m
                on m.id_filiado = fi.id_filiado
                where fi.id_filiado = '.$id;

        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                
                $dados = new Acompanhante();
                
                $dados->id_transfer = $rs['id_transferencia'];
                $dados->nome = $rs['nome'];
                $dados->sobrenome = $rs['sobrenome'];
                if($rs['telefone'] != null){
                    $tel = explode(')', $rs['telefone']);
                    $telddd = explode('(', $tel[0]);

                    $ddd = $telddd[1];
                    $numero = $tel[1];
                }
                $dados->ddd = $ddd;
                $dados->telefone = $numero;
                $dados->cep = $rs['cep'];
                $dados->rua = $rs['rua'];
                $dados->numero = $rs['numero'];
                $dados->bairro = $rs['bairro'];
                $dados->cidade = $rs['cidade'];
                $dados->uf = $rs['uf'];
                $dados->desconto = $rs['desconto'];
                
                $lencpf = strlen(base64_decode($rs['cpf']));
                $cont = 0;
                $cpf = '';
                while($cont < $lencpf){
                    $cpf = $cpf.'*';
                    $cont++;
                }
                $dados->cpf = $cpf;
                $dados->cpfdc = base64_decode($rs['cpf']);
                
                $lencvv = strlen(base64_decode($rs['cvv']));
                $cont = 0;
                $cvv = '';
                while($cont < $lencvv){
                    $cvv = $cvv.'*';
                    $cont++;
                }
                $dados->cvv = $cvv;
                $dados->cvvdc = base64_decode($rs['cvv']);
                
                $lennmr = strlen(base64_decode($rs['numero_cartao']));
                $cont = 0;
                $nmr = '';
                while($cont < $lennmr){
                    $nmr = $nmr.'*';
                    $cont++;
                }
                $dados->numero_cartao = $nmr;
                $dados->numero_cartaodc = base64_decode($rs['numero_cartao']);
                
                $dados->expiracaoMes = base64_decode($rs['expiracaoMes']);
                $dados->expiracaoAno = base64_decode($rs['expiracaoAno']);
            
                return $dados;
                mysqli_close($this->conect);
            }
            
        }else{
            mysqli_close($this->conect);
            return false;
        }
            
    }
    
    /* Buscar etnia */
    public function SelectEtnia(){
        $sql = "select * from tbl_etnia";
        
        if($select = mysqli_query($this->conect, $sql)){
           
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $etnia[] = new Acompanhante();
                
                $etnia[$cont]->id_etnia = $rs['id_etnia'];
                $etnia[$cont]->etnia = $rs['etnia'];
                
                $cont++;
            }
            return $etnia;
            
        }else{
            return false;
            
        }
        
    }
    
    /* Buscar cores de cabelo */
    public function SelectCorCabelo(){
        $sql = "select * from tbl_cabelo";
        
        if($select = mysqli_query($this->conect, $sql)){
           
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $cor[] = new Acompanhante();
                
                $cor[$cont]->id_cabelo = $rs['id_cabelo'];
                $cor[$cont]->cor = $rs['cor'];
                
                $cont++;
            }
            return $cor;
            
        }else{
            return false;
            
        }
        
    }
    
    /* Buscar todos os tipos de conta */
    public function SelectTiposConta(){
        
        $sql = "select * from tbl_tipo_conta";
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){

                $tipoConta[] = new Acompanhante();

                $tipoConta[$cont]->tipo_conta = $rs['id_tipo_conta'];
                $tipoConta[$cont]->titulo = $rs['titulo'];
                $tipoConta[$cont]->valor = $rs['valor'];
                $tipoConta[$cont]->qtd_fotos = $rs['foto'];
                $tipoConta[$cont]->qtd_videos = $rs['video'];
                
                $cont++;
            }

            return $tipoConta;
            
        } else {
            echo $sql;
            
        }
    }
    
    /* Buscar tipo de conta de um usuário */
    public function SelectTipoConta(){
        $id = $_SESSION['id_filiado'];
        
        $sql = "select tc.* 
                from tbl_tipo_conta as tc
                inner join tbl_filiado as fi
                on tc.id_tipo_conta = fi.id_tipo_conta
                where id_filiado = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){

                $tipoConta = new Acompanhante();

                $tipoConta->id_tipo_conta = $rs['id_tipo_conta'];
                $tipoConta->titulo = $rs['titulo'];
                $tipoConta->valor = $rs['valor'];
                $tipoConta->qtd_fotos = $rs['foto'];
                $tipoConta->qtd_videos = $rs['video'];
                
            }

            return $tipoConta;
            
        } else {
            echo $sql;
            
        }
    }
    
    /* Buscar fotos do filiado */
    public function SelectImagensFiliado(){
        if(empty($_GET['codigo'])){
            $id = $_SESSION['id_filiado'];
            
        }else{
            $id = $_GET['codigo'];
        }
        
        
        $sql = "select * from tbl_filiado_midia where descricao = 1 and id_filiado = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            if(mysqli_affected_rows($this->conect) > 0){
                $cont = 0;
                while($rs = mysqli_fetch_array($select)){

                    $fotos[] = new Acompanhante();

                    $fotos[$cont]->id_midia = $rs['id_filiado_midia'];
                    $fotos[$cont]->foto = $rs['midia'];

                    $cont++;
                }
                return $fotos;
                
            }else{
                return false;
            }
            
        }else{
            return false;
        }
        
    }
    
    /* Buscar fotos do filiado */
    public function SelectVideosFiliado(){
        if(empty($_GET['codigo'])){
            $id = $_SESSION['id_filiado'];
            
        }else{
            $id = $_GET['codigo'];
        }
        
        $sql = "select * from tbl_filiado_midia where descricao = 2 and id_filiado = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            if(mysqli_affected_rows($this->conect) > 0){
                $cont = 0;
                while($rs = mysqli_fetch_array($select)){

                    $videos[] = new Acompanhante();

                    $videos[$cont]->id_midia = $rs['id_filiado_midia'];
                    $videos[$cont]->video = $rs['midia'];

                    $cont++;
                }
                return $videos;
                
            }else{
                return false;
            }
            
        }else{
            return false;
        }
        
    }
    
    /* Listar todos os filiados do site */
    public function SelectFiliados(){
        
        $sql = "select * from tbl_filiado where conta_ativa = 1";
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                $filiados[] = new Acompanhante();

                $filiados[$cont]->id = $rs['id_filiado'];
                $filiados[$cont]->nome = $rs['nome'];
                
                if($rs['apelido'] != null){
                    $filiados[$cont]->apelido = $rs['apelido'];
                }else{
                    $filiados[$cont]->apelido = 'Usuário';
                }
                
                if($rs['foto_perfil'] != null){
                    $filiados[$cont]->foto = $rs['foto_perfil'];
                        
                }else{
                    if($rs['sexo'] == 1){
                        $filiados[$cont]->foto = 'icones/usuaria.jpg';
                    }else{
                        $filiados[$cont]->foto = 'icones/usuario.jpg';
                    }

                }
                
                if($rs['foto_perfil'] == false){
                    if($rs['sexo'] == 1){
                        $filiados[$cont]->foto = 'icones/usuaria.jpg';
                    }else{
                        $filiados[$cont]->foto = 'icones/usuario.jpg';
                    }
                }
                
                $filiados[$cont]->uf = $rs['uf'];
                
                $cont++;
            }
            
            return $filiados;
            
        }else{
            return false;
            
        }
        
    }
    
    /* Filtrar e listar todos os filiados do site */
    public function SelectFiliadosFiltro($filtro){
        $sql = "select * from tbl_filiado ";
        $ant = 0;
        
        if($filtro['etnia'] != 0){
            $sql = $sql.' where etnia = '.$filtro['etnia'];
            $ant = 1;
        }
        
        if($filtro['cor_cabelo'] != 0){
            if($ant == 1){ $sql = $sql.' and '; }
            else{ $ant = 1; $sql = $sql.' where '; }
            
            $sql = $sql.' id_cabelo = '.$filtro['cor_cabelo'];
            
        }
        
        if($filtro['sexo'] != 0){
            if($ant == 1){ $sql = $sql.' and '; }
            else{ $ant = 1; $sql = $sql.' where '; }
            
            $sql = $sql.' sexo = '.$filtro['sexo'];
        }
        
        if($filtro['acompanha'] != 0){
            if($ant == 1){ $sql = $sql.' and '; }
            else{ $ant = 1; $sql = $sql.' where '; }
            
            $sql = $sql.' acompanha = '.$filtro['acompanha'].' or acompanha = 3';
        }
        
        if($ant == 1){ $sql = $sql.' and '; }
        else{ $sql = $sql.' where '; }
        
        $sql = $sql." conta_ativa = 1";
        
        if($select = mysqli_query($this->conect, $sql)){
            if(mysqli_affected_rows($this->conect) > 0){
                $cont = 0;
                while($rs = mysqli_fetch_array($select)){
                    date_default_timezone_set('America/Sao_Paulo');
                    
                    $filiados[] = new Acompanhante();

                    $filiados[$cont]->id = $rs['id_filiado'];
                    $filiados[$cont]->nome = $rs['nome'];
                    $filiados[$cont]->apelido = $rs['apelido'];
                    
                    if($rs['foto_perfil'] != null){
                        $filiados[$cont]->foto = $rs['foto_perfil'];
                    }else{
                        
                        if($rs['sexo'] == 1){
                            $filiados[$cont]->foto = 'icones/usuaria.jpg';
                        }else{
                            $filiados[$cont]->foto = 'icones/usuario.jpg';
                        }
                        
                    }
                    
                    if($rs['foto_perfil'] == false){
                        if($rs['sexo'] == 1){
                            $filiados[$cont]->foto = 'icones/usuaria.jpg';
                        }else{
                            $filiados[$cont]->foto = 'icones/usuario.jpg';
                        }
                    }
                    
                    $data = explode('-', $rs['nasc']);
                
                    $ano = $data[0];
                    $mes = $data[1];
                    $dia = $data[2];
                    
                    $data_hoje = date('d/m/Y');
                    $dt_hoje = explode('/', $data_hoje);
                    
                    $dia_hoje = $dt_hoje[0];
                    $mes_hoje = $dt_hoje[1];
                    $ano_hoje = $dt_hoje[2];
                    
                    $idade = $ano_hoje - $ano;
                    
                    if($mes_hoje <= $mes){
                        $idade = $idade - 1;
                    }
                    
                    $filiados[$cont]->idade = $idade;
                    $filiados[$cont]->uf = $rs['uf'];

                    $cont++;
                }
                //echo $sql;
                return $filiados;
                
            }else{
                return false;
            }
            
        }else{
            //echo $sql;
            return false;
            
        }
    }
    
    /* Atualizar foto de perfil */
    public function UpdateFotoPerfil($id){
        
        $pasta    = "midia/";

        $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");

        if(isset($_POST)){
            $nome_imagem    = $_FILES['flPerfil']['name'];
            $tamanho_imagem = $_FILES['flPerfil']['size'];

            $ext = strtolower(strrchr($nome_imagem,"."));

            if(in_array($ext,$permitidos)){

                /* converte o tamanho para KB */
                $tamanho = round($tamanho_imagem / 1024);

                if($tamanho < 8024){ 
                    $nome_atual = uniqid(time()).$ext;
                    $tmp = $_FILES['flPerfil']['tmp_name']; 

                    if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                        $sql = "update tbl_filiado set foto_perfil = '".$pasta.$nome_atual."'
                        where id_filiado = ".$id;
                        
                       if(mysqli_query($this->conect, $sql)){
                            echo "<img src='midia/".$nome_atual."' id='previsualizar'>"; 
                ?>
                    <script type="text/javascript">
                        
                        $('#imgperfil').attr('disabled','desabled');  
                       
                    </script>
                    
                <?php
                           
                       }else{
                           echo $sql;
                       }
                        
                    }else{ echo "<script>alert('Falha ao enviar'); window.location.href = 'perfil-filiado.php';</script>"; }
                    
                }else{ echo "<script>alert('A imagem deve ser de no máximo 1MB'); window.location.href = 'perfil-filiado.php';</script>"; }
                
            }else{ echo "<script>alert('Somente são aceitos arquivos do tipo Imagem'); window.location.href = 'perfil-filiado.php';</script>"; }
            
        }else{
            echo "Selecione uma imagem";
            exit;
            
        }
    }
    
    /* Inserir imagens da conta */
    public function InsertMidia($id, $flname, $desc){
        
        date_default_timezone_set('America/Sao_Paulo');
        $datetime = (date('Y/m/d H:i'));
        $pasta    = "midia/";
        
        if($desc == 1){
            $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");
        }elseif($desc == 2){
            $permitidos = array(".mp4",".m4v",".webm",".ogv");
        }
        
        if(isset($_POST)){
            $nome_imagem    = $_FILES[$flname]['name'];
            $tamanho_imagem = $_FILES[$flname]['size'];

            $ext = strtolower(strrchr($nome_imagem,"."));

            if(in_array($ext,$permitidos)){

                /* converte o tamanho para KB */
                $tamanho = round($tamanho_imagem / 1024);
                
                if($desc == 1){
                    $limit = 8024;
                }elseif($desc == 2){
                    $limit = 50024;
                }
                
                if($tamanho < $limit){ 
                    $nome_atual = uniqid(time()).$ext;
                    $tmp = $_FILES[$flname]['tmp_name']; 

                    if(move_uploaded_file($tmp, $pasta.$nome_atual)){
                        
                        if(!empty($_GET['editar'])){
                            $id_foto = $_GET['editar'];
                            
                            $sql = "select * from tbl_filiado_midia where id_filiado_midia = ".$id_foto;
                            $select = mysqli_query($this->conect, $sql);
                            
                            while($rs = mysqli_fetch_array($select)){
                                unlink($rs['midia']);
                            }
                            
                            $sql = "update tbl_filiado_midia set midia = '".$pasta.$nome_atual."'
                                    where id_filiado_midia = ".$id_foto;
                        }else{
                            $sql = "insert into tbl_filiado_midia (id_filiado, midia, descricao, data_upload) 
                                values (".$id.", '".$pasta.$nome_atual."', ".$desc.", '".$datetime."')";
                        }
                        
                        if($desc == 1){
                           if(mysqli_query($this->conect, $sql)){
                                echo "<img src='midia/".$nome_atual."' id='previsualizar'>"; 

                               $fl = explode('fl', $flname); 
                    ?>
                        <script type="text/javascript">

                            $('#img<?php echo $fl[1]; ?>').attr('disabled','desabled');  

                        </script>

                    <?php

                           }else{
                               echo $sql;
                           }
                            
                        }elseif($desc == 2){
                            if(mysqli_query($this->conect, $sql)){
                                echo "<img src='icones/certo.png' id='previsualizar'>"; 

                               $fl = explode('fl', $flname); 
                    ?>
                        <script type="text/javascript">

                            $('#video<?php echo $fl[1]; ?>').attr('disabled','desabled');  

                        </script>

                    <?php

                           }else{
                               echo $sql;
                           }
                            
                        }
                        
                    }else{ echo "Falha ao enviar"; }
                    
                }else{ echo "A imagem deve ser de no máximo 1MB"; }
                
            }else{ echo "Somente são aceitos arquivos do tipo Imagem"; }
            
        }else{
            echo "Selecione uma imagem";
            exit;
            
        }
    }
    
    /* Buscar foto do perfil usuário */
    public function SelectFoto($id){
        $sql = "select * from tbl_filiado where id_filiado = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                
                if($rs['foto_perfil'] != null){
                    $fotoPerfil = $rs['foto_perfil'];
                    return $fotoPerfil;
                    
                }else{
                    return false;
                }
                
            }
            
        }else{
            return false;
        }
        
    }
    
    /* Buscar estados onde há filiados */
    public function SelectEstadosFiliados(){
        $sql = "select * from tbl_filiado where conta_ativa = 1 group by uf";
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $uf[$cont] = $rs['uf'];
                
                $cont++;
            }
            return $uf;
                
        }else{
            return false;
        }
        
    }
    
    /* Buscar filiados por estado */
    public function SelectFiliadosEstado($uf){
        if($uf == 1){
            $sql = "select * from tbl_filiado where conta_ativa = 1";
            
        }else{
            $sql = "select * from tbl_filiado where uf = '".$uf."' and conta_ativa = 1";
        }
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $filiado[] = new Acompanhante();
                
                $filiado[$cont]->nome = $rs['nome'];
                $filiado[$cont]->apelido = $rs['apelido'];
                
                if($rs['foto_perfil'] != null){
                    $filiado[$cont]->foto = $rs['foto_perfil'];
                }else{

                    if($rs['sexo'] == 1){
                        $filiado[$cont]->foto = 'icones/usuaria.jpg';
                    }else{
                        $filiado[$cont]->foto = 'icones/usuario.jpg';
                    }
                }
                
                if($rs['foto_perfil'] == false){
                    if($rs['sexo'] == 1){
                        $filiado[$cont]->foto = 'icones/usuaria.jpg';
                    }else{
                        $filiado[$cont]->foto = 'icones/usuario.jpg';
                    }
                }

                
                $filiado[$cont]->uf = $rs['uf'];
                $filiado[$cont]->id = $rs['id_filiado'];
                
                $cont++;
            }
            
            return $filiado;
                
        }else{
            return false;
        }
        
    }
    
    /* Insere a existencia do pagamento no banco de dados */
    public function InsertMensalidadePag($tipo, $dados){
        $id = $_SESSION['id_filiado'];
        $data = $dados['date'];
        $valor = $dados['valor'];
        $status = 1; 
        $desconto = $dados['desconto'];
        $codigo = $dados['code'];
        $referencia = $dados['referencia'];
        $forma = $tipo;
        
        if($desconto == null){
            $desconto = 0;
        }
        
        $sql = 'insert into tbl_mensalidade (id_filiado, data_hora, valor, status , desconto, referencia, code, forma)';
        $sql=$sql.'values('.$id.', "'.$data.'", "'.$valor.'", '.$status.', '.$desconto.', "'.$referencia.'", "'.$codigo.'", "'.$forma.'")';
        
        if(mysqli_query($this->conect, $sql)){
            
            $sql = "update tbl_pagamento_filiado set desconto = 0 where id_filiado = ".$id;
            
            mysqli_query($this->conect, $sql);
            
            return true;
            
        }else{
            return false;
        }
        
    }
    
    /* Atualizar status do pagamento */
    public function UpdateStatusPag($status, $code){
        $sql = 'select * from tbl_mensalidade where code = "'.$code.'" ';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                $code = $rs['id_transeferencia'];
            }
            $sql = 'update tbl_mensalidade set status = '.$status.' where id_transeferencia = "'.$code.'" ';
        
            mysqli_query($this->conect, $sql);
            echo $sql;
        }
        //TO DO: CRIAR UMA TABELA DE NOTIFICAÇÃO DE ERROS
    }
    
    /* Pegar o status do pacamento do próprio banco */
    public function getStatusPagamento(){
        $id = $_SESSION['id_filiado'];
        
        $sql = "select month(now()) - month(data_hora) as mes,
                day(now()) - day(data_hora) as dias,
                day(data_hora) as diapag,
                forma
                from tbl_mensalidade where id_filiado = ".$id;
        $sql = $sql." order by data_hora desc limit 1";
                   
        if($select = mysqli_query($this->conect, $sql)){
            $tempo = 'naopaga';
            while($rs = mysqli_fetch_array($select)){
                $dias = $rs['dias'];
                $diapag = $rs['diapag'];
                $mes = $rs['mes'];
                $forma = $rs['forma'];
                
                if($mes <= 0){//Se a mensalidade foi paga
                    $tempo = 'paga';
                    
                    if($forma == "promocao"){
                        $tempo = 'promocao';
                    }
                    
                }elseif($mes == 1){//Se está no mês de pagamento
                    
                    if($dias <= 7){ //Se ainda está em tempo de pagar
                        $tempo = 'naopaga';
                        
                    }else{ //Se já passou do tempo de pagar
                        $tempo = 'atraso';
                        
                    }
                    
                }elseif($mes == 2){ //Se a conta deve ser excluida
                    $tempo = 'excluido';
                }
                
            }

            return $tempo;
              
        }else{
            return false;
        }
            
    }
    
    /* Listar filiados peo sexo, etnia, com limit de retorno e excluindo algum id expessifico */
    public function SelectFiliadosSexo($sexo, $etnia, $limit, $id){
        $resut = null;
        date_default_timezone_set('America/Sao_Paulo');
        
        $sindex = 0; //Este é um parametro que restringe a busca
        $paramtr1 = 1;
        $paramtr1 = $paramtr1.'.'; // Se devem ser 
        
        $paramtr2 = 2;
        $paramtr2 = $paramtr2.'.';
        
        if($sexo == $paramtr1 or $sexo == $paramtr2){
            $s = explode ('.', $sexo);
            $sindex = 1;
            $sexo = $s[0];
        }
        
        if(!empty($sexo) and !empty($etnia)){
            $sql = 'select * from tbl_filiado where sexo = '.$sexo;
            $sql .= ' and etnia = '.$etnia;
            
        }elseif(!empty($sexo)){
            $sql = 'select * from tbl_filiado where sexo = '.$sexo;
            
        }elseif(!empty($etnia)){
            $sql = 'select * from tbl_filiado where etnia = '.$etnia;
        
        }else{
            $sql = 'select * from tbl_filiado where conta_ativa = 1';
        }
        
        if($id != null){
            $sql = $sql.' and id_filiado != '.$id;
        }
        
        $sql = $sql.' and conta_ativa = 1 ';
        
        if($limit != null){
            $sql = $sql.' limit '.$limit;
        }
        
        if($select = mysqli_query($this->conect, $sql)){
            
            if(mysqli_affected_rows($this->conect) > 0){
                
                $cont = 0;
                while($rs = mysqli_fetch_array($select)){
                    
                    $resut[] = new Acompanhante();

                    $data = explode('-', $rs['nasc']);

                    $ano = $data[0];
                    $mes = $data[1];
                    $dia = $data[2];

                    $data_hoje = date('d/m/Y');
                    $dt_hoje = explode('/', $data_hoje);

                    $mes_hoje = $dt_hoje[1];
                    $ano_hoje = $dt_hoje[2];

                    $idade = $ano_hoje - $ano;

                    if($mes_hoje <= $mes){
                        $idade = $idade - 1;
                    }

                    $resut[$cont]->id = $rs['id_filiado'];
                    $resut[$cont]->nome = $rs['nome'];
                    $resut[$cont]->apelido = $rs['apelido'];
                     
                    if($rs['foto_perfil'] != null){
                        $resut[$cont]->foto = $rs['foto_perfil'];
                        
                    }else{
                        
                        if($rs['sexo'] == 1){
                            $resut[$cont]->foto = 'icones/usuaria.jpg';
                        }else{
                            $resut[$cont]->foto = 'icones/usuario.jpg';
                        }
                    }
                    
                    if($rs['foto_perfil'] == false){
                        if($rs['sexo'] == 1){
                            $resut[$cont]->foto = 'icones/usuaria.jpg';
                        }else{
                            $resut[$cont]->foto = 'icones/usuario.jpg';
                        }
                    }
                    
                    $resut[$cont]->idade = $idade;
                    $resut[$cont]->uf = $rs['uf'];
                    
                    if($rs['acompanha'] == 1){
                        $genero = 'Mulheres';
                        
                    }elseif($rs['acompanha'] == 2){
                        $genero = 'Homens';
                        
                    }else{
                        $genero = 'Homens e Mulheres';
                    }
                    
                    $resut[$cont]->acompanha = $genero;
                    
                    $cont++;
                }
                    
            /*
            Se não houver usuário com a etnia escolhida é retornado o usuário de msm sexo 
            */
            }elseif($sindex == 0){
                $sql = 'select * from tbl_filiado where conta_ativa = 1';
                
                if($id != null){
                    $sql = $sql.' and id_filiado != '.$id;
                }
                
                if(!empty($limit)){
                    $sql = $sql.' limit '.$limit;
                }
                
                if($select = mysqli_query($this->conect, $sql)){
            
                    if(mysqli_affected_rows($this->conect) > 0){
                        
                        $cont = 0;
                        while($rs = mysqli_fetch_array($select)){

                            $resut[] = new Acompanhante();

                            $data = explode('-', $rs['nasc']);

                            $ano = $data[0];
                            $mes = $data[1];
                            $dia = $data[2];

                            $data_hoje = date('d/m/Y');
                            $dt_hoje = explode('/', $data_hoje);

                            $mes_hoje = $dt_hoje[1];
                            $ano_hoje = $dt_hoje[2];

                            $idade = $ano_hoje - $ano;

                            if($mes_hoje <= $mes){
                                $idade = $idade - 1;
                            }

                            $resut[$cont]->id = $rs['id_filiado'];
                            $resut[$cont]->nome = $rs['nome'];
                            $resut[$cont]->apelido = $rs['apelido'];
                            
                            if($rs['foto_perfil'] != null){
                                $resut[$cont]->foto = $rs['foto_perfil'];

                            }else{

                                if($rs['sexo'] == 1){
                                    $resut[$cont]->foto = 'icones/usuaria.jpg';
                                }else{
                                    $resut[$cont]->foto = 'icones/usuario.jpg';
                                }

                            }
                            $resut[$cont]->idade = $idade;
                            $resut[$cont]->uf = $rs['uf'];

                            if($rs['acompanha'] == 1){
                                $genero = 'Mulheres';

                            }elseif($rs['acompanha'] == 2){
                                $genero = 'Homens';

                            }else{
                                $genero = 'Homens e Mulheres';

                            }

                            $resut[$cont]->acompanha = $genero;

                            $cont++;
                        }

                    }
                    
                }else{
                    $resut = null;
                }
                
            }
            
        }else{
            $resut = null;
        }
        
        return $resut;
        
    }
    
}