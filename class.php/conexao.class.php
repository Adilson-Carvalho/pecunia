 <?php
	class Conexao extends PDO{
		public $conn;
		public $host = 'localhost';
		public $dbname = 'bd_registros';
		public $user = 'root';
		public $pass = '';

			public function __construct(){

				try{

				$this->conn = new PDO( "mysql:host=$this->host; dbname=$this->dbname", "$this->user", "$this->pass");
			
				}catch(PDOexception $e){

					 echo '<p>'. $e->getMenssege(). '</p>';
			}
				
			}

			public function conectar(){
				return $this->conn;
			}

	}
			

?>