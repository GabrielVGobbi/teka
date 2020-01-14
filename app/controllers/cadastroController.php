<?php 

class cadastroController extends Controller {
	
	public function __construct()
    {
        parent::__construct();

        $this->filtro = array();
        $this->site = new Site();
        $this->email = new Email();



        $this->dataInfo = array(
			'titlePage' => '',
			'pageController' => 'cadastro'
        );
	}
	
	public function index() {
		 
		$this->dataInfo['etapas']   = $this->site->getEtapas(true);

		$this->loadView('', $this->dataInfo, false);
	}

	public function action(){


        if (isset($_POST['cli_nome']) && $_POST['cli_nome'] != '') {
            
            if(!isset($_POST['id'])) {
                
                $this->site->addClienteByCadastro($_POST,'1');


                header('Location:' . BASE_URL_PAINEL . 'login');
                

            } else {
                
                $this->site->edit($_POST,'1');
                
                header('Location:' . BASE_URL . $this->dataInfo['pageController']);
                exit();
            }

        } else { }

    }



}
