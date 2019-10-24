<?php 

class Teste extends Model {

	public function isLogged()
	{

		if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser']) || isset($_COOKIE['lembrar'])) {
			return true; //se a session esta aberta e não esta vazia retorna true

		} else {

			return false; //se a session esta aberta e não esta vazia retornao false
		}
	}
}