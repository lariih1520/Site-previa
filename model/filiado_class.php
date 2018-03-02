<?php
/**
    Data: 10/02/2018
    Objetivo: Controle de dados de clientes
    Arquivos relacionados: cliente_class.php
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
            }
            
            $_SESSION['id_filiado'] = $id;
            
            if(empty($foto_perfil)){
                mysqli_close($this->conect);
                
    ?>
            <script>
                window.location.href = "filiado-fotos.php";
            </script>

    <?php   }else{
                $sql = "select * from tbl_filiado_midia where id_filiado = ".$id;
                mysqli_query($this->conect, $sql);
                  
                if(mysqli_affected_rows($this->conect) > 0){
                    mysqli_close($this->conect);
    ?>
            <script> window.location.href = "perfil-filiado.php"; </script>

    <?php       }else{ 
                    mysqli_close($this->conect);
    ?>
            <script>  window.location.href = "filiado-fotos.php";  </script>
    <?php
                }
                  
            }
            
            
        }else{
            mysqli_close($this->conect);
            
        ?>
            <script>
                window.location.href = "login.php?erro-ao-logar";
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
        
        //$sql = 'call VwDadosFiliado('.$id.')';
        $sql = 'select fi.*, et.etnia, ca.cor as cabelo, tc.foto,
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
                $filiado->email = $rs['email'];
                $filiado->senha = $rs['senha'];
                
                if($rs['sexo'] == 1){
                    $filiado->sexo = 'Feminino';
                    
                }elseif($rs['sexo'] == 2){
                    $filiado->sexo = 'Masculino';
                    
                }
                
                if($rs['apresentacao'] == null){
                    $filiado->apresentacao = 'Não há apresentação';
                    
                }else{
                    $filiado->apresentacao = $rs['apresentacao'];
                }
                
                if($rs['acompanha'] == 1){
                    $filiado->acompanha = 'Mulheres';
                    
                }elseif($rs['acompanha'] == 2){
                    $filiado->acompanha = 'Homens';
                    
                }
                
                $data = explode('-', $rs['nasc']);
                
                $ano = $data[0];
                $mes = $data[1];
                $dia = $data[2];
                
                $filiado->uf = $rs['uf'];
                $filiado->cidade = $rs['cidade'];
                $filiado->cobrar = $rs['cobrar'];
                $filiado->foto = $rs['foto_perfil'];
                $filiado->etnia = $rs['etnia'];
                $filiado->cabelo = $rs['cabelo'];
                $filiado->altura = $rs['altura'];
                $filiado->peso = $rs['peso'];
                $filiado->titulo = $rs['titulo'];
                $filiado->valor = $rs['valor_conta'];
                $filiado->qtd_fotos = $rs['foto'];
                $filiado->qtd_videos = $rs['video'];
                $filiado->dia = $dia;
                $filiado->mes = $mes;
                $filiado->ano = $ano;
                
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
        
        /* necessário para o funcionamento da classe filiado */
        session_start();
        
        $filiado = new Filiado();
        $fld = $filiado->getFiliado();
        
        /* Pegar data de cadastro */
        date_default_timezone_set('America/Sao_Paulo');
        $datetime = (date('Y/m/d H:i'));
        
        $sql = "insert into tbl_filiado(nome, nasc, email, senha, celular1, celular2, etnia, sexo,
                altura, peso, acompanha, id_tipo_conta, cidade, uf, cobrar, data_cadastro, conta_ativa, status)
                values ('".$fld->nome."', '".
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
                    
                    header('location:filiado-fotos.php');
                }
                
            }else{
                echo $sql; 
            }
            
        }else{
            echo $sql; 
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
    
    /* Cadastrar novo acompanhante no site */
    public function UpdateDados($fld){
        
        $sql = "update tbl_filiado set ";
        
        $sql = $sql."nome = '".$fld->nome."' ";
        
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
        $sql = $sql." where id_filiado = ".$fld->id;
        
                
        if(mysqli_query($this->conect, $sql)){
                
        ?>
            <script>
                window.location.href = "perfil-filiado.php";
            </script>

        <?php

        }else{
        
        ?>
            <script>
                window.location.href = "perfil-filiado.php?ERRO";
            </script>

        <?php
            
            //echo $sql;
            //header('location:'.$link.'?Erro');
        }
        
    }
    
    /* Alterar Dados do Pagamento */
    public function UpdateDadosPag($dadosPag){
        $q = $_GET['q'];
        $forma = $dadosPag->formaPagar;
        
        if($q == 'pagar'){
            $link = 'pagar-mensalidade.php?confirmar&forma='.$forma;
            
        }elseif($q =='dados-private'){
            $link = 'perfil-filiado.php';
        }
        
        $id = $dadosPag->id;
        $sql = 'select * from tbl_pagamento_filiado where id_filiado = '.$id;
        
        mysqli_query($this->conect, $sql);
        
        if(mysqli_affected_rows($this->conect) == 0){
            $dadosPag->id = $id;
            $update = new Acompanhante();
            $update->UpdateDados($dadosPag);
            
        }else{
            $sql = 'update tbl_pagamento_filiado set nome = "'.$dadosPag->nome.'",
            sobrenome = "'.$dadosPag->sobrenome.'", telefone = "'.$dadosPag->telefone.'", rua = "'.$dadosPag->rua.'",
            numero = '.$dadosPag->numero.', bairro = "'.$dadosPag->bairro.'", cidade = "'.$dadosPag->cidade.'",
            uf = "'.$dadosPag->uf.'", cep = "'.$dadosPag->cep.'",
            cpf = "'.$dadosPag->cpf.'", numero_cartao = "'.$dadosPag->numeroCartao.'", cvv = "'.$dadosPag->cvv.'",
            expiracaoMes = "'.$dadosPag->mesExpira.'", expiracaoAno = "'.$dadosPag->anoExpira.'" ';

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
    
    /* Buscar dados do pagamento */
    public function SelectDadosPag(){
        
        $id = $_SESSION['id_filiado'];
        
        //$sql = 'call VwDadosPag('.$id.')';
        $sql = 'select pf.*, tp.valor 
                from tbl_filiado as fi
                inner join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado
                inner join tbl_tipo_conta as tp
                on fi.id_tipo_conta = tp.id_tipo_conta
                where fi.id_filiado = '.$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                
                $dados = new Acompanhante();
                
                $dados->nome = $rs['nome'];
                $dados->sobrenome = $rs['sobrenome'];
                
                $tel = explode(')', $rs['telefone']);
                
                $telddd = explode('(', $tel[0]);
                $ddd = $telddd[1];
                $numero = $tel[1];
                
                $dados->ddd = $ddd;
                $dados->telefone = $numero;
                $dados->cep = $rs['cep'];
                $dados->rua = $rs['rua'];
                $dados->numero = $rs['numero'];
                $dados->bairro = $rs['bairro'];
                $dados->cidade = $rs['cidade'];
                $dados->uf = $rs['uf'];
                
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
    
    /* Buscar tipo de conta */
    public function SelectTiposConta(){
        
        $sql = "select * from tbl_tipo_conta";
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){

                $tipoConta[] = new Acompanhante();

                $tipoConta[$cont]->tipo_conta = $rs['tipo_conta'];
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
    
    /* Buscar tipo de conta */
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

                $tipoConta->tipo_conta = $rs['tipo_conta'];
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
    
    /* Listar todos os filiados do site */
    public function SelectFiliados(){
        
        $sql = "select * from tbl_filiado where conta_ativa = 1";
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                $filiados[] = new Acompanhante();

                $filiados[$cont]->id = $rs['id_filiado'];
                $filiados[$cont]->nome = $rs['nome'];
                $filiados[$cont]->foto = $rs['foto_perfil'];
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
        
        if($filtro->etnia != 0){
            $sql = $sql.' where etnia = '.$filtro->etnia;
            $ant = 1;
        }
        
        if($filtro->cor_cabelo != 0){
            if($ant == 1){ $sql = $sql.' and '; }
            else{ $ant = 1; $sql = $sql.' where '; }
            
            $sql = $sql.' id_cabelo = '.$filtro->cor_cabelo;
            
        }
        
        if($filtro->sexo != 0){
            if($ant == 1){ $sql = $sql.' and '; }
            else{ $ant = 1; $sql = $sql.' where '; }
            
            $sql = $sql.' sexo = '.$filtro->sexo;
        }
        
        if($filtro->acompanha != 0){
            if($ant == 1){ $sql = $sql.' and '; }
            else{ $ant = 1; $sql = $sql.' where '; }
            
            $sql = $sql.' acompanha = '.$filtro->acompanha;
        }
        
        if($ant == 1){ $sql = $sql.' and '; }
        else{ $sql = $sql.' where '; }
        
        $sql = $sql." conta_ativa = 1";
        
        if($select = mysqli_query($this->conect, $sql)){
            if(mysqli_affected_rows($this->conect) > 0){
                $cont = 0;
                while($rs = mysqli_fetch_array($select)){
                    $filiados[] = new Acompanhante();

                    $filiados[$cont]->id = $rs['id_filiado'];
                    $filiados[$cont]->nome = $rs['nome'];
                    $filiados[$cont]->foto = $rs['foto_perfil'];
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
                    $tmp = $_FILES['flPerfil']['tmp_name']; 

                    if(move_uploaded_file($tmp, $pasta.$nome_imagem)){
                        $sql = "update tbl_filiado set foto_perfil = '".$pasta.$nome_imagem."'
                        where id_filiado = ".$id;
                        
                       if(mysqli_query($this->conect, $sql)){
                            echo "<img src='midia/".$nome_imagem."' id='previsualizar'>"; 
                ?>
                    <script type="text/javascript">
                        
                        $('#imgperfil').attr('disabled','desabled');  
                       
                    </script>
                    
                <?php
                           
                       }else{
                           echo $sql;
                       }
                        
                    }else{ echo "Falha ao enviar"; }
                    
                }else{ echo "A imagem deve ser de no máximo 1MB"; }
                
            }else{ echo "Somente são aceitos arquivos do tipo Imagem"; }
            
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

        $permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp");

        if(isset($_POST)){
            $nome_imagem    = $_FILES[$flname]['name'];
            $tamanho_imagem = $_FILES[$flname]['size'];

            $ext = strtolower(strrchr($nome_imagem,"."));

            if(in_array($ext,$permitidos)){

                /* converte o tamanho para KB */
                $tamanho = round($tamanho_imagem / 1024);

                if($tamanho < 8024){ 
                    $tmp = $_FILES[$flname]['tmp_name']; 

                    if(move_uploaded_file($tmp, $pasta.$nome_imagem)){
                        $sql = "insert into tbl_filiado_midia (id_filiado, midia, descricao, data_upload) 
                                values (".$id.", '".$pasta.$nome_imagem."', ".$desc.", '".$datetime."')";
                        
                       if(mysqli_query($this->conect, $sql)){
                            echo "<img src='midia/".$nome_imagem."' id='previsualizar'>"; 
                           
                           $fl = explode('fl', $flname); 
                ?>
                    <script type="text/javascript">
                        
                        $('#img<?php echo $fl[1]; ?>').attr('disabled','desabled');  
                       
                    </script>
                    
                <?php
                           
                       }else{
                           echo $sql;
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
        $sql = "select * from tbl_filiado group by uf";
        
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
            $sql = "select * from tbl_filiado";
            
        }else{
            $sql = "select * from tbl_filiado where uf = '".$uf."' ";
        }
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $filiado[] = new Acompanhante();
                
                $filiado[$cont]->nome = $rs['nome'];
                $filiado[$cont]->foto = $rs['foto_perfil'];
                $filiado[$cont]->uf = $rs['uf'];
                $filiado[$cont]->id = $rs['id_filiado'];
                
                $cont++;
            }
            
            return $filiado;
                
        }else{
            return false;
        }
        
    }
    
}