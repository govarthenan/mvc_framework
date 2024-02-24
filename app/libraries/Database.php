<?php

/**
 * Master Database class. COnfigures PDO and connects to the database.
 * Output is a PDO object if success, if not error is printed.
 * Database credentials are stored in config.php
 */
class Database
{
    private $db_host = DB_HOST;
    private $db_user = DB_USER;
    private $db_password = DB_PASSWORD;
    private $db_name = DB_NAME;

    private $statement;
    private $db_handler;
    private $db_error;

    public function __construct()
    {
        // set DSN
        $dsn = 'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name;

        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        );

        // create PDO instance
        try {
            $this->db_handler = new PDO($dsn, $this->db_user, $this->db_password, $options);
        } catch (PDOException $e) {
            $this->db_error = $e->getMessage();
            echo $this->db_error;
            die();  // ToDo: improve error handling
        }
    }

    /**
     * Prepare an SQL statement to be exectued
     *
     * @param string $sql The SQL statement
     */
    public function prepareQuery(string $sql)
    {
        $this->statement = $this->db_handler->prepare($sql);
    }


    /**
     * Binds a value to a parameter in the prepared statement.
     *
     * @param string $param The parameter to bind.
     * @param mixed $value The value to bind.
     * @param int|null $type The data type of the parameter (optional).
     *                      If not provided, the function will automatically determine the data type based on the value.
     *                      Possible values: PDO::PARAM_INT, PDO::PARAM_BOOL, PDO::PARAM_NULL, PDO::PARAM_STR.
     * @return void
     */
    public function bind(string $param, mixed $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($param, $value, $type);
    }

    /**
     * Executes the prepared statement.
     *
     * @return bool true on success, false on failure.
     */
    public function execute()
    {
        return $this->statement->execute();
    }

    /**
     * Fetches all the results from the database.
     *
     * @return array The array containing all the records in the result.
     */
    public function fetchAllResults()
    {
        return $this->statement->fetchAll();
    }

    /**
     * Fetches the next record from the result set.
     *
     * @return mixed The next record in the result set.
     */
    public function fetchNextRecord()
    {
        return $this->statement->fetch();
    }

    /**
     * Returns the number of rows affected by the last executed SQL statement.
     *
     * @return int The number of rows affected.
     */
    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}
