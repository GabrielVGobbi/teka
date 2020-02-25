<?php
class Permissions extends model {

	private $group;
	private $permissions;

	public function setGroup($id, $id_company, $cliente = false){
		
		$this->group = $id;
		$this->permissions = array();

		$type = $cliente == false ? '`id_usuario`' : '`id_cliente`';

		$sql = $this->db->prepare("SELECT * FROM permission_groups WHERE {$type} = :id AND id_company = :id_company LIMIT 1");
		$sql->bindValue(':id', $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();
		#error_log(print_r($sql->rowCount(),1));

		if ($sql->rowCount() == 1 ) {
			$row = $sql->fetch();

			if (empty($row['params'])) {
				$row['params'] = '0';
			}

			$params = $row['params'];

			$sql = $this->db->prepare("SELECT name FROM permission_params pm WHERE id IN($params) AND id_company = :id_company ORDER BY pm.order DESC");
			$sql->bindValue(':id_company', $id_company);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				foreach ($sql->fetchAll() as $item) {
					$this->permissions[] = $item['name'];
				}	
			}
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

	public function returnPermission(){
		return $this->permissions;
	}

	public function hasPermission($name){

		
		if (in_array($name, $this->permissions)) {
			return true;
		} else {
			return false;
		}
	}

	public function getlist($id_company){

		$array = array();
		$sql = $this->db->prepare("SELECT *, upper(name) as name FROM permission_params WHERE id_company = 1");

		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();

		} else {

			$error = "não localizado";
		}

		return $array;

	}

	public function getlistCliente($id_company){

		$array = array();
		$sql = $this->db->prepare("SELECT id, upper(name) as name FROM permission_params pm WHERE pm.id_company = :id_company AND  pm.type = 1");

		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();

		} else {

			$error = "não localizado";
		}

		return $array;

	}

	public function getGroupList($id_company){

		$array = array();
		$sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id_company = :id_company");

		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();

		} else {

			$error = "não localizado";
		}

		return $array;	
	}

	public function add($name, $id_company){

		$sql = $this->db->prepare("INSERT INTO permission_params SET name = :name, id_company = :id_company");
		$sql->bindValue(":name", $name);
		$sql->bindValue(":id_company", $id_company);
		
		$sql->execute();

	}

	public function addGroup($name, $plist, $id_company){

		$params = implode(',', $plist);
		$sql = $this->db->prepare("INSERT INTO permission_groups SET name = :name, id_company = :id_company, params = :params");
		$sql->bindValue(":name", $name);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":params", $params);
		
		$sql->execute();

	}

	

	public function delete($id) {

		$sql = $this->db->prepare("DELETE FROM permission_params WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

	}

	public function deleteGroup($id) {

		$u = new Users();

		if($u->findUsersInGroup($id) == false){
			$sql = $this->db->prepare("DELETE FROM permission_groups WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->execute();
		} 

	}


	public function getGroup($id, $id_company){

		$array = array();
		$sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['params'] = explode(',',$array['params']);

		} else {

			$error = "não localizado";
		}

		return $array;


	}

	public function editGroup($name,  $plist, $id, $id_company){

		$params = implode(',', $plist);
		$sql = $this->db->prepare("UPDATE permission_groups SET name = :name, id_company = :id_company, params = :params WHERE id = :id");
		$sql->bindValue(":name", $name);
		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":params", $params);
		
		$sql->execute();

	}










}