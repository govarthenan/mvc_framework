<?php

/**
 * Specialized version (ideally) of the Database class for the Post model.
 *
 * @property mixed $db An instance of the Database class.
 */
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Demo method to read all records from a table
     */
    public function getEmployees()
    {
        $sql = 'SELECT * FROM employees';
        $this->db->prepareQuery($sql);

        $queryExecutionStatus = $this->db->execute();

        return $this->db->fetchAllResults();
    }
}
