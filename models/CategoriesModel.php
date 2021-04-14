<?php

namespace Models;

use App\Model;
use PDO;

class CategoriesModel extends Model
{
    public int $id;
    private string $name;

    public function __construct()
    {
        $this->table = "categories";
        $this->getConnection();
    }

    /**
     * Getters and Setters
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function findCategory(string $category): array
    {
        $sql = "SELECT * FROM categories WHERE name = '" . $category . "'";
        $query = $this->_connection->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
