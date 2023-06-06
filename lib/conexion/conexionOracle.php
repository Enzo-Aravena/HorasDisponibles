<?php

	class ConexionOracle{				
		private $server		=	"omidb.cormup/omiweb";
		private $user		=	"rc";
		private $pass		=	"RegistroClinico";
		private $dataBase	=	"omidb.cormup";
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
		
		public function ConectarOracle(){

			
			$this->setConect(oci_connect($this->getUser(),$this->getPass(),$this->getServer()));
			
			if($this->getConect()){
				return $this->getConect();
				
			}else{
				return "No se pudo conectar";
			}
			
		}
		
		public function Desconectar(){
			oci_close($this->getConect());
			return "Se ha desconectado";
		}
		
	}


?>