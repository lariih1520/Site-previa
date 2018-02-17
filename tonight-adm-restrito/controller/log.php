<?php
/**
    Data: 16/02/2018
    Objetivo: Login restrito
**/

class Controller{
    
    public function Logar(){
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $login = $_POST['txtLogin'];
            $senha = $_POST['txtSenha'];
            
            if($login == 'admnrb'){
                if($senha == '1990-admn'){
                    header('Location:default.php');
                    
                }else{
                    header('Location:../ERRO.php');
                }
            }else{
                header('Location:../ERRO.php');
            }
            
        }
    }
    
}
?>