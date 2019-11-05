<?php

Class usuarioController extends controller {

	public function __construct(){
		parent::__construct();

		$this->user = new Users();
		$this->user->setLoggedUser();
		
		if($this->user->isLogged() == false){

			header("Location: ".BASE_URL."login");
			exit();
		}

		$company = new Companies($this->user->getCompany());
		$this->dataInfo = array();

		$this->dataInfo = array(
			'pageController' => 'usuarios',
			'user' => $this->user->getInfo($this->user->getId(), $this->user->getCompany()),
		);

	}

	public function index(){
		
		if($this->user->hasPermission('user_view')){

			$this->dataInfo['tableInfo'] = $this->user->getList();

			$this->loadTemplate($this->dataInfo['pageController']."/index", $this->dataInfo);
		} else {
			
			

		}
	}


	public function add() {
		
		$this->dataInfo['company_name'] = $company->getName();
		$this->dataInfo['user_email'] = $this->user->getEmail(); 

		if($this->user->hasPermission('user_view') && $this->user->hasPermission('users_add')){

			$p= new Permissions();
			$this->dataInfo['group_list'] = $p->getGroupList($this->user->getCompany());

			if(isset($_POST['email']) && !empty($_POST['email'])){



				$email = addslashes($_POST['email']);
				$login = addslashes($_POST['login']);
				$pass = addslashes($_POST['password']);
				$group = addslashes($_POST['group']);

				$a = $this->user->add($login,$email,$pass,$group,$this->user->getCompany());

				if($a == '1'){
					header("Location: ".BASE."users");
				} else {

					$this->dataInfo['error_msg'] = "Email ja Cadastrado!!";
				}
		   //se namepost existe e ta preenchido

			}
			$this->loadTemplate('users_add', $this->dataInfo);
		} else {

			echo "<html><SCRIPT LANGUAGE='JavaScript'>

			window.alert('USUARIO NÃO AUTORIZADO!!')
			window.history.go(-1);
			</SCRIPT>

			</html>";

		} 
	}


	public function edit($id) {
		
		

		if($this->user->hasPermission('user_view') && $this->user->hasPermission('user_edit')){

			$p= new Permissions();

			if(isset($_POST['group']) && !empty($_POST['group'])){

				

				header("Location: ".BASE."users");
			}
			

			$this->loadTemplate($this->dataInfo['pageController']."/editar", $this->dataInfo);

		} else {

			echo "<html><SCRIPT LANGUAGE='JavaScript'>

			window.alert('USUARIO NÃO AUTORIZADO!!')
			window.history.go(-1);
			</SCRIPT>

			</html>";

		} 
	}

	public function delete($id){

		if($this->user->hasPermission('user_view') && $this->user->hasPermission('user_delete')){

			$permissions = new Permissions();

			header("Location: ".BASE."usuario");

			$this->user->delete($id, $this->user->getCompany());

			





		} else {

			

		}
	}































}
?>