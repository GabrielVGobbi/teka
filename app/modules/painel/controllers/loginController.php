<?php
class loginController extends controller {

	public function __construct() {
        
		$this->dataInfo = array(
			'error' => ''
		);
	}

	public function index(){

		if(!empty($_SESSION['errorMsg'])){
			$this->dataInfo['error'] = $_SESSION['errorMsg'];
			$_SESSION['errorMsg'] = '';
		}

		

		$this->loadView(null, $this->dataInfo, false);	
	}

	public function index_post(){

		if(isset($_POST['login']) && !empty($_POST['password'])){


			$array = $this->post();

			$login = addslashes(lcfirst($_POST['login']));
			$pass = addslashes(ltrim($_POST['password']));
			$u = new Users();

			if($u->doLogin($login, $pass)){
				header("location:".BASE_URL_PAINEL."home");
				exit;
			} else {
				$_SESSION['errorMsg'] = 'senha e/ou usuario estão incorretos';
			}
			
		}else {
			$_SESSION['errorMsg'] = "Preencha TODOS os campos";
		}
		
		header("Location:".BASE_URL_PAINEL."login");
		exit();

	}

	public function logout(){

		$u = new Users();
		$u->setLoggedUser();
		$u->logout();
		header("Location:".BASE_URL_PAINEL."login");
		
	}
}