<?php
class Painel extends model
{

    public function __construct()
    {
        parent::__construct();
        $this->array = array();
        $this->retorno = array();
    }

    public function dataTable()
    { 



    }

    public function getEtapas($type = false)
    { 

        $type = $type == false ? '' : 'WHERE etp_type = 2';

        $sql = $this->db->prepare("SELECT * FROM etapas {$type}");
		$sql->execute();

		if($sql->rowCount() > 0 ) {
			$this->retorno = $sql->fetchAll();
        }
        
        return $this->retorno;

    }

    public function getEtapaById($id_company, $Parametros){

        $params = implode(',', $Parametros['id_etapa']);

        $sql = $this->db->prepare("SELECT * FROM etapas WHERE id_etapa IN ({$params}) AND id_company = :id_company AND etp_type = 2");
        $sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if($sql->rowCount() > 0 ) {
			$this->retorno = $sql->fetchAll();
        }
        
        return $this->retorno;

    }

    public function getperguntas($id_company){

        $sql = $this->db->prepare("SELECT * FROM client_perguntas WHERE id_company = :id_company");
        $sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if($sql->rowCount() > 0 ) {
			$this->retorno = $sql->fetchAll();
        }
        
        return $this->retorno;

    }

}
