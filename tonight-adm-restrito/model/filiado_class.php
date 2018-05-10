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
    public $visualizacoes;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }
    
    public function SelectFiliados(){
        $sql = 'select fi.*, pf.cpf, vi.visualizacoes from tbl_filiado as fi
                left join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado 
                left join tbl_visualizacoes as vi
                on fi.id_filiado = vi.id_filiado
                where fi.conta_ativa = 1 order by fi.id_filiado desc';
        
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
                    
                    if($rs['visualizacoes'] != null){
                        $result[$cont]->visualizacoes = $rs['visualizacoes'];
                    }else{
                        $result[$cont]->visualizacoes = 0;
                    }
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
        $sql = 'select fi.*, pf.cpf, vi.visualizacoes from tbl_filiado as fi
                left join tbl_pagamento_filiado as pf
                on fi.id_filiado = pf.id_filiado 
                left join tbl_visualizacoes as vi
                on fi.id_filiado = vi.id_filiado
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
                    if($rs['visualizacoes'] != null){
                        $result[$cont]->visualizacoes = $rs['visualizacoes'];
                    }else{
                        $result[$cont]->visualizacoes = 0;
                    }
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
        
            $sql = "update tbl_filiado set conta_ativa = 0,
                    foto_perfil = null, apresentacao = null, excluido = date(now())
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
        $sql1 ="select fi.id_filiado, date(fi.data_cadastro) as data_cadastro, 
                pag.data_pag as dia_pag,
                date_add(date(fi.data_cadastro), interval 15 day) as data_pag 
                from tbl_filiado as fi
                inner join tbl_pagamento_filiado as pag
                on fi.id_filiado = pag.id_filiado";
        
        if($select1 = mysqli_query($this->conect, $sql1)){

            if(mysqli_affected_rows($this->conect) > 0){

                while($rs1 = mysqli_fetch_array($select1)){
                    $id_filiado = $rs1['id_filiado'];
                    $data_cadast = $rs1['data_cadastro'];
                    $data_pag = $rs1['data_pag'];
                    $dia_pag = $rs1['dia_pag'];
                    
                    $sql2 ="select 
                            if(date(now()) between '".$data_cadast."' and '".$data_pag."', 'false', 'verifypag') 
                            as condicao";
                    $select2 = mysqli_query($this->conect, $sql2);
                    
                    while($rs2 = mysqli_fetch_array($select2)){
                        $cond = $rs2['condicao'];
                        
                        if($cond == 'verifypag'){
                            $id = $id_filiado;
                            
                            //Se ainda não estamnos no dia de pagamento 
                            if(date('d') <= $dia_pag){
                                $ultimopag = date('Y-m', strtotime('-1 month'));
                            }else{
                                //Verificar se a mensalidade deste mês foi paga
                                $ultimopag = date('Y-m');
                            }
                            
                            $sql4 = "select if(concat(year(data_hora),'-', 
                            if(month(data_hora) < 10, concat(0,month(data_hora)), 
                            month(data_hora))) like '%".$ultimopag."%', 'false', 'desativar') 
                            as condicao from tbl_mensalidade where id_filiado = ".$id."
                            order by id_transferencia desc limit 1";
                                                        
                            $select4 = mysqli_query($this->conect, $sql4);
                            
                            if(mysqli_affected_rows($this->conect) > 0){
                                while($rs4 = mysqli_fetch_array($select4)){
                                    
                                    if($rs4['condicao'] == 'desativar'){
                                        $sql5 = "update tbl_filiado set conta_ativa = 0
                                        where id_filiado = ".$id;

                                        mysqli_query($this->conect, $sql5);
                                    }
                                }
                            }else{
                                $sql5 = "update tbl_filiado set conta_ativa = 0
                                        where id_filiado = ".$id;
                                mysqli_query($this->conect, $sql5);

                            }
                        }
                    }
                }
                echo "<script>alert('Atualizado com sucesso')</script>";
                
            }else{ 
                echo "<script>alert('Não encontrados acompanhantes com a conta ativa')</script>";
            }
            
        }else{
            echo "<script>alert('Infelismente não foi possivel atualizar')</script>";

        }
        
    }
    
    //Apagar os usuários com atraso de pagamento maior que uma semana
    public function DeleteFiliadoMensalAtrasada(){
        
        $class = new Acompanhante();
        $filiados = $class->SelectFiliadosPagAtraso();
        
        if($filiados != false){ //Se houver usuários que devem ser excluidos
            
            $cont = 0;
            while($cont < count($filiados)){
                $id = $filiados[$cont]['id'];

                $sql = "delete from tbl_filiado_midia where id_filiado = ".$id;
                if(mysqli_query($this->conect, $sql)){
                    
                    $sql = "update tbl_filiado set conta_ativa = 0,
                            foto_perfil = null, apresentacao = null, excluido = date(now())
                            where id_filiado = ".$id;

                    mysqli_query($this->conect, $sql);

                }else{
                    
                    echo "<script>alert('Não foi possivel realizar a exclusão, tente novamente mais tarde')</script>";

                    ?> <script> window.location.href = "hospedes.php?Erro"; </script> <?php

                }
                $cont++;
            }
            
            ?> <script> window.location.href = "hospedes.php?Sucesso&nmr=<?php echo $cont ?>"; </script> <?php
            
        }else{
            echo "<script>alert('Não há filiados com mensalidade atrasada')</script>";

            ?> <script> window.location.href = "hospedes.php"; </script> <?php
        }
    }
    
    //Buscar os usuários que devem ser excluidos e se há
    public function SelectFiliadosPagAtraso(){
        
        $sql1 = "select fi.id_filiado, date(fi.data_cadastro) as data_cadastro, 
                pag.data_pag as dia_pag,
                concat(year(now()), '-', if(month(now()) < 10, 
                concat(0, month(now())), month(now())), '-', if(pag.data_pag < 10, 
                concat(0, pag.data_pag), pag.data_pag)) as data_pag 
                from tbl_filiado as fi
                inner join tbl_pagamento_filiado as pag
                on fi.id_filiado = pag.id_filiado
                where conta_ativa = 0 and excluido is null or excluido = 0";
        
        $select1 = mysqli_query($this->conect, $sql1);
        
        if(mysqli_affected_rows($this->conect) > 0){
            
            $filiado = false;
            while($rs1 = mysqli_fetch_array($select1)){
                
                $id = $rs1['id_filiado'];
                $diapag = $rs1['dia_pag'];
                $datapag = $rs1['data_pag'];
                
                if(date('d') > $diapag){
                    $sql = "select 
                            if(date(now()) between '".$datapag."' and date_add('".$datapag."', interval 7 day),
                            'false', 'verifypag') as condicao";

                    if($select = mysqli_query($this->conect, $sql)){
                        
                        $cont = 0;
                        while($rs = mysqli_fetch_array($select)){
                            $condicao = $rs['condicao'];
                            
                            if($condicao == 'verifypag'){
                                $sql2 = "select 
                                        if(date(data_hora) like '%".date('Y-m-')."%', 'okay', 'excluir') 
                                        as condicao from tbl_mensalidade where id_filiado = ".$id;
                                $sql2 = $sql2." order by data_hora desc limit 1";
                                $select2 = mysqli_query($this->conect, $sql2);
                                
                                if(mysqli_affected_rows($this->conect) > 0){
                                    
                                    while($rs2 = mysqli_fetch_array($select2)){
                                        if($rs2['condicao'] != 'okay'){
                                            //Se a conta deve ser excluida
                                            $filiado[$cont]['id'] = $id;
                                            $cont++;
                                        }
                                    }
                                }else{
                                    $filiado[$cont]['id'] = $id;
                                    $cont++;
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