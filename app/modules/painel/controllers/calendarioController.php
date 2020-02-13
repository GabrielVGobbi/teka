<?php

class CalendarioController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new Users();
        $this->user->setLoggedUser();

        $this->id_company = $this->user->getCompany();


        if ($this->user->isLogged() == false) {
            header("Location: " . BASE_URL_PAINEL . "login");
            exit();
        }

        $this->filtro = array();
        $this->cliente = new Cliente();
        $this->painel = new Painel();


        $this->dataInfo = array(
            'pageController' => 'calendario',
            'nome_tabela'   => 'calendario',
            'titlePage' => 'calendario'
        );
    }

    public function index()
    {
        if ($this->user->hasPermission('calendario_view')) {

            $this->loadView($this->dataInfo['pageController'] . "/index", $this->dataInfo, false);
            
        } else {

            $this->loadViewErrorNotPermission();
        }
    }

    

    
}
