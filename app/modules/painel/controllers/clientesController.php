<?php

class ClientesController extends controller
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
        $this->permissions = new Permissions();
        $this->email = new Email();

        $this->dataInfo = array(
            'pageController' => 'clientes',
            'nome_tabela'   => 'cliente',
            'titlePage' => 'clientes'
        );

        
    }

    public function index()
    {

        if ($this->user->hasPermission('clientes_view')) {

            $this->cliente->maxPerPage(10);

            $this->dataInfo['tableDados'] = $this->cliente->paginate();

            #$this->email->notifyEmailClient(84, $this->user->getCompany());

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

                if(isset($_POST['notifyEmail']) && ($_POST['notifyEmail'] == 'true')){

                    $this->email->notifyEmailClient($id_cliente, $this->user->getCompany());
                    
                }

                header('Location:' . BASE_URL_PAINEL . $this->dataInfo['pageController'] . '/info/' . $id_cliente);

                exit();

            } else {

                $this->cliente->edit($_POST, $this->user->getCompany(), $_FILES, $this->user->getId() );
                
                header('Location:' . BASE_URL_PAINEL . $this->dataInfo['pageController'] . '/info/' . $_POST['id'] );

                exit();
            }
        } else {
        }
    }

    public function info($id_cliente)
    {

        if ($this->user->hasPermission('clientes_view') && $this->user->hasPermission('clientes_edit')) {

            $this->dataInfo['tableInfo']        = $this->cliente->getInfo($id_cliente, $this->id_company);
            $this->dataInfo['paleta']           = $this->cliente->getPaleta($this->id_company);
            $this->dataInfo['entrevista']       = $this->cliente->getEntrevista($this->id_company);
            $this->dataInfo['permissons_all']   = $this->permissions->getlistCliente($this->id_company);


            if (!empty($this->dataInfo['tableInfo'])) {
                $this->loadView($this->dataInfo['pageController'] . "/editar", $this->dataInfo);
            } else {
                $this->loadViewErrorNotPermission();
            }
        } else {
            $this->loadViewErrorNotPermission();
        }
    }

    public function entrevista($id_cliente)
    {
        if ($this->user->hasPermission('clientes_view') && $this->user->hasPermission('clientes_edit')) {

            $this->dataInfo['tableInfo']        = $this->cliente->getInfo($id_cliente, $this->id_company);
            $this->dataInfo['etapas']   = $this->painel->getEtapas(true);
            $this->dataInfo['perguntas']   = $this->painel->getperguntas($this->user->getCompany());
            
            
            $this->loadView($this->dataInfo['pageController'] . "/include/Entrevista", $this->dataInfo, false);
        } else {

            $this->loadViewErrorNotPermission();
        }
    }

    public function actionPermissions()
    {

        if (isset($_POST['id_cliente']) && $_POST['id_cliente'] != '') {

            $this->cliente->editPermissions($_POST['permissions'], $this->user->getCompany(), $_POST['id_cliente']);

            header('Location:' . BASE_URL_PAINEL . $this->dataInfo['pageController'] . '/info/' . $_POST['id_cliente']);

            exit();
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

        if(!$this->user->isClient()){
            
            $id_cliente = $this->user->getIdUserByClient($id_cliente, $this->id_company);

            $type = '(1,'.$id_cliente.')';

        } else {

            $id_cliente = $this->user->getId();
            
            $type = '(1,'.$id_cliente.')';

        }
        

        return $this->cliente->getComentarioByEtapaById($tipoEtapa, $this->id_company, $type);

    }

    public function ColoracaoByClient($id_cliente){

        if (isset($_POST) && $id_cliente != '') {

            $this->cliente->editColoracaoByClient($id_cliente, $this->user->getCompany(), ($_POST));

            header('Location:' . BASE_URL_PAINEL . $this->dataInfo['pageController'] . '/info/' . $id_cliente);

            exit();
        } 

    }
}
