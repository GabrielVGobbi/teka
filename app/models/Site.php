<?php

class Site extends model
{

	#Cliente Cadastrado Pelo Site 
	public function addClienteByCadastro($Parametros, $id_company)
	{

		$id_endereco = isset($Parametros['cep']) && $Parametros['cep'] != '' ? $this->setEnderecoCliente($Parametros, $id_company) : '';

		$cli_nome 		 = isset($Parametros['cli_nome']) ? controller::ReturnValor($Parametros['cli_nome']) : '';
		$cli_sobrenome 	 = isset($Parametros['cli_sobrenome']) ? controller::ReturnValor($Parametros['cli_sobrenome'])  : '';
		$cli_profissao 	 = isset($Parametros['cli_profissao']) ? controller::ReturnValor($Parametros['cli_profissao'])  : '';

		$cli_aniversario = isset($Parametros['cli_aniversario']) ? ($Parametros['cli_aniversario'])  : '';
		$cli_email 		 = isset($Parametros['cli_email']) ? (mb_strtolower($Parametros['cli_email'], "UTF-8"))  : '';
		$cli_telefone 	 = isset($Parametros['cli_telefone']) ? ($Parametros['cli_telefone'])  : '';


		$params = isset($Parametros['etapas']) ? implode(',', $Parametros['etapas']) : '';

		try {
			$sql = $this->db->prepare("INSERT INTO client SET 
				
				cli_nome 		= :cli_nome, 
				cli_sobrenome 	= :cli_sobrenome,
				cli_aniversario = :cli_aniversario,
				cli_telefone 	= :cli_telefone,
				cli_profissao 	= :cli_profissao,
				cli_email       = :cli_email,
				id_address 		= :id_endereco,
				cli_etapas 		= :params,
				
				created_at		= NOW(),
				id_company 		= :id_company
			
			");

			$sql->bindValue(":cli_nome", $cli_nome);
			$sql->bindValue(":cli_sobrenome", $cli_sobrenome);
			$sql->bindValue(":cli_aniversario", $cli_aniversario);
			$sql->bindValue(":cli_telefone", $cli_telefone);
			$sql->bindValue(":cli_profissao", $cli_profissao);
			$sql->bindValue(":cli_email", $cli_email);
			$sql->bindValue(":cli_telefone", $cli_telefone);

			$sql->bindValue(":id_endereco", $id_endereco);
			$sql->bindValue(":id_company", $id_company);
			$sql->bindValue(":params", $params);


			if ($sql->execute()) {

				$id_cliente = $this->db->lastInsertId();

				//Add usuario pelo cliente cadastrado
				if (isset($Parametros['action'])  && isset($Parametros['type'])) {
					$this->addUsuarioByCliente($id_company, $Parametros, $id_cliente);
					$p = new Permissions;
					$p->addPermissions($id_cliente, $id_company);

				}

				#controller::setLog($Parametros, 'cliente', 'add');

				controller::alert('success', 'Sucesso!! Faça o login com suas credenciais');
				
				#$email = new Email;
				
				#$email->enviarEmail($Parametros);

				return $id_cliente;
			}
		} catch (PDOExecption $e) {

			$sql->rollback();
			error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));

			controller::alert('warning', 'Não foi possivel cadastrar o cliente, contate o administrador da empresa');
		}

		#_FILES['fotos']
	}

	

	public function setEnderecoCliente($Parametros, $id_company, $id_endereco = false)
	{

		if ($id_endereco == false && !empty($Parametros['cep'])) {

			$sql = $this->db->prepare("INSERT INTO cliente_endereco SET 
				
				cep = :cep,
				rua = :rua, 
				numero = :numero,
				complemento = :complemento
			
			");
			$sql->bindValue(":cep", $Parametros['cep']);
			$sql->bindValue(":rua", $Parametros['rua']);
			$sql->bindValue(":numero", $Parametros['numero']);
			$sql->bindValue(":complemento", $Parametros['complemento']);

			$sql->execute();

			$id_endereco = $this->db->lastInsertId();
		} else {

			$sql = $this->db->prepare("UPDATE `cliente_endereco` SET  
				
				cep = :cep,
				rua = :rua, 
				numero = :numero,
				complemento = :complemento

				WHERE id_endereco = :id_endereco
			
			");
			$sql->bindValue(":cep", $Parametros['cep']);
			$sql->bindValue(":rua", $Parametros['rua']);
			$sql->bindValue(":numero", $Parametros['numero']);
			$sql->bindValue(":complemento", $Parametros['complemento']);
			$sql->bindValue(":id_endereco", $id_endereco);

			$sql->execute()
				? controller::alert('success', 'Editado com sucesso')
				: controller::alert('error', 'Ops!! deu algum erro');
		}

		return $id_endereco;
	}

	public function validacao($id_company, $nome, $id = '')
	{
		$nome = controller::ReturnValor($nome);

		$sql = $this->db->prepare("
			SELECT * FROM client
			WHERE id_company = :id_company AND cli_nome = :cli_nome
		");

		$sql->bindValue(':cli_nome', $nome);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function addUsuarioByCliente($id_company, $Parametros, $id_cliente)
	{


		$pass  = ($Parametros['cli_senha']);
		$name = $Parametros['cli_nome'] . ' ' . $Parametros['cli_sobrenome'];
		$email = $Parametros['cli_email'];

		$sql = $this->db->prepare("
			INSERT INTO users SET 
			id_company = :id_company,
			password = :password,
			usr_info = :cliente,
			id_cliente = :id_cliente,
			name = :name,
			email = :email
        ");

		$sql->bindValue(":password", md5($pass));
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":cliente", 'cliente');
		$sql->bindValue(":id_cliente", $id_cliente);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":email", $email);

		$sql->execute();

		#controller::setLog($Parametros, 'acesso_usuario', 'add');

		$id = $this->db->lastInsertId();

		return $id;
	}

	public function getEtapas($type = false)
	{

		$type = $type == false ? '' : 'WHERE etp_type = 2';

		$sql = $this->db->prepare("SELECT * FROM etapas {$type}");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->retorno = $sql->fetchAll();
		}

		return $this->retorno;
	}

	public function getEtapaById($id_company, $Parametros)
	{

		$params = implode(',', $Parametros['id_etapa']);

		$sql = $this->db->prepare("SELECT * FROM etapas WHERE id_etapa IN ({$params}) AND id_company = :id_company AND etp_type = 2");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->retorno = $sql->fetchAll();
		}

		return $this->retorno;
	}
}
?>
