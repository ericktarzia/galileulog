<?php 

/**
* 
*/
class Sql extends PDO
{

	private $conn;

	private $database 	= "ericktarzia";
	private $host 		= "ericktarzia.mysql.dbaas.com.br";
	private $user 		= "ericktarzia";
	private $pass 		= "senha123";


	/**
	 * Class Constructor
	 * @param    none   
	 */
	public function __construct()
	{
		$this->conn = new PDO("mysql:dbname={$this->database};host={$this->host}", $this->user, $this->pass);
	}


	/**
	 * colunas
	 * @param type $statement 
	 * @param type|array $params 
	 * @return type
	 */
	private function setParams($statement, $params = array())
	{

		foreach ($params as $key => $value) {
			
			$this->setParam($statement, $key, $value);
		}

	}

	
	/**
	 * valores
	 * @param type $statement 
	 * @param type $key 
	 * @param type $value 
	 * @return type
	 */
	private function setParam($statement,$key, $value)
	{

		$statement->bindParam($key, $value);

	}


	/**
	 * Faz uma query
	 * @param type $rawQuery 
	 * @param type|array $params 
	 * @return type
	 */
	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}



	/**
	 * select no db
	 * @param type $rawQuery 
	 * @param type|array $params 
	 * @return array
	 */
	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->query($rawQuery,$params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}

}

?>