<?php
class ajaxController extends controller
{

    public function __construct()
    {
        $this->user = new Users();
        $this->user->setLoggedUser();

        $this->painel = new Painel();
        $this->cliente = new Cliente();

        if ($this->user->isLogged() == false) {
            header("Location: " . BASE_URL_PAINEL . "/login");
            exit;
        }

        $this->retorno = array();
    }

    public function index()
    {
    }

    public function getEtapasById()
    {

        $this->retorno = $this->painel->getEtapaById($this->user->getCompany(), $_POST);

        echo json_encode($this->retorno);
    }

    public function ValidateClienteDouble()
    {

        $u = new Users();
        $u->setLoggedUser();
        $data = array();

        $data = $this->cliente->validacao($this->user->getCompany(), $_POST['nome']);

        echo json_encode($data);
    }


    public function addPhotoClient($typePasta = 'inUsed', $id_cliente = '')
    {


        $u = new Users();
        $u->setLoggedUser();
        $c = new Cliente();

        $id_company = $u->getCompany();

        $Parametros = array();

        $folder_name = 'app\assets\images\clientes';

        $cliente = $c->getClienteByIdName($id_cliente, $id_company);

        if (!empty($id_cliente)) {

            //add
            if (!empty($_FILES)) {
                $name = str_replace(' ', '_', $cliente['cli_nome']).'_'.str_replace(' ', '_', $cliente['cli_sobrenome']);

                $name = str_replace('-', '', $name);
                $name = str_replace(' - ', '_', $name);
                $name = str_replace(' ', '_', $name);

                $c->addPhotoExImagemClient($id_cliente, mb_strtolower($name,'UTF-8'), $_FILES, $id_company, $typePasta);
            }
        }
    }

    public function getImagesByCliente($typePasta, $id_cliente, $nomecliente)
    {
        
        $u = new Users();
        $u->setLoggedUser();
        $c = new Cliente();

        $id_company = $u->getCompany();

        $arrayFotos = $c->getFotosByPasta($id_cliente, $typePasta, $id_company);
        $qntFoto = 0;
        if (isset($arrayFotos) && !empty($arrayFotos)) {
            $qntFoto = count($arrayFotos);
            foreach ($arrayFotos as $doc) {
                $scanDir[] = $doc;
            }
        }

        $output = '<div class="row">';

        if (isset($scanDir) && false !== $scanDir) {

            foreach ($scanDir as $file) {

                if ('.' !=  $file && '..' != $file) {

                    $type = explode('.', $file['img_url']);
                    $type = isset($type[1]) ? mb_strtoupper($type[1], 'UTF-8') : '??';

                    switch ($type) {
                        case 'PNG':
                            $icon =  "fa fa-fw fa-file-picture-o";
                            break;
                        case 'JPG':
                            $icon =  "fa fa-fw fa-file-image-o";
                            break;
                        default;
                            $icon =  "fa fa-file-picture-o";
                            break;
                    }

                    $fileName = mb_strimwidth($file['img_url'], 0, 90, "...");
                    $output .= '
                            <li style="    max-width: 200px;
                                min-width: 200px;
                                max-height: 200px;
                                min-height: 200px;">
                                <span class="mailbox-attachment-icon">
                                    <img
                                class="fa fa-fw fa-file-image-o img-responsive" src="'. BASE_URL .'app/assets/images/clientes/'. mb_strtolower($id_cliente,'UTF-8') .'/' . $file['img_type'] . '/'. mb_strtolower($file['img_url'],'UTF-8').'">
                                    </img>
                                </span>
                                <div class="mailbox-attachment-info"  style="max-width: 29ch;
                                overflow: hidden;
                                text-overflow: ellipsis;
                                white-space: nowrap;">
                                    <a href="'. BASE_URL .'app/assets/images/clientes/'. mb_strtolower($id_cliente,'UTF-8') .'/' . $file['img_type'] . '/'. mb_strtolower($file['img_url'],'UTF-8').'" target="_blank" class="mailbox-attachment-name">' . $fileName . '</a>
                                    <span class="mailbox-attachment-size">
                                        ' . $type . '
                                        <a download href="'. BASE_URL .'app/assets/images/clientes/'. mb_strtolower($id_cliente,'UTF-8') .'/' . $file['img_type'] . '/'. mb_strtolower($file['img_url'],'UTF-8').'" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                                        <a onclick="toastAlertDelete(' . $file['id_image'] . ', ' . $id_cliente . ')" class="btn btn-default btn-xs pull-right"><i class="fa fa-trash"></i></a>

                                        </span>
                                </div>
                            </li>
                        ';
                }
            }
        } else {
            $output .= '<p class="lead">sem imagens</p>';
        }

        $output .= '</div>';

        echo ($output);
    }


    function saveComentyExercicioImagem()
    {

        $u = new Users();
        $u->setLoggedUser();

        if(isset($_POST) && isset($_POST['id_etapa']) && !empty($_POST['id_etapa'])){

            $id_cliente =  !empty($u->getClienteId()) ? $u->getClienteId() : $_POST['id_cliente']; 
            
            $notepad = $u->saveComentyExercicioImagem($_POST, $id_cliente, $u->getCompany());

            echo $notepad ? json_encode($notepad) : false;
        }

    }


}
