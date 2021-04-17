<?php

namespace Models;

use App\Model;
use PDO;
use PDOException;

class CategoriesModel extends Model
{
    public int $id;
    private string $name;
    private string $slug;

    public function __construct()
    {
        $this->table = "categories";
        $this->getConnection();
    }

    public function getCategoryBySlug(string $slug)
    {
        $sql = "SELECT * FROM categories WHERE slug = '" . $slug . "'";
        $query = $this->_connection->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getCategoryByName(string $name)
    {
        $sql = "SELECT * FROM categories WHERE name = '" . $name . "'";
        $query = $this->_connection->query($sql);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addCategory()
    {
        $sql = 'INSERT INTO ' . $this->table . ' (name, slug) VALUES (?,?)';
        $query = $this->_connection->prepare($sql);
        $query->bindValue(1,$this->name);
        $query->bindValue(2, $this->slug);
        $query->execute();
    }

    public function sortCategory(array $categories): array
    {
        foreach ($categories as $category) {
            if ($category['name'] !== null &&
                !in_array($category, $categories, true)) {
                $categories[] = $category;
            }
        }
        sort($categories);
        return $categories;
    }

    /**
     * Getters and Setters
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

}
