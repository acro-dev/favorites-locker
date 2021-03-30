<?php
abstract class Model
{
    private $host = "localhost";
    private $dbname = "favlocker";
    private $username = "favlocker";
    private $password = "";

    protected $_connection;

    public $table;
    public $id;

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
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->_connection->prepare($sql);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $id;
        $query = $this->_connection->prepare($sql);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function removeById($id)
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE id=' . $id;
        $this->_connection->exec($sql);
    }
}
