<?php

class AccountController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $this->filtro = array();
        $this->cliente = new Cliente();
        $this->painel = new Painel();


        $this->dataInfo = array(
            'titlePage' => 'clientes'
        );
    }

    public function index()
    {}

    public function cadastro()
    {
        $this->dataInfo['etapas']   = $this->painel->getEtapas(true);
        $this->loadView("entrevista", $this->dataInfo, false);
    }

    public function ValidateClienteDouble(){
        $data = array();
        $data = $this->cliente->validacao('1', $_POST['nome']);
        echo json_encode($data);     
    }

    public function getEtapasById()
    { 
        $this->retorno = $this->painel->getEtapaById('1', $_POST);
        echo json_encode($this->retorno);
    }

    
}
