<?php 
/**
    Data: 05/03/2018
    Objetivo: Manipulação de dados do acompanhante
**/

class ControllerAcompanhante{
    
    public function ListarAcompanhantes(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->SelectFiliados();
        
        return $rs;
    }
    
    public function PesquisarAcompanhante($pesq){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->SelectFiliadoPesq($pesq);
        
        return $rs;
    }
    
    public function ListarFiliadosDesativados(){
        require_once('model/cliente_class.php');
        
        $class = new Acompanhante();
        $rs = $class->SelectFiliadosDesativados();
        
        return $rs;
    }
    
    public function BuscarDadosFiliado($id){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->SelectFiliadoById($id);
        
        return $rs;
    }
    
    public function ExcluirHospede(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->DeleteHospedeById();
        
        return $rs;
    }
    
    public function ExcluirFiliadoMensalAtrasada(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->DeleteFiliadoMensalAtrasada();
        
        return $rs;
    }
    
    /* Buscar filiados atrasados com o pagamento */
    public function BuscarFiliadosPagAtraso(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->SelectFiliadosPagAtraso();
        
        return $rs;
    }
    
    /* Buscar filiados atrasados com o pagamento */
    public function AdicionarDesconto(){
        $class = new Acompanhante();
        $class->AdicionarDesconto();
        
    }
    
    /* Ativar ou desativar a conta do filiado */
    public function ContaAtivarDesativar(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $class = new Acompanhante();
            $class->ContaAtivarDesativar();
        }
    }
    
    /* Ativar ou desativar a conta do filiado */
    public function DelDesconto(){

        $class = new Acompanhante();
        $class->DelDesconto();
        
    }
    
    /* Buscar filiados atrasados com o pagamento */
    public function RecuperarContaFiliado(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->RecuperarContaFiliado();
        
    }
    
    /* Atualizar a situação das contas que não pagaram a mensalidade */
    public function AtualizarStatusPagamento(){
        require_once('model/filiado_class.php');
        
        $class = new Acompanhante();
        $rs = $class->AtualizarStatusPagamento();
        
    }
    
}

?>