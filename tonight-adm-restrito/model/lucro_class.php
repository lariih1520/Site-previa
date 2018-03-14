<?php
/**
    Data: 07/03/2018
    Objetivo: Lucro
**/

class Lucro{
    
    public $conect;
    public $titulo;
    public $idConta;
    public $valor;
    public $lucro;
    public $mesAno;
    public $nmrUsers;
    public $nmrUsersDesc;
    public $totalDesc;
    
    public function __construct(){
        require_once('db_class.php');
        
        $conexao = new Mysql_db();
        $this->conect = $conexao->conectar();
        
    }

    public function SelectMesAtual(){
        
        $sql = "select * from tbl_mensalidade where month(data_hora) = ".date('m');
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $lucro = 0;
            $totalDesc = 0;
            $usersDesconto = 0;
            
            while($rs = mysqli_fetch_array($select)){
                
                $valor = $rs['valor'];
                $desconto = $rs['desconto'];
                
                $lucro = $lucro + $valor;
                
                if($desconto > 0){
                    $totalDesc = $totalDesc + $desconto;
                    $usersDesconto = $usersDesconto + 1;
                }
                
            }
            
            $resp = new Lucro;
            
            $resp->lucro = $lucro - $totalDesc;
            $resp->desconto = $totalDesc;
            $resp->usersDesconto = $usersDesconto;
            
            return $resp;
        }else{
            return false;
        }
        
    }
    
    public function SelectMesAtualMedia(){
        
        $sql1 = "select * from tbl_filiado where conta_ativa = 1";
        
        if($select1 = mysqli_query($this->conect, $sql1)){
            
            $cont1 = 0;
            while($rs1 = mysqli_fetch_array($select1)){
                
                $lucro = new Lucro;
                
                $lucro[$cont1]->conta = $rs1['titulo'];
                $lucro[$cont1]->idConta = $rs1['id_tipo_conta'];
                $id = $lucro[$cont1]->idConta;
                $sql2 = "select count(*) as nmr from tbl_filiado where id_tipo_conta =".$id." and conta_ativa = 1";
                
                if($select2 = mysqli_query($this->conect, $sql2)){

                    while($rs2 = mysqli_fetch_array($select2)){
                        
                        $lucro[$cont1] = $rs2['nmr'];
                        
                    }
                }
                
            }
            
        }else{
            return false;
        }
        
    }
    
    public function SelectUsersTipoConta(){
        
        $sql1 = "select * from tbl_tipo_conta";
        
        if($select1 = mysqli_query($this->conect, $sql1)){
            
            $cont1 = 0;
            while($rs1 = mysqli_fetch_array($select1)){
                
                $lucro[] = new Lucro;

                $lucro[$cont1]->titulo = $rs1['titulo'];
                $lucro[$cont1]->idConta = $rs1['id_tipo_conta'];
                $lucro[$cont1]->valor = $rs1['valor'];
                
                $id = $lucro[$cont1]->idConta;
                $sql2 = "select count(*) as nmr from tbl_filiado where id_tipo_conta =".$id." and conta_ativa = 1";
                
                if($select2 = mysqli_query($this->conect, $sql2)){

                    while($rs2 = mysqli_fetch_array($select2)){
                        
                        $lucro[$cont1]->nmrUsers = $rs2['nmr'];
                        
                    }
                }
                
                $lucro[$cont1]->lucro = $lucro[$cont1]->valor * $lucro[$cont1]->nmrUsers;
                
                $cont1++;
            }
            return $lucro;
        }else{
            return false;
        }
    }
    
    public function SelectHistoricoMensal(){
        
        $sql = "select date(data_hora) as data from tbl_mensalidade group by month(data_hora)";
        
        if($select = mysqli_query($this->conect, $sql)){
            
            $cont = 0;
            while($rs = mysqli_fetch_array($select)){
                
                $resp[] = new Lucro();

                $databd = $rs['data'];
                $dataexpd = explode('-', $databd);
                $mes = $dataexpd[1];
                $ano = $dataexpd[0];
                $resp[$cont]->mesAno = $mes.'/'.$ano;

                $sql1 = "select * from tbl_mensalidade where data_hora like '%".$databd."%'";

                if($select1 = mysqli_query($this->conect, $sql1)){
                    
                    $usersDesc = 0;
                    $valorDesc = 0;
                    $lucro = 0;
                    while($rs1 = mysqli_fetch_array($select1)){
                        $resp[$cont]->nmrUsers = mysqli_num_rows($select1);
                        
                        $lucro = $lucro + $rs1['valor'];
                        if($rs1['desconto'] > 0){
                            $usersDesc = $usersDesc + 1;
                            $valorDesc = $valorDesc + $rs1['desconto'];
                        }
                        
                    }
                }
                $resp[$cont]->nmrUsersDesc = $usersDesc;
                $resp[$cont]->totalDesc = $usersDesc * $valorDesc;
                $resp[$cont]->lucro = $lucro - $resp[$cont]->totalDesc;
                
                $cont++;
            }
            
            return $resp;
            
        }else{
            return false;
        }
    }
    

}

?>