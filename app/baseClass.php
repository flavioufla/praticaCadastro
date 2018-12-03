<?php

class baseClass {

	private $db_server;
	private $db_user;
	private $db_pass;
	private $db_database;
	private $result;

	protected $conn;
	
	public function __construct(){

		$this->db_server = 'localhost';
		$this->db_user     = 'root';
		$this->db_pass     = 'toor';
		$this->db_database = 'cep';		

		$this->_connect();

	}

	private function _connect(){
	
		try {

			$this->conn = new mysqli($this->db_server, $this->db_user, $this->db_pass, $this->db_database);
			
			if (mysqli_connect_error()){
				throw new Exception('MySQL Connection Database Error: ' . mysqli_connect_error());
			}
			
		
		} catch (Exception $e) {

			die ($e);
		
		}
	}

}