<?php
class Users extends model 

{

	private $userInfo;
	private $permissions;

	//Verifica se o usuario esta Logado
	public function isLogged() { 

		if(isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
			return true;//se a session esta aberta e não esta vazia retorna true
			
		} else {

			return false; //se a session esta aberta e não esta vazia retornao false
		}

	}

	//Verifica os dados do POST corretamente
	public function doLogin($login, $password){


		$sql = $this->db->prepare("SELECT * FROM users WHERE login = :login AND password = :password");
		$sql->bindValue(':login', $login);
		$sql->bindValue(':password', md5($password));
		$sql->execute();

		if($sql->rowCount() > 0){
			$row = $sql->fetch();

			$_SESSION['ccUser'] = $row['id'];

			return $row;
		} else {
			return false;
		}

	}

	//Ver se o usuario esta logado e tem permissao
	public function setLoggedUser(){


		if(isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {

			$id = $_SESSION['ccUser'];
			$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
			$sql->bindValue(':id', $id);
			$sql->execute();

			if($sql->rowCount() > 0 ){
				$this->permissions = new Permissions();
				$this->userInfo = $sql->fetch();
				$id_group = $this->userInfo['id'];
				$this->permissions->setGroup($id_group, $this->userInfo['id_company']);
			}

		}else {
			return false;
		}

	}

	//Logout do usuario
	public function logout(){

		session_destroy();

	}

	public function hasPermission($name){

		return $this->permissions->hasPermission($name);
	}

	public function getCompany(){
		if(isset($this->userInfo['id_company'])){

			return $this->userInfo['id_company'];
		} else 
		return 0;
	}

	public function isClient(){
		if(isset($this->userInfo['id_cliente'])){
			return true;
		} else 
		return 0;
	}
	

	public function getGroup(){
		if(isset($this->userInfo['id_group'])){

			return $this->userInfo['id_group'];
		} else 
		return 0;
	}

	public function getId(){
		if(isset($this->userInfo['id'])){

			return $this->userInfo['id'];
		} else 
		return 0;
	}

	public function getEmail(){
		if(isset($this->userInfo['email'])){

			return $this->userInfo['email'];
		} else 
		return '';

	}

	public function getName(){
		if(isset($this->userInfo['name'])){

			return $this->userInfo['name'];
		} else 
		return '';

	}

	public function getCliente(){
		
		if(isset($this->userInfo['id_cliente']) && $this->userInfo['id_cliente'] != 0 ){
			return true;
		} else 
		return false;

	}

	public function getClienteId(){
		
		if(isset($this->userInfo['id_cliente']) && $this->userInfo['id_cliente'] != 0 ){
			return ($this->userInfo['id_cliente']);
		} else 
		return false;
	}

	public function getPhoto(){
		
		if(isset($this->userInfo['user_photo_url']) && $this->userInfo['user_photo_url'] != '' ){
			return $this->userInfo['user_photo_url'];
		} else 
		return '';

	}

	public function getInfo($id, $id_company){

		$array = array();

		$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(':id', $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();
		

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;

	}


	public function findUsersInGroup($id){

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE id_group = :group");
		$sql->bindValue(':group', $id);
		$sql->execute();
		$row = $sql->fetch();

		if($row['c'] == '0'){
			return false;
		} else {
			return true;
		}

	}

	public function getList(){
		
		$sql = $this->db->prepare("SELECT * FROM users");


		$sql->execute();
		
		if($sql->rowCount() > 0){
			$array = $sql->fetchALL();
		} 


		return $array;

	}

	public function add($login,$email,$pass,$group,$id_company){


		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE email = :email");
		$sql->bindValue(':email', $email);
		$sql->execute();
		$row = $sql->fetch();

		if($row['c'] == '0') {

			$sql = $this->db->prepare("INSERT INTO users SET email = :email, password = :password, id_group = :id_group, id_company = :id_company");
			$sql->bindValue(':email', $email);
			$sql->bindValue(':password', md5($pass));
			$sql->bindValue(':id_group', $group);
			$sql->bindValue(':id_company', $id_company);
			$sql->execute();
			
			return '1';

		} else {

			return '0';

		}

	}

	public function edit($id,$pass,$id_group,$id_company){

		$sql = $this->db->prepare("UPDATE users SET id_group = :id_group WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id_group", $id_group);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id", $id);
		
		$sql->execute();

		if(!empty($pass)) {
			$sql = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id AND id_company = :id_company");
			$sql->bindValue(":password", md5($pass));
			$sql->bindValue(":id_company", $id_company);
			$sql->bindValue(":id", $id);
			$sql->execute();

		}

	}

	public function delete($id, $id_company) {
		
		$sql = $this->db->prepare("DELETE FROM users WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();
	}

	public function getDashboardUsuario($id_usuario,$id_company){
		$array = array();
		$sql = $this->db->prepare("

			SELECT * FROM user_dashboard uds

			INNER JOIN dashboard dash on uds.dashboard_id = dash.dashboard_id
			INNER JOIN users usr on uds.user_id = usr.id

			WHERE usr.id = :id_usuario AND usr.id_company = :id_company
			");

		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':id_usuario', $id_usuario);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function hasPermissionByidSearch($name, $id_user, $id_company, $id_cliente)
	{

		$tipoUsuario = !empty($id_user) ? 'id_usuario' : 'id_cliente';
		$tipoBind 	 = !empty($id_user) ? $id_user : $id_cliente;

		
		$sql = $this->db->prepare("SELECT * FROM permission_groups WHERE {$tipoUsuario} = :id AND id_company = :id_company");
		$sql->bindValue(':id', $tipoBind);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if ($sql->rowCount() == 1) {
			$row = $sql->fetch();

			if (empty($row['params'])) {
				$row['params'] = '0';
			}

			$params = $row['params'];

			$sql = $this->db->prepare("SELECT upper(name) as name FROM permission_params WHERE id IN($params) AND id_company = :id_company");
			$sql->bindValue(':id_company', $id_company);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				foreach ($sql->fetchAll() as $item) {
					$this->permissionById[] = $item['name'];
				}
			}
		}

		return in_array($name, $this->permissionById) ? true : false;
		
	}

	public function saveComentyExercicioImagem($Parametros, $id_usuario, $id_company)
	{

		$id_etapa 	= $Parametros['id_etapa'];
		$comentario = ltrim($Parametros['text']);

		$sql = $this->db->prepare("SELECT comentario FROM comentarios_etapa WHERE id_user = :id_user AND id_company = :id_company AND id_etapa = :id_etapa LIMIT 1");
		$sql->bindValue(":id_user", $id_usuario);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id_etapa", $id_etapa);
		$sql->execute();

		if ($sql->rowCount() == 1) {
			$sql = $this->db->prepare("UPDATE comentarios_etapa SET comentario = :comentario WHERE id_user = :id_user AND id_company = :id_company AND id_etapa = :id_etapa");
			$sql->bindValue(":id_user", $id_usuario);
			$sql->bindValue(":id_company", $id_company);
			$sql->bindValue(":comentario", $comentario);
			$sql->bindValue(":id_etapa", $id_etapa);

			return $sql->execute() ? true : false;

		} else {

			$sql = $this->db->prepare("INSERT INTO comentarios_etapa SET 
					comentario = :comentario, 
					id_user = :id_user,
					id_company = :id_company,
					id_etapa = :id_etapa			
				");

			$sql->bindValue(":id_user", $id_usuario);
			$sql->bindValue(":id_company", $id_company);
			$sql->bindValue(":comentario", $comentario);
			$sql->bindValue(":id_etapa", $id_etapa);

			return $sql->execute() ? true : false;
		}
	}


}
