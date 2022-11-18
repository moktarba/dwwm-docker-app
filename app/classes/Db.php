<?php
// Les classes du blog

  class Db{
	private $host = HOST;
	private $name = DBNAME;
	private $user = USER;
	private $pass = PASS;
	public $connexion;

	public function __construct($host=null,$name=null,$user=null,$pass=null){
		if($host!=null){
			$this->host= $host;
			$this->name= $name;
			$this->user= $user;
			$this->pass= $pass;
		}
			try{
				$this->connexion = new PDO('mysql:host='.$this->host.';dbname='.$this->name,$this->user,$this->pass,array(
					PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES \'UTF8\'',
					PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
			}
			catch(PDOException $e){
				echo "Impossible de se connecter à la base de données";
				die();
			}
			  
	}

	public function query($sql, $data= array()){
		$req = $this->connexion->prepare($sql);
		$req->execute($data);
		return $req->fetchAll(PDO::FETCH_OBJ);
	} 

	public function tquery($sql, $data= array()){
		$req = $this->connexion->prepare($sql);
		$req->execute($data);
		return $req->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($sql, $data=array()){
		$req= $this->connexion->prepare($sql);
		$value= $req->execute($data);
		return $value;
	}
}
			
?>