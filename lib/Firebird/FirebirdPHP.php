<?php

namespace FirebdPHP\Firebird;

use FirebdPHP\Env\EnvFiles;
use PDOException;
use PDOStatement;
use PDO;

class FirebirdPHP
{
    private static $driver = "firebird";
    private static $host;
    private static $password;
    private static $user;
    protected static $databaseName;
    protected $connection;

    public function __construct()
    {
        $this->setConnection();
    }


    /**
     * Sets the path of the .fdb file
     */
    private function setFdbPath(string $path): void
    {
        $this->fdbPath = $path;
    }


    /**
     * Sets the credentials to connect to database
     */
    public static function config(string $host, string $password, string $user, string $name): void
    {
        self::$host = $host;
        self::$password = $password;
        self::$user = $user;
        self::$databaseName = $name;
    }


    /** 
     * Sets the database connection.
     */
    private function setConnection(): void
    {
        try {
            $config = self::$driver . ':dbname=' . self::$host . self::$databaseName . ';charset=utf8;dialect=3';
            $this->connection = new PDO($config, self::$user, self::$password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }


    /**
     * Return the database connection.
     */
    private function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * Get's version of the installed firebird
     */
    private static function getVersion()
    {
        $query = 'SELECT rdb$get_context(\'SYSTEM\', \'ENGINE_VERSION\') as version from rdb$database;';
        return self::execute($query);
    }

    /**
     * Execute a Sql Query
     */
    protected function execute(string $sqlQuery): ?PDOStatement
    {
        try {
            $statement = $this->getConnection()->prepare($sqlQuery);
            $statement->execute();
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getCode());
        }
    }


    /**
     * Execute a Sql Query with params
     */
    private function executeQuery(string $query, array $params = []): ?PDOStatement
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            switch ($e->getCode()) {
                case 23000:
                    throw new \Exception('Dados já existentes!');
                default:
                    die('ERROR: ' . $e->getMessage());
            }
        }
    }


    /**
     * Return a Create table query
     */
    protected static function getCreateTableSql(string $table, string $fields): string
    {
        $table = strtoupper($table);
        return "CREATE TABLE  ${table}(${fields})";
    }
}
