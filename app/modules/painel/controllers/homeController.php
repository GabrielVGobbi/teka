<?php 

Class homeController extends controller {


    public function __construct(){

		$this->user 	= new Users();
		$this->user->setLoggedUser();
        $this->id_company = $this->user->getCompany();

		
        $this->filtro = array();
        $this->cliente = new Cliente();
		$this->painel = new Painel();
        $this->email = new Email();
		

	
		if($this->user->isLogged() == false){
			header("Location: ".BASE_URL_PAINEL."login");
			exit();	
		}

		$this->dataInfo = array(
            'pageController' => 'home',
			'user' => $this->user->getInfo($this->user->getId(), $this->user->getCompany()),
			'titlePage' => 'Bem-vindo(a)',
			'tableDados' => array()

        );

	}

	public function index() {
		
		if($this->user->getCliente() == true){
			$this->dataInfo['tableInfo']    = $this->cliente->getInfo($this->user->getClienteId(), $this->id_company);
			
			$this->loadView('', $this->dataInfo);

		}
		$this->dataInfo['paleta']       = $this->cliente->getPaleta($this->user->getCompany());
		$this->dataInfo['entrevista']   = $this->cliente->getEntrevista($this->user->getCompany());


		#$this->email->enviarEmail();
	}

	public function entrevista($id_cliente)
    {
        if ($id_cliente == $this->user->getClienteId()) {

			$this->dataInfo['etapas']      = $this->painel->getEtapas(true);
            $this->dataInfo['perguntas']   = $this->painel->getperguntas($this->user->getCompany());

			$this->loadView('clientes' . "/Entrevista", $this->dataInfo, false);
			
        } else {

            $this->loadViewErrorNotPermission();
        }
	}
	
	public function deleteFotoCliente($id_img, $id_cliente){
        
        if (isset($id_cliente) && $id_cliente != '') {

            $cliente = $this->cliente->getClienteByIdName($id_cliente, $this->user->getCompany());

            $nomecliente = str_replace(' ', '_', $cliente['cli_nome']).'_'.str_replace(' ', '_', $cliente['cli_sobrenome']);

            $this->cliente->deleteFotoByCliente($id_cliente, $id_img, $nomecliente, $this->user->getCompany());

            header('Location:' . BASE_URL_PAINEL . $this->dataInfo['pageController']);

            exit();
        } 

	}
	
	public function getComentarioByEtapaById($tipoEtapa, $id_cliente){

        $id_cliente =  !empty($this->user->getClienteId()) ? $this->user->getClienteId() : $id_cliente; 
        
        return $this->cliente->getComentarioByEtapaById($tipoEtapa, $id_cliente, $this->id_company);

    }

}