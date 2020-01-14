<?php

class Cliente extends Model
{

	var $table = 'client';

	use Pagination;

	public function __construct()
	{
		parent::__construct();
		$this->array = array();
		$this->retorno = array();
	}

	public function getCount($id_company)
	{

		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) AS c FROM client WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();
		$row = $sql->fetch();

		$r = $row['c'];

		return $r;
	}

	public function getInfo($id_cliente, $id_company)
	{
		$sql = $this->db->prepare("SELECT * FROM client cli 
		
			INNER JOIN cliente_endereco clie ON (clie.id_endereco = cli.id_address)
			WHERE id_company = :id_company AND id_client = :id_client LIMIT 1
		");

		$sql->bindValue(':id_client', $id_cliente);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if ($sql->rowCount() == 1) {
			$this->permissions = new Permissions();
			$this->array = $sql->fetch();
			$this->permissions->setGroup($this->array['id_client'], $id_company, true);
			$this->array['permissions'] = $this->permissions->returnPermission();
		}

		return $this->array;
	}

	public function hasPermission($name)
	{
		return $this->permissions->hasPermission($name);
	}

	public function getPaleta($id_company)
	{
		$sql = $this->db->prepare("SELECT * FROM cartela WHERE id_company = :id_company");
		$sql->bindValue(":id_company", $id_company);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchALL();
		}

		return $this->array;
	}

	public function getEntrevista($id_company)
	{
		$sql = $this->db->prepare("SELECT * FROM etapas WHERE id_company = :id_company");
		$sql->bindValue(":id_company", $id_company);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchALL();
		}

		return $this->array;
	}

	public function add($Parametros, $id_company, $file)
	{

		$id_endereco = $this->setEnderecoCliente($Parametros, $id_company);

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

			$sql->bindValue(":cli_nome", ucfirst($cli_nome));
			$sql->bindValue(":cli_sobrenome", ucfirst($cli_sobrenome));
			$sql->bindValue(":cli_aniversario", $cli_aniversario);
			$sql->bindValue(":cli_telefone", $cli_telefone);
			$sql->bindValue(":cli_profissao", ucfirst($cli_profissao));
			$sql->bindValue(":cli_email", $cli_email);
			$sql->bindValue(":id_endereco", $id_endereco);
			$sql->bindValue(":id_company", $id_company);
			$sql->bindValue(":params", $params);

			if ($sql->execute()) {

				$id_cliente = $this->db->lastInsertId();

				//Add usuario pelo cliente cadastrado
				if (isset($Parametros['client'])  && $Parametros['client'] == true) {
					$this->addUsuarioByCliente($id_company, $Parametros, $id_cliente);
				}

				$nome_cliente = str_replace(' ', '_', $cli_nome);
				$cli_sobrenome = str_replace(' ', '_', $cli_sobrenome);
				$name = mb_strtolower($nome_cliente . '_' . $cli_sobrenome, 'UTF-8');

				if (!is_dir("app/assets/images/clientes/" . $name)) {
					mkdir("app/assets/images/clientes/" . $name);
					if (!is_dir("app/assets/images/clientes/" . $name . "/inUsed")) {
						mkdir("app/assets/images/clientes/" . $name . "/inUsed");
					}
					if (!is_dir("app/assets/images/clientes/" . $name . "/notUsed")) {
						mkdir("app/assets/images/clientes/" . $name . "/notUsed");
					}
					if (!is_dir("app/assets/images/clientes/" . $name . "/inLike")) {
						mkdir("app/assets/images/clientes/" . $name . "/inLike");
					}
				}

				if (isset($file) && !empty($file)) {
					$this->addPhoto($id_cliente, $file['fotos'], $id_company, $name);
				}

				$this->addPermissions($id_cliente, $id_company);

				#controller::setLog($Parametros, 'cliente', 'add');

				controller::alert('success', 'Cadastrado com sucesso, edite as permissões');

				$this->db = null;

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

		$login = mb_strtolower($Parametros['cli_login'], 'utf-8');
		$pass  = ($Parametros['password']);
		$name = $Parametros['cli_nome'] . ' ' . $Parametros['cli_sobrenome'];
		$email = $Parametros['cli_email'];

		$sql = $this->db->prepare("
			INSERT INTO users SET 
			login = :login,
			id_company = :id_company,
			password = :password,
			usr_info = :cliente,
			id_cliente = :id_cliente,
			name = :name,
			email = :email
        ");

		$sql->bindValue(":login", $login);
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

	public function addPhoto($id_cliente, $photo, $id_company, $nome_cliente, $type = '_user.jpg')
	{

		if (isset($photo)) {

			$tipo = $photo['type'];

			if (in_array($tipo, array('image/jpeg', 'image/png', 'image/jpg'))) {

				$tmpname = mb_strtolower($nome_cliente . $type, 'UTF-8');

				if (is_dir("app/assets/images/clientes/" . $nome_cliente)) {
					move_uploaded_file($photo['tmp_name'], 'app/assets/images/clientes/' . $nome_cliente . '/' . $tmpname);
				} else {
					mkdir("app/assets/images/clientes/" . $nome_cliente);
					move_uploaded_file($photo['tmp_name'], 'app/assets/images/clientes/' . $nome_cliente . '/' . $tmpname);
				}

				list($width_orig, $height_orig) = getimagesize('app/assets/images/clientes/' . $nome_cliente . '/' . $tmpname);
				$ratio = $width_orig / $height_orig;

				$width = 300;
				$height = 300;

				if ($width / $height > $ratio) {
					$width = $height * $ratio;
				} else {
					$height = $width / $ratio;
				}

				$img = imagecreatetruecolor($width, $height);
				if ($tipo == 'image/jpeg') {
					$origi = imagecreatefromjpeg('app/assets/images/clientes/' . $nome_cliente . '/' . $tmpname);
				} elseif ($tipo == 'image/png') {
					$origi = imagecreatefrompng('app/assets/images/clientes/' . $nome_cliente . '/' . $tmpname);
				}

				imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

				$imgag = imagejpeg($img, 'app/assets/images/clientes/' . $nome_cliente . '/' . $tmpname, 80);

				$sql = $this->db->prepare("
						UPDATE client SET
                			cli_photo = :cli_photo		  
						WHERE id_client = :id_cliente AND id_company = :id_company
					");
				$sql->bindValue(":id_cliente", $id_cliente);
				$sql->bindValue(":cli_photo", $tmpname);
				$sql->bindValue(":id_company", $id_company);

				$sql->execute();
			}
		} else {

			error_log(print_r('erro na foto', 1));
		}
	}

	public function addPhotoExImagemClient($id_cliente, $nome_cliente, $photo, $id_company, $pasta)
	{

		$type = explode('/', $_FILES['file']['type']);
		$type = '.' . $type[1];

		if (isset($photo)) {

			$tipo = $photo['file']['type'];

			if (in_array($tipo, array('image/jpeg', 'image/png', 'image/jpg'))) {

				$tmpname = (md5(time() . rand(0, 999))) . $type;

				if (is_dir("app/assets/images/clientes/" . $nome_cliente)) {
					if (!is_dir("app/assets/images/clientes/" . $nome_cliente . "/" . $pasta)) {
						mkdir("app/assets/images/clientes/" . $nome_cliente . "/" . $pasta);
					}

					move_uploaded_file($photo['file']['tmp_name'], 'app/assets/images/clientes/' . $nome_cliente . "/" . $pasta . '/' . $tmpname);
				} else {
					mkdir("app/assets/images/clientes/" . $nome_cliente);
					mkdir("app/assets/images/clientes/" . $nome_cliente . "/" . $pasta);

					move_uploaded_file($photo['file']['tmp_name'], 'app/assets/images/clientes/' . $nome_cliente . "/" . $pasta . '/' . $tmpname);
				}

				list($width_orig, $height_orig) = getimagesize('app/assets/images/clientes/' . $nome_cliente . "/" . $pasta . '/' . $tmpname);
				$ratio = $width_orig / $height_orig;

				$width = 300;
				$height = 300;

				if ($width / $height > $ratio) {
					$width = $height * $ratio;
				} else {
					$height = $width / $ratio;
				}

				$img = imagecreatetruecolor($width, $height);
				if ($tipo == 'image/jpeg') {
					$origi = imagecreatefromjpeg('app/assets/images/clientes/' . $nome_cliente . "/" . $pasta . '/' . $tmpname);
				} elseif ($tipo == 'image/png') {
					$origi = imagecreatefrompng('app/assets/images/clientes/' . $nome_cliente . "/" . $pasta . '/' . $tmpname);
				}

				imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

				$imgag = imagejpeg($img, 'app/assets/images/clientes/' . $nome_cliente . "/" . $pasta . '/' . $tmpname, 80);

				$sql = $this->db->prepare("
						INSERT INTO images SET 
						img_url = :img_photo,
						img_type = :type
					");
				$sql->bindValue(":type", $pasta);
				$sql->bindValue(":img_photo", $tmpname);
				$sql->execute();

				$id_image = $this->db->lastInsertId();

				$sql = $this->db->prepare("
						INSERT INTO client_image SET 
						id_client = :id_cliente,
						img_type = :img_type,
						id_image = :id_image,
						id_company = :id_company
					");
				$sql->bindValue(":img_type", $pasta);
				$sql->bindValue(":id_cliente", $id_cliente);
				$sql->bindValue(":id_image", $id_image);
				$sql->bindValue(":id_company", $id_company);

				$sql->execute();
			}
		} else {

			error_log(print_r('erro na foto', 1));
		}
	}

	public function addPermissions($id_cliente, $id_company)
	{

		$sql = $this->db->prepare("INSERT INTO permission_groups SET 
				
			params = 1,
			id_company = :id_company,
			id_cliente = :id_cliente
			
		");

		$sql->bindValue(":id_cliente", $id_cliente);
		$sql->bindValue(":id_company", $id_company);

		return $sql->execute();
	}

	public function editPermissions($plist, $id_company, $id_cliente)
	{

		$params = implode(',', $plist);
		$sql = $this->db->prepare("
			UPDATE `permission_groups` SET  
				params = :plist
			WHERE id_company = :id_company AND id_cliente = :id_cliente
		");

		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id_cliente", $id_cliente);
		$sql->bindValue(":plist", $params);
		if ($sql->execute())
			controller::alert('success', 'Editado com Sucesso');
	}

	public function getClienteByIdName($id_cliente, $id_company)
	{

		$array = array();
		$sql = $this->db->prepare("
			SELECT cli_nome, cli_sobrenome FROM client cli
			
			WHERE id_company = :id_company AND id_client = :id LIMIT 1
		");

		$sql->bindValue(':id', $id_cliente);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if ($sql->rowCount() == 1) {
			$array = $sql->fetch();
		}
		return $array;
	}
	public function getFotosByPasta($id_cliente, $pasta, $id_company)
	{

		$array = array();
		$sql = $this->db->prepare("
			SELECT * FROM client_image cliImg
				INNER JOIN images img ON (img.id_image = cliImg.id_image)
			WHERE cliImg.id_company = :id_company AND cliImg.id_client = :id_cliente AND cliImg.img_type = :pasta
		");

		$sql->bindValue(':id_cliente', $id_cliente);
		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':pasta', $pasta);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchALL();
		}

		return $array;
	}

	public function deleteFotoByCliente($id_cliente, $id_image, $nomecliente, $id_company)
	{
		$sql = $this->db->prepare("
			SELECT img_url,img_type  FROM images
			WHERE id_image = :id_image LIMIT 1
		");

		$sql->bindValue(':id_image', $id_image);
		$sql->execute();

		if ($sql->rowCount() == 1) {
			$nomeArquivo = $sql->fetch();

			if(!empty($id_cliente))
				$sql = $this->db->prepare("
					DELETE FROM images
					WHERE id_image = :id_image 
				");
				$sql->bindValue(':id_image', $id_image);
				$sql->execute();

				$sql = $this->db->prepare("
					DELETE FROM client_image
					WHERE id_image = :id_image AND id_client = :id_client AND id_company = :id_company 
				"); 
				$sql->bindValue(':id_client', $id_cliente);
				$sql->bindValue(':id_company', $id_company);
				$sql->bindValue(':id_image', $id_image);
				$sql->execute();

				$filename = 'app/assets/images/clientes/' . $nomecliente . '/' . $nomeArquivo['img_type'] . '/' . $nomeArquivo['img_url'] ;
				unlink($filename);
		}

		
	}

	public function getComentarioByEtapaById($id_etapa, $id_cliente, $id_company){


		if(!empty($id_cliente))
			try{
				
				$sql = $this->db->prepare("SELECT comentario FROM comentarios_etapa WHERE id_user = :id_user AND id_company = :id_company AND id_etapa = :id_etapa LIMIT 1");
				$sql->bindValue(":id_user", $id_cliente);
				$sql->bindValue(":id_company", $id_company);
				$sql->bindValue(":id_etapa", $id_etapa);
				$sql->execute();

				
				if($sql->rowCount() == 1){
					$this->retorno = $sql->fetch();
					
					return $this->retorno['comentario'];
				}
		

			} catch (PDOExecption $e) {

				controller::alert('warning', 'Não foi possivel, contate o administrador da empresa');
			}
			

	}
}
