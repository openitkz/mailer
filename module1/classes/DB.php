<?php

class DB{
	private static $instance,
				   $host='localhost',
				   $dbname='openit',
				   $user='root',
				   $pass='a';

	private $db=null,
			$first=null,
			$stmt=null,
			$results=[];

	private function __construct(){
		$this->db=new PDO('mysql:host='.self::$host.';dbname='.self::$dbname, self::$user, self::$pass);
	}

	public static function getInstance(){
		if(!self::$instance){
			self::$instance=new DB();
		}
		return self::$instance;
	}


	public function query($query, $params=array()){
		$this->stmt=$this->db->prepare($query);
		$this->stmt->execute($params);
		return $this;
	}

	public function get(){
		$this->flushResults();
		if($this->stmt){
			while($row=$this->stmt->fetch(PDO::FETCH_OBJ)){
				$this->results[]=$row;
			}
		}
		return $this->results;
	}

	public function flushResults(){
		$this->results=[];
	}

	public function first(){
		$this->flushFirst();
		if($this->stmt){
			$this->first=$this->stmt->fetch(PDO::FETCH_OBJ);
		}
		return  $this->first;
	}

	public function flushFirst(){
		$this->first=null;
	}
}