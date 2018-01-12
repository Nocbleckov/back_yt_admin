<?php 

/**
* 
*/

class Usuario
{
	
	const SESION_INICIADA = true;
	const SESION_NO_INICIADA = false;


	//Estado incial de la sesión del Usuario
	private $sessionState = self::SESION_NO_INICIADA;

	//Solo se podra Generar una instacia de Usuario
	private static $instance;

	function __construct(){
	}

	public static function getInstance(){
		if (!isset(self::$instance)) {
			self::$instance = new self;
		}
		self::$instance->startSession();
		return self::$instance;
	}

	/**
	*
	* Inicia o Reinicia la session del Usuario
	*
	* @return 	bool 	TRUE si la sesion ya se ha inicializado, si no FALSE
	*
	**/
	public function startSession(){
		if( $this->sessionState == self::SESION_NO_INICIADA){
			$this->sessionState = session_start();
		}
		return $this->sessionState;
	}

	/**
	* Guarda información en la sesion del Usuario
	* 	EJEMPLO: $instace->foo = 'bar';
	*	
	*	@param 		name 		Nombre de la info
	*	@param 		value 		La información
	*	@return 	void
	*
	**/

	public function __set( $name, $value){
		$_SESSION[$name] = $value;
	}

	/**
	*
	* Obtiene info de la Sesion del Usuario
	* EJEMPLO: echo $instace->foo;
	*
	* @param 	name 	Nombre de la info a obtener
	* @param 	mixed 	La info guardad en la Sesion
	*
	**/

	public function __get( $name){
		if ( isset($_SESSION[$name])){
			return $_SESSION[$name];
		}
	}

	public function __isset( $name){
		return isset($_SESSION[$name]);
	}

	public function __unset( $name){
		unset( $_SESSION[$name]);
	}


	/**
	*
	* Destruye al Usuario actual y la Sesion.
	*	
	*	
	*	@return 	bool 	TRUE si la sesion se ha cerrado , si no FALSE
	*
	**/

	public function destroy(){
		if( $this->sessionState == self::SESION_INICIADA){
			$this->sessionState = !session_destroy();
			unset( $_SESSION);
			return !$this->sessionState;
		}
		return FALSE;
	}


}


?>