<?php
namespace Config;

use PDO;
use PDOException;

class Database {
    private static $envLoaded = false;
    private static $currentDriver = 'mysql';

    public $conn;

    public function __construct() {
        self::loadEnv();
    }

    /**
     * Carga variables de entorno desde el archivo .env en la raíz del proyecto
     */
    private static function loadEnv() {
        if (self::$envLoaded) {
            return;
        }

        $envPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
        if (file_exists($envPath)) {
            $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line) || strpos($line, '#') === 0) {
                    continue;
                }
                if (strpos($line, '=') !== false) {
                    list($key, $value) = explode('=', $line, 2);
                    $key = trim($key);
                    $value = trim($value);
                    // Quitar comillas si las tiene
                    $value = trim($value, "\"'");
                    $_ENV[$key] = $value;
                    putenv("$key=$value");
                }
            }
        }

        self::$envLoaded = true;
    }

    /**
     * Retorna el driver actual ('mysql' o 'pgsql')
     */
    public static function getDriver() {
        self::loadEnv();
        return strtolower(getenv('DB_CONNECTION') ?: ($_ENV['DB_CONNECTION'] ?? 'mysql'));
    }

    public function getConnection() {
        $this->conn = null;
        $driver = self::getDriver();
        self::$currentDriver = $driver;

        try {
            if ($driver === 'pgsql') {
                $host = getenv('PGSQL_HOST') ?: ($_ENV['PGSQL_HOST'] ?? 'localhost');
                $port = getenv('PGSQL_PORT') ?: ($_ENV['PGSQL_PORT'] ?? '5432');
                $db_name = getenv('PGSQL_DATABASE') ?: ($_ENV['PGSQL_DATABASE'] ?? 'taller_db');
                $username = getenv('PGSQL_USERNAME') ?: ($_ENV['PGSQL_USERNAME'] ?? 'postgres');
                $password = getenv('PGSQL_PASSWORD') !== false ? getenv('PGSQL_PASSWORD') : ($_ENV['PGSQL_PASSWORD'] ?? '');
                $sslmode = getenv('PGSQL_SSLMODE') ?: ($_ENV['PGSQL_SSLMODE'] ?? null);

                $dsn = "pgsql:host={$host};port={$port};dbname={$db_name}";
                if ($sslmode) {
                    $dsn .= ";sslmode={$sslmode}";
                }
                
                // Neon SNI workaround para versiones de libpq antiguas en Windows (XAMPP/PHP 8.0)
                if (strpos($host, 'neon.tech') !== false) {
                    $endpointId = explode('.', $host)[0];
                    $dsn .= ";options='endpoint={$endpointId}'";
                }

                $this->conn = new PDO($dsn, $username, $password);
            } else {
                // Por defecto: MySQL
                $host = getenv('MYSQL_HOST') ?: ($_ENV['MYSQL_HOST'] ?? 'localhost');
                $port = getenv('MYSQL_PORT') ?: ($_ENV['MYSQL_PORT'] ?? '3306');
                $db_name = getenv('MYSQL_DATABASE') ?: ($_ENV['MYSQL_DATABASE'] ?? 'taller_db');
                $username = getenv('MYSQL_USERNAME') ?: ($_ENV['MYSQL_USERNAME'] ?? 'root');
                $password = getenv('MYSQL_PASSWORD') !== false ? getenv('MYSQL_PASSWORD') : ($_ENV['MYSQL_PASSWORD'] ?? '');

                $dsn = "mysql:host={$host};port={$port};dbname={$db_name};charset=utf8mb4";
                $this->conn = new PDO($dsn, $username, $password);
                $this->conn->exec("SET NAMES utf8mb4");
            }

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de conexión ({$driver}): " . $exception->getMessage();
        }

        return $this->conn;
    }
}
