<?php

namespace Models;

use App\Model;
use PDO;

class FavoritesModel extends Model
{
    private int $id;
    private string $name;
    private string $url;
    private string $icon;
    private bool $fav;
    private \DateTime $creation_date;
    private int $user_id;
    private int $category_id;

    public function __construct()
    {
        $this->setTable("favorites");
        $this->getConnection();
    }

    public function getAllByUserId(int $id,string $order = 'name'): array
    {
        $sql = "SELECT favorites.*,categories.name as category FROM favorites
            LEFT JOIN categories ON favorites.category_id = categories.id
            WHERE user_id=" . $id."
            ORDER BY " . $order;

        $query = $this->_connection->query($sql);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOneById($id)
    {
        $sql = "SELECT favorites.*,categories.name as category FROM favorites
            LEFT JOIN categories ON favorites.category_id = categories.id
            WHERE favorites.id=" . $id;

        $query = $this->_connection->prepare($sql);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addFavorite()
    {
        $sql = 'INSERT INTO favorites (name,url,user_id) VALUES (?,?,?)';
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$this->getName(), $this->getUrl(), $_SESSION['userID']]);
    }

    public function editFavorite()
    {
        $sql = 'UPDATE ' . $this->table . ' SET name="' . $this->name . '", url="' . $this->url . '", category_id="' . $this->category_id . '" WHERE id=' . $this->id;
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute();
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

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getFav(): bool
    {
        return $this->fav;
    }

    public function setFav(bool $fav): self
    {
        $this->fav = $fav;

        return $this;
    }

    public function getCreation_date(): \DateTime
    {
        return $this->creation_date;
    }

    public function getUser_id(): int
    {
        return $this->user_id;
    }

    public function setUser_id(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCategory_id(): int
    {
        return $this->category_id;
    }

    public function setCategory_id(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }
}
