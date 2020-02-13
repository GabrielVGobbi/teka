<?php 

class dashController extends controller {

	public function index() {
		$teste = new Teste();
		
        if ($teste->isLogged() == false) {
            header("Location: " . BASE_URL_PAINEL . "login");
            exit();
        }
		
		$this->loadView(null, array('var' => $teste->get()));
	}

}