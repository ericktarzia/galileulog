<?php 


/**
 * 
 */
class View 
{

	private $view;
	public $var = array();


	/**
	 * Método construtor do site
	 * @param type|string $arg 
	 * @return this
	 */
	function __construct($arg = "")
	{
		$this->view = $arg;
	}
	

	/**
	 * Método para certificar que a view exists
	 * @param type string 
	 * @return 
	 */
	public function validar($arg)
	{
		if(!is_dir("html" . DIRECTORY_SEPARATOR . $arg)){

			throw new Exception("View não encontrada", 1);
			
			
		}
	}


	/**
	 * Método para carregar uma view
	 * @param type string 
	 * @param type|array array 
	 * @return require view
	 */
	public function load($arg, $vars = array())
	{

		$view = "html" . DIRECTORY_SEPARATOR . $arg . DIRECTORY_SEPARATOR . $arg . ".view.php";
		
		extract($vars);

		try {

			$this->validar($arg);


		} catch (Exception $e) {

			echo $e->getMessage();

		} finally  {

			require( $view );

		}

	}
}

?>