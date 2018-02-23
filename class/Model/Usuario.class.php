<?php 

/**
* 
*/
class Usuario 
{
	
	private $id_usuario;
	private $email;
	private $senha;
	private $dt_cadastro;
	private $nome;
	private $foto;


	/**
	 * Class Constructor
	 * @param    $id_usuario   
	 * @param    $email   
	 * @param    $senha   
	 * @param    $dt_cadastro   
	 */
	public function __construct( $email = "", $senha = "")
	{
		
		$this->email = $email;
		$this->senha = $senha;
		$this->dt_cadastro = $dt_cadastro;
	}



	public function getIdUsuario()
	{
		return $this->id_usuario;
	}


	public function setIdUsuario($id_usuario)
	{
		$this->id_usuario = $id_usuario;

		return $this;
	}


	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;

		return $this;
	}


	public function getSenha()
	{
		return $this->senha;
	}


	public function setSenha($senha){
		$this->senha = $senha;

		return $this;
	}


	public function getDtCadastro()
	{
		return $this->dt_cadastro;
	}


	public function setDtCadastro($dt_cadastro){
		$this->dt_cadastro = $dt_cadastro;

		return $this;
	}


    public function getNome()
    {
    	return $this->nome;
    }

 
    public function setNome($nome)
    {
    	$this->nome = $nome;

    	return $this;
    }

 
    public function getFoto()
    {
    	return $this->foto;
    }


    public function setFoto($foto)
    {
    	$this->foto = $foto;

    	return $this;
    }



    /**
     * Carrega um usuario através do id
     * @param int $id 
     * @return Usuario
     */
	public function loadById($id){
		$sql = new Sql;
		$result = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :ID", array(
			":ID" => $id
			));

		if(count($result) > 0){

			$this->setData($result[0]);
		}
	}


	/**
	 * Retorna a lista de usuarios no bando
	 * @return array
	 */
	public static function getList(){

		$sql = new Sql;
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY id_usuario");
	}


	/**
	 * busca pelo email
	 * @param type $email 
	 * @return type
	 */
	public static function search($email){

		$sql = new Sql;
		return $sql->select("SELECT * FROM tb_usuarios WHERE email LIKE :SEARCH ORDER BY id_usuario", array(
			":SEARCH" => "%" . $email . "%"
			));
	}


	/**
	 * Salvar no banco, executar uma procedure e retornar o último id
	 * @return type
	 */
	public function save(){

		$sql = new Sql;

		//PROCEDURE que retorna o id do usuario após o insert
		$result = $sql->select("CALL sp_usuario_insert(:EMAIL, :SENHA)", array(
			':EMAIL' => $this->getEmail(),
			':SENHA' => $this->getSenha()
			));

		if(count($result) > 0){
			$this->setData($result[0]);
		}
	}

	/**
	 * Update
	 * @param type $email 
	 * @param type $senha 
	 * @return type
	 */
	public function update($email, $senha){


		$this->setEmail($email);
		$this->setSenha($senha);

		$sql = new Sql;
		$sql->query("UPDATE tb_usuarios SET email = :EMAIL, senha = :SENHA WHERE id_usuario = :ID", array(
			':EMAIL' 	=> $this->getEmail(),
			':SENHA' 	=> $this->getSenha(),
			':ID'		=> $this->getIdUsuario()
			));
	}


	/**
	 * Delete
	 * @return type
	 */
	public function delete(){

		$sql = new Sql;
		$sql->query("DELETE FROM tb_usuarios WHERE id_usuario = :ID", array(
			':ID' => $this->getIdUsuario()
			));

		$this->setIdUsuario(0);
		$this->setEmail("");
		$this->setSenha("");
		$this->setDtCadastro(new DateTime());

	}


	/**
	 * Set Data
	 * @param type $data 
	 * @return type
	 */
	public function setData($data){

		$this->setIdUsuario($data['id_usuario']);
		$this->setEmail($data['email']);
		$this->setSenha($data['senha']);
		$this->setDtCadastro(new DateTime($data['dt_cadastro']));
		$this->setNome($data['nome']);
		$this->setFoto($data['foto']);

	}


	/**
	 * Exibe o usuario no formato JSON com um "echo"
	 * @return JSON
	 */
	public function __toString(){
		return json_encode(
			array(
				'id_usuario' 	=> $this->getIdUsuario(),
				'email' 		=> $this->getEmail(),
				'senha' 		=> $this->getSenha(),
				'dt_cadastro' 	=> $this->getDtCadastro()->format("d/m/Y H:i:s"),
				'nome'			=> $this->getNome(),
				'foto'			=> $this->getFoto()
				)
			);
	}


}

?>