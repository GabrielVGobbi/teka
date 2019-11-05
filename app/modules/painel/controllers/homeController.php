<?php 

Class homeController extends Controller {


    public function __construct(){

		$this->user 	= new Users();
		$this->user->setLoggedUser();
	
		if($this->user->isLogged() == false){
			header("Location: ".BASE_URL."painel/login");
			exit();	
		}

		$this->dataInfo = array(
            'pageController' => 'dashboard',
			'user' => $this->user->getInfo($this->user->getId(), $this->user->getCompany()),
			'titlePage' => 'Dashboard'

        );

	}

	public function index() {
		
		$this->dataInfo['tableDados'] = array();
        
		
		$this->loadView(null, $this->dataInfo, true);
	}

}