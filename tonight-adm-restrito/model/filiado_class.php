<?php 
/**
    Data: 05/03/2018
    Objetivo: Manipulação de dados do acompanhante
**/

class Acompanhante{
    
    public $id;
    public $conect;
    public $id_filiado;
    public $nome;
    public $nasc;
    public $email;
    public $senha;
    public $celular1;
    public $celular2;
    public $sexo;
    public $apresentacao;
    public $foto_perfil;
    public $altura;
    public $peso;
    public $conta_ativa;
    public $acompanha;
    public $cobrar;
    public $data_cadastro;
    public $nomeCard;
    public $sobrenomeCard;
    public $telefone;
    public $rua;
    public $numero;
    public $bairro;
    public $cidade;
    public $uf;
    public $cep;
    public $desconto;
    public $cpf;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function SelectFiliados(){
        $sql = 'select fi.*, pf.cpf from tbl_filiado as fi
                left join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado where fi.conta_ativa = 1 order by fi.id_filiado desc';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            if(mysqli_affected_rows($this->conect) > 0){
                $cont = 0;

                while($rs = mysqli_fetch_array($select)){

                    $result[] = new Acompanhante();

                    $result[$cont]->nome = $rs['nome'];
                    $result[$cont]->id_filiado = $rs['id_filiado'];
                    $result[$cont]->foto = $rs['foto_perfil'];
                    $result[$cont]->nasc = $rs['nasc'];
                    $result[$cont]->uf = $rs['uf'];
                    $result[$cont]->cobrar = $rs['cobrar'];
                    $result[$cont]->cpf = base64_decode($rs['cpf']);

                    $cont++;
                }
            
            }else{
                $result = false;
            }
            
        }else{
            $result = false;
        }
        
        return $result;
    }
 
    public function SelectFiliadoPesq($pesq){
        $sql = 'select fi.*, pf.cpf from tbl_filiado as fi
                left join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado 
                where fi.nome like "%'.$pesq.'%" 
                or fi.id_filiado like "%'.$pesq.'%" ';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            if(mysqli_affected_rows($this->conect) > 0){
                $cont = 0;

                while($rs = mysqli_fetch_array($select)){

                    $result[] = new Acompanhante();

                    $result[$cont]->nome = $rs['nome'];
                    $result[$cont]->id_filiado = $rs['id_filiado'];
                    $result[$cont]->nasc = $rs['nasc'];
                    $result[$cont]->uf = $rs['uf'];
                    $result[$cont]->cobrar = $rs['cobrar'];
                    $result[$cont]->cpf = base64_decode($rs['cpf']);

                    $cont++;
                }
            }else{
                $result = false;
            }
            
        }else{
            $result = false;
        }
        
        return $result;
    }
 
    public function SelectFiliadosDesativados(){
        $sql = 'select fi.*, pf.cpf from tbl_filiado as fi
                left join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado where fi.conta_ativa = 0';
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            
            while($rs = mysqli_fetch_array($select)){
                
                $result[] = new Acompanhante();
            
                $result[$cont]->nome = $rs['nome'];
                $result[$cont]->id_filiado = $rs['id_filiado'];
                $result[$cont]->nasc = $rs['nasc'];
                $result[$cont]->uf = $rs['uf'];
                $result[$cont]->cobrar = $rs['cobrar'];
                $result[$cont]->cpf = base64_decode($rs['cpf']);
            
                $cont++;
            }
            
        }else{
            $result = false;
        }
        
        return $result;
    }
 
    public function SelectFiliadoById($id){
        
        $sql = "select fi.*, pf.nome as nomeCard,
                pf.sobrenome as sobrenomeCard,
                pf.bairro, pf.cep, pf.cidade as cidadeCard,
                pf.cpf, pf.numero, pf.rua,
                pf.telefone, pf.uf as ufCard, pf.desconto
                from tbl_filiado as fi
                left join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado
                where fi.id_filiado = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                
                $filiado = new Acompanhante();
                
                $filiado->id_filiado = $rs['id_filiado'];
                $filiado->nome = $rs['nome'];
                $filiado->nasc = $rs['nasc'];
                $filiado->email = $rs['email'];
                $filiado->senha = $rs['senha'];
                $filiado->celular1 = $rs['celular1'];
                $filiado->celular2 = $rs['celular2'];
                
                if($rs['sexo'] == '1'){
                    $filiado->sexo = 'Feminino';
                }else{
                    $filiado->sexo = 'Masculino';
                }
                $filiado->apresentacao = $rs['apresentacao'];
                if($rs['foto_perfil'] == '-'){
                    $filiado->foto_perfil = null;
                }else{
                    $filiado->foto_perfil = $rs['foto_perfil'];
                }
                $filiado->altura = $rs['altura'];
                $filiado->peso = $rs['peso'];
                $filiado->conta_ativa = $rs['conta_ativa'];
                $filiado->acompanha = $rs['acompanha'];
                $filiado->cobrar = $rs['cobrar'];
                $filiado->uf = $rs['uf'];
                $filiado->cidade = $rs['cidade'];
                $filiado->data_cadastro = $rs['data_cadastro'];
                $filiado->nomeCard = $rs['nomeCard'];
                $filiado->sobrenomeCard = $rs['sobrenomeCard'];
                $filiado->telefone = $rs['telefone'];
                $filiado->rua = $rs['rua'];
                $filiado->numero = $rs['numero'];
                $filiado->bairro = $rs['bairro'];
                $filiado->cidadeCard = $rs['cidadeCard'];
                $filiado->ufCard = $rs['ufCard'];
                $filiado->cep = $rs['cep'];
                $filiado->excluido = $rs['excluido'];
                $filiado->desconto = $rs['desconto'];
                
                
                $filiado->cpf = base64_decode($rs['cpf']);
                
                $sql2 = "select * from tbl_tipo_conta where id_tipo_conta = ".$rs['id_tipo_conta'];
                
                if($select2 = mysqli_query($this->conect, $sql2)){
            
                    while($rs2 = mysqli_fetch_array($select2)){
                        $filiado->valor = $rs2['valor'];
                        
                    }
                }
            }
            
        }else{
            $filiado = false;
        }
        
        return $filiado;
    }
    
    public function RecuperarContaFiliado(){
        $id = $_GET['id'];
        
        $sql = "insert into tbl_mensalidade (id_filiado, data_hora, valor, status, desconto,
                code, referencia, forma) 
                values (".$id.", now(), 0, 0, 0, 0, 'recuperar', 'recuperar')";
        
        if(mysqli_query($this->conect, $sql)){
            $sql = "update tbl_filiado set status = 1, conta_ativa = 1,
                    foto_perfil = '0', apresentacao = '0', excluido = 0000-00-00
                    where id_filiado = ".$id;

            if(mysqli_query($this->conect, $sql)){

                ?> <script> window.location.href = "hospedes.php?Sucesso"; </script> <?php

            }else{
                //echo $sql;
                echo '<script> alert("Infelizmente não foi possivel realizar a ação") </script>';

                ?> <script> window.location.href = "hospedes.php?Erro"; </script> <?php

            }
        }else{
            echo '<script> alert("Infelizmente houve um erro na recuperação da conta") </script>';
            ?> <script> window.location.href = "hospedes.php?Erro"; </script> <?php
        }
    }
    
    public function DeleteHospedeById(){
        $id = $_GET['id'];
        
        $sql = "delete from tbl_filiado_midia where id_filiado = ".$id;
        if(mysqli_query($this->conect, $sql)){
        
            $sql = "update tbl_filiado set status = 0, conta_ativa = 0,
                    foto_perfil = '-', apresentacao = '-', excluido = date(now())
                    where id_filiado = ".$id;
        
            
            if(mysqli_query($this->conect, $sql)){
                
                ?> <script> window.location.href = "hospedes.php?Sucesso"; </script> <?php
                
            }else{
                //echo $sql;
                echo '<script> alert("Não foi possivel realizar a ação") </script>';
                
                ?> <script> window.location.href = "hospedes.php?Erro"; </script> <?php
                
            }
            
        }else{
            //echo $sql;
            echo "<script>alert('Não foi possivel realizar a exclusão, tente novamente mais tarde')</script>";
            
            ?> <script> window.location.href = "hospedes.php?Erro"; </script> <?php
            
        }
        
    }
    
    public function AdicionarDesconto(){
        $id = $_GET['cod'];
        $desconto = intval($_POST['txtValorPorcentagem']);
        
        $sql = "update tbl_pagamento_filiado set desconto = ".$desconto;
        $sql .= " where id_filiado = ".$id;
        
        if(mysqli_query($this->conect, $sql)){
            
            ?> <script> window.location.href = "hospedes.php?Sucesso"; </script> <?php
        }else{
            ?> <script> 
                alert("Infelizmente não foi possivel concluir esta ação"); 
                window.location.href = "hospedes.php?Erro"; </script> <?php
        }
        
    }
    
    public function ContaAtivarDesativar(){
        $id = $_POST['txtCod'];
        
        $sql = "select * from tbl_filiado where id_filiado = ".$id;
        
        if($select = mysqli_query($this->conect, $sql)){
            
            while($rs = mysqli_fetch_array($select)){
                $conta = $rs['conta_ativa'];
                
                if($conta == 1){
                    $sql = "update tbl_filiado set conta_ativa = 0 where id_filiado = ".$id;
                }elseif($conta == 0){
                    $sql = "update tbl_filiado set conta_ativa = 1 where id_filiado = ".$id;
                }
                
                if(mysqli_query($this->conect, $sql)){
                    ?> <script> window.location.href = "hospedes.php?modo=ver&codigo=<?php echo $id ?>&Sucesso#visualizar"; </script> <?php
                }else{
                    //echo $sql;
                    echo '<script> alert("Não foi possivel realizar a ação") </script>';
                    ?> <script> window.location.href = "hospedes.php?modo=ver&codigo=<?php echo $id ?>&Erro#visualizar"; </script> <?php
                
                }
            }
            
        }else{
            //echo $sql;
            echo '<script> alert("Não foi possivel realizar a ação") </script>';
            ?> <script> window.location.href = "hospedes.php?modo=ver&codigo=<?php echo $id ?>&Erro#visualizar"; </script> <?php
                
        }
        
        
    }
    
    public function DelDesconto(){
        $id = $_GET['code'];
        
        $sql = "update tbl_pagamento_filiado set desconto = 0 where id_filiado = ".$id;
        
        if(mysqli_query($this->conect, $sql)){
            ?> <script> window.location.href = "hospedes.php?gerar=desconto&id=<?php echo $id ?>&Sucesso#visualizar"; </script> <?php
        }else{
            //echo $sql;
            echo '<script> alert("Não foi possivel realizar a ação") </script>';
            ?> <script> window.location.href = "hospedes.php?gerar=desconto&id=<?php echo $id ?>&Erro#visualizar"; </script> <?php
              
        }
        
    }
    
    //Desativar a conta dos filiados estiverem com um atraso no pagamento
    public function AtualizarStatusPagamento(){
        
        $sql1 = "select *, month(data_cadastro) as mes,
                day(data_cadastro) as dia, year(data_cadastro) as ano
                from tbl_filiado where conta_ativa = 1";
        
        if($select1 = mysqli_query($this->conect, $sql1)){

            if(mysqli_affected_rows($this->conect) > 0){

                while($rs1 = mysqli_fetch_array($select1)){
                    $mes = date('m');
                    $dia = date('d');
                    
                    //Se a pessoa tem cadastro na tblmensalidade
                    if($rs1['mes'] == $mes){
                        
                        //Se ainda não passou o dia do pagamento desde
                        //que a pessoa se cadastrou
                        if($rs1['dia'] < 10 and $dia < 10){
                            $tblpag = '0';
                        }elseif($rs1['dia'] > 10){
                            $tblpag = '0';
                        }else{
                            $tblpag = '1';
                        }
                        
                    }else{
                        $tblpag = '1';
                        
                    }
                    //Se a condição a cima for  falsa ela entra no if
                    if($tblpag == '1'){
                        $id = $rs1['id_filiado'];

                        $sql = "select month(now()) - month(data_hora) as mes, 10 - day(data_hora) as dias
                                from tbl_mensalidade where id_filiado = ".$id;
                        $sql = $sql." order by data_hora desc limit 1";
                        
                        if($select = mysqli_query($this->conect, $sql)){

                            if(mysqli_affected_rows($this->conect) > 0){

                                while($rs = mysqli_fetch_array($select)){
                                    $dias = $rs['dias'];
                                    $mes = $rs['mes'];
                                    $dia = date('d');
                                    
                                    if($mes == 1){

                                        if($dia >= 17){ //Se a conta deve ser excluida
                                            
                                            $sql = "update tbl_filiado set conta_ativa = 0
                                            where id_filiado = ".$id;
                                            
                                            mysqli_query($this->conect, $sql);

                                        }

                                    }elseif($mes >= 2){ //Se passou do tempo da conta ser excluida
                                        
                                        $sql = "update tbl_filiado set conta_ativa = 0
                                        where id_filiado = ".$id;
                                        
                                        mysqli_query($this->conect, $sql);
                                    }
                                    
                                }

                            }else{
                                // Se a pessoa não tem cadastro na tblmensalidade
                                // Se o dia de cadastro justifica essa condição ou não
                                if($rs1['mes'] == $mes - 1){
                                    
                                    if($rs1['dia'] > 10 and $dia <10){
                                        $tblpag = '0';
                                    }else{
                                         $sql = "update tbl_filiado set conta_ativa = 0
                                        where id_filiado = ".$id;
                                        
                                        mysqli_query($this->conect, $sql);
                                    }
                                    
                                }else{
                                     $sql = "update tbl_filiado set conta_ativa = 0
                                        where id_filiado = ".$id;
                                        
                                        mysqli_query($this->conect, $sql);
                                    
                                }
                                
                                
                            }
                        }
                    }
                }
                
                echo "<script>alert('Atualizado com sucesso')</script>";
                
            }else{ 
                echo "<script>alert('Atualizado com sucesso')</script>";
            }
            
        }else{
            echo "<script>alert('Não atualizado')</script>";

        }
        
    }
    
    //Apagar os usuários com atraso de pagamento maior que uma semana
    public function DeleteFiliadoMensalAtrasada(){
        
        $class = new Acompanhante();
        $filiados = $class->SelectFiliadosPagAtraso();
        
        if($filiados != false){ //Se houver usuários que devem ser excluidos
            
            $cont = 0;
            while($cont < count($filiados)){
                $id = $filiados->id;

                $sql = "delete from tbl_filiado_midia where id_filiado = ".$id;
                if(mysqli_query($this->conect, $sql)){

                    $sql = "update tbl_filiado set status = 0, conta_ativa = 0,
                            foto_perfil = '-', apresentacao = '-', excluido = date(now())
                            where id_filiado = ".$id;

                    mysqli_query($this->conect, $sql);

                }else{
                    //echo $sql;
                    echo "<script>alert('Não foi possivel realizar a exclusão, tente novamente mais tarde')</script>";

                    ?> <script> window.location.href = "hospedes.php?Erro"; </script> <?php

                }
                $cont++;
            }
            
            ?> <script> window.location.href = "hospedes.php?Sucesso&nmr=<?php echo $cont ?>"; </script> <?php
            
        }else{
            echo "<script>alert('Não foi possivel realizar a exclusão, tente novamente mais tarde')</script>";

            ?> <script> window.location.href = "hospedes.php?Erro"; </script> <?php

        }
    }
    
    //Buscar os usuários que devem ser excluidos e se há
    public function SelectFiliadosPagAtraso(){
        
        $sql1 = "select * from tbl_filiado where conta_ativa = 0 and excluido = 0000-00-00";
        
        $select1 = mysqli_query($this->conect, $sql1);
        
        if(mysqli_affected_rows($this->conect) > 0){
            
            while($rs1 = mysqli_fetch_array($select1)){
                
                $id = $rs1['id_filiado'];
                
                $sql = "select month(now()) - month(data_hora) as mes, 10 - day(data_hora) as dias
                        from tbl_mensalidade where id_filiado = ".$id;
                $sql = $sql." order by data_hora desc limit 1";

                $select = mysqli_query($this->conect, $sql);

                if(mysqli_affected_rows($this->conect) > 0){
                    
                    while($rs = mysqli_fetch_array($select)){
                        $dias = $rs['dias'];
                        $mes = $rs['mes'];
                        $dia = date('d');
                        $filiado = new Acompanhante();

                        if($mes == 1){

                            if($dia >= 17){ //Se a conta deve ser excluida
                                $filiado->id = $id;
                            }

                        }elseif($mes >= 2){ //Se passou do tempo da conta ser excluida
                            $filiado->id = $id;
                        }
                        
                    }

                }else{
                    $sql1 = "select month(data_cadastro) as mes,
                    day(data_cadastro) as dia
                    from tbl_filiado where id_filiado =".$id;

                    if($select1 = mysqli_query($this->conect, $sql1)){

                        if(mysqli_affected_rows($this->conect) > 0){

                            while($rs1 = mysqli_fetch_array($select1)){
                                $mes = date('m');
                                $dia = date('d');

                                //Se a pessoa tem cadastro para pagamento
                                if($rs1['mes'] == $mes){

                                    if($rs1['dia'] < 10 and $dia < 10){
                                        $tblpag = false;
                                    }elseif($rs1['dia'] > 10){
                                        $tblpag = '0';
                                    }else{
                                        $tblpag = '1';
                                    }

                                }else{

                                    if($rs1['dia'] > 10 and $dia < 10){
                                        $tblpag = '0';
                                    }else{
                                        $tblpag = '1';
                                    }

                                }

                                if($tblpag == '1'){
                                    
                                    $filiado = new Acompanhante();
                                    $filiado->id = $id;
                                    
                                }
                            }
                        }
                    }
                }
            }
            
            return $filiado; // Retorno dos ids
            
        }else{
            return false; // Não há filiados para apagar
        }
        
    }
    
    
}

?>