<?php

class ConfigController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new Users();
        $this->user->setLoggedUser();

        $this->id_company = $this->user->getCompany();
        
        if ($this->user->isLogged() == false && $this->user->isClient() == 0) {
            header("Location: " . BASE_URL_PAINEL . "login");
            exit();
        }

        $this->filtro = array();
        $this->cliente = new Cliente();
        $this->painel = new Painel();
        $this->permissions = new Permissions();

        $this->dataInfo = array(
            'pageController' => 'configuracao',
            'nome_tabela'   => 'config',
            'titlePage' => 'Configurações'
        );
    }

    public function index()
    {

        if ($this->user->hasPermission('config_view')) {

            $this->cliente->maxPerPage(10);

            $this->dataInfo['tableDados'] = $this->cliente->paginate();

            $this->loadView($this->dataInfo['pageController'] . "/index", $this->dataInfo);
        } else {

            $this->loadViewErrorNotPermission();
        }
    }

    public function add()
    {

        if ($this->user->hasPermission('clientes_view')) {

            $this->dataInfo['titlePage'] = 'Adicionar';

            $this->loadView($this->dataInfo['pageController'] . "/cadastrar", $this->dataInfo);
        } else {

            $this->loadViewErrorNotPermission();
        }
    }

    public function action()
    {

        if (isset($_POST['cli_nome']) && $_POST['cli_nome'] != '') {

            if (!isset($_POST['id'])) {

                $id_cliente = $this->cliente->add($_POST, $this->user->getCompany(), $_FILES);

                header('Location:' . BASE_URL_PAINEL . $this->dataInfo['pageController'] . '/info/' . $id_cliente);

                exit();
            } else {

                $this->cliente->edit($_POST, $this->user->getCompany());
                

                header('Location:' . BASE_URL_PAINEL . $this->dataInfo['pageController']);

                exit();
            }
        } else {
        }
    }

}
