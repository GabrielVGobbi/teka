<?php 

class dashController extends Controller {

	public function index() {
		$teste = new Teste();
		
        if ($teste->isLogged() == false) {
            header("Location: " . BASE_URL_PAINEL . "login");
            exit();
        }
		
		$this->loadView(null, array('var' => $teste->get()));
	}

}