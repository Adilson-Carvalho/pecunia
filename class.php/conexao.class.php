 <?php

class Conexao extends PDO
{

    private $conn;

    private $host = 'localhost';

    private $dbname = 'bd_registros';

    private  $user = 'root';

    private  $pass = '';

    public function __construct()
    {
        try {

            $this->conn = new PDO("mysql:host=$this->host; dbname=$this->dbname", "$this->user", "$this->pass");
        } catch (PDOexception $e) {

            echo '<p>' . $e->getMenssege() . '</p>';
        }
    }

    public function conectar()
    {
        return $this->conn;
    }
}

?>