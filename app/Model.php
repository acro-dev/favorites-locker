<?php

namespace App;

use PDO;
use PDOException;

abstract class Model
{
    private string $host = "localhost";
    private string $dbname = "favlocker";
    private string $username = "favlocker";
    private string $password = "";

    protected PDO $_connection;

    protected string $table;

    public function getConnection(): void
    {
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

    public function getAll(): array
    {
        $sql = "SELECT * FROM " . $this->getTable();
        $query = $this->_connection->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id): array
    {
        $sql = "SELECT * FROM " . $this->getTable() . " WHERE id=" . $id;
        $query = $this->_connection->query($sql);

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function removeById($id): void
    {
        $sql = 'DELETE FROM ' . $this->getTable() . ' WHERE id=' . $id;
        $this->_connection->exec($sql);
    }

    /**
     * Getters and Setters
     */
    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table): self
    {
        $this->table = $table;

        return $this;
    }
}
