<?php
abstract class Model
{
    private $host = "localhost";
    private $dbname = "favlocker";
    private $username = "favlocker";
    private $password = "";

    protected $_connection;

    private $table;

    public function getConnection()
    {
        $this->_connection = null;
        try {
            $this->_connection = new PDO(
                'mysql:host=' . $this->host . '; dbname=' . $this->dbname,
                $this->username,
                $this->password
            );
            $this->_connection->exec('set names utf8');
        } catch (PDOException $exception) {
            echo 'Erreur :' . $exception->getMessage();
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->getTable();
        $query = $this->_connection->prepare($sql);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOne($id)
    {
        $sql = "SELECT * FROM " . $this->getTable() . " WHERE id=" . $id;
        $query = $this->_connection->exec($sql);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function removeById($id)
    {
        $sql = 'DELETE FROM ' . $this->getTable() . ' WHERE id=' . $id;
        $this->_connection->exec($sql);
    }

    /**
     * Get the value of table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set the value of table
     *
     * @return  self
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }
}
