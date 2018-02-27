<?php
  /**
	Objetivo: Estabelecer conexão com Banco de Dados
	Data: 09/02/2018
	Arquivos Relacionados: Todos os arquivos da pasta 'model'
  **/


  class Mysql_db{

    public $server;
    public $user;
    public $password;


    public function __construct(){
/*
        $this->server = "localhost";
        $this->user = "root";
        $this->password = "bcd127";
        $this->db = "db_tonight";
        */
        $this->server = "localhost";
        $this->user = "tonig231";
        $this->password = "9pL6q34mWu";
        $this->db = "tonig231_tonight";
        
    }

    public function conectar(){

        if($conexao = mysqli_connect($this->server, $this->user, $this->password, $this->db) or die ('Erro de conexão')){
          
          return $conexao;
            
        }else{
          echo("Erro de conexão");
          die();
        }

    }

    public function desconectar($conect){

      mysqli_close($conect);
    
    }

  }

?>
