<?php

	class ConexionDbAux{

		private $server		=	"192.168.0.16:3306";
		private $user		=	"webrcuser";
		private $pass		=	"w3brcus3r";
		private $dataBase	=	"db_aux";
		private $conect		=	null;


		public function getServer(){
			return $this->server;
		}
		
		public function setServer($server){
			$this->server = $server;
		}
		
		public function getUser(){
			return $this->user;
		}
		
		public function setUser($user){
			$this->user = $user;
		}
		
		public function getPass(){
			return $this->pass;
		}
		
		public function setPass($pass){
			$this->pass = $pass;
		}
		
		public function getDataBase(){
			return $this->dataBase;
		}
			
		public function setDataBase($dataBase){
			$this->dataBase = $dataBase;
		}
		
		public function getConect(){
			return $this->conect;
		}
		
		public function setConect($conect){
			$this->conect = $conect;
		}
		
		public function Conectar(){
			$this->setConect(mysqli_connect($this->getServer(),$this->getUser(),$this->getPass(),$this->getDataBase()));
			
			if($this->getConect()){
				return $this->getConect();
			}else{
				return "No se pudo conectar";
			}
			
		}
		
		public function Desconectar(){
			mysqli_close($this->getConect());
			return "Se ha desconectado";
		}
		
	}


?>