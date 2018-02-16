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

        $this->server = "localhost";
        $this->user = "root";
        $this->password = "bcd127";

    }

    public function conectar(){

        if($conexao = mysql_connect($this->server, $this->user, $this->password)){
          mysql_select_db('db_tonight');
          
        }else{
          echo("Erro de conexão");
          die();
        }

    }


    public function desconectar(){
      mysql_close();
    }

  }

?>
