<?php



class USER{


	public static function isLog($db){
	if (isset($_SESSION['user']) and isset($_SESSION['user']['email']) and isset($_SESSION['user']['password']) and isset($_SESSION['token'])) {
		$data = array('username' =>$_SESSION['user']['username'] ,
					  'password' =>$_SESSION['user']['password']
		 );
		 		$sql= "select  email, username from users where username=:username and password=:password limit 1 ";
		 		$req= $db->tquery($sql, $data);
		 		if (!empty($req)) {
		 			if (USER::hashPassword($_SESSION['uncrypted_token']) == $_SESSION['token']) {
		 				$_SESSION['authentificated']=true;
		 			return true;
		 			}
		 			
		 		}
	}
	$_SESSION['authentificated']=false;
	return false;
}




	public static function pseudo_unique($db,$pseudo){
		$sql= "select * from users where username=:pseudo limit 1";
		$req= $db->tquery($sql, array('pseudo' => $pseudo));
		if (empty($req)) {
			return true;
		}
		return false;
	}

	public static function email_unique($db,$email){
		$data = array('email' => $email);
		$sql= "select email from users where email=:email limit 1";
		$req= $db->tquery($sql, $data);
		if (empty($req)) {
			return true;
		}
		return false;
	}

	public static function hashPassword($password){
		return sha1(SALT.md5($password.SALT).sha1(SALT));
	}
	public static function auth(){
		if (isset($_SESSION['token']) && USER::hashPassword($_SESSION['uncrypted_token'])==$_SESSION['token']) {
			$_SESSION['authentificated']=true;
			return true;
		}else{
			$_SESSION['authentificated']= false;
			return false;
		}
	}

	public static function generate($nbr){
		$string="";
		$chaine="abcdefghijklmnopqrstuvwxyz123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		for ($i=0; $i <$nbr ; $i++) { 
			$string.=$chaine[rand()%strlen($chaine)];
		}
		return $string;
	}
}
?>