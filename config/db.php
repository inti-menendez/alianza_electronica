
<?php 

class db {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'alianza_electronica';
    private $charset = 'utf8mb4';
    private $port = 3306;
    private $dsn;

    public function __construct()
    {
        $this->dsn = "mysql:host={$this->host};
        dbname={$this->database};
        charset={$this->charset};
        port={$this->port}";

    }

    public function connect()
    {
        try {
            $pdo = new PDO($this->dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
        catch (PDOException $error){
            echo "conexion fallida: " . $error->getMessage();
        }
    }
}    


