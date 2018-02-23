<?php 

use Rain\Tpl;
/**
* 
*/
class Site 
{

	private $siteName;
	
	public function __construct($siteName)
	{

		$view = new View;

		$usuario = new Usuario;
		$usuario->loadById(1);


		$vars = array(
			'siteName' 	=> $this->getSiteName(),
			'usuario' 	=> $usuario
			);

		$tpl = new Tpl;
		$config = array(
			"tpl_dir"       => "tpl/Bell",
			"cache_dir"     => "cache/",
			);

		Tpl::configure( $config );

		$tpl->draw( "header" );
		$tpl->draw( "index" );
		$view->load("sobre" , $vars);
		$view->load("portfolio");
		$view->load("contato");
		$tpl->draw( "footer" );
	}


    /**
     * @return mixed
     */
    public function getSiteName()
    {
        return $this->siteName;
    }


    /**
     * @param mixed $siteName
     *
     * @return self
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }
}

?>