<?php
class Texte{
	public static function limit($texte, $d){
		return strlen($texte)>=$d ? substr(substr($texte,0,$d),0,strrpos(substr($texte,0,$d), ' '))."..." :$texte;
		}
	public static function date_french($d){
		$mois=array("Jan","Fév","Mars","Avr","Mai","Juin","Juil","Aout","Sept","Oct","Nov","Déc");
		$division= explode(" ", $d);
		$date= explode("-", $division[0]);
		$time= explode(":", $division[1]);
		return $date[2].'/'.$mois[$date[1] - 1].'/'.$date[0];
	}
	public static function date_french_time($d){
		$mois=array("Jan","Fév","Mars","Avr","Mai","Juin","Juil","Aout","Sept","Oct","Nov","Déc");
		$division= explode(" ", $d);
		$date= explode("-", $division[0]);
		$time= explode(":", $division[1]);
		return $date[2].'/'.$mois[$date[1] - 1].'/'.$date[0].' à '.$time[0].':'.$time[1];
	}
}


?>