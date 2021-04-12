<?php

namespace Models;

use App\Model;
use PDO;

class FavoritesModel extends Model
{
    private $id;
    private $name;
    private $url;
    private $icon;
    private $fav;
    private $creation_date;
    private $user_id;
    private $category_id;

    public function __construct()
    {
        $this->setTable("favorites");
        $this->getConnection();
    }
    public function findAllByUserId($order = 'name')
    {
        $sql = "SELECT favorites.*,categories.name as category FROM favorites
            LEFT JOIN categories ON favorites.category_id = categories.id
            WHERE user_id=" . $_SESSION['userID'] . "
            ORDER BY " . $order;

        $query = $this->_connection->prepare($sql);
        $query->execute();

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
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of icon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the value of icon
     *
     * @return  self
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get the value of fav
     */
    public function getFav()
    {
        return $this->fav;
    }

    /**
     * Set the value of fav
     *
     * @return  self
     */
    public function setFav($fav)
    {
        $this->fav = $fav;

        return $this;
    }

    /**
     * Get the value of creation_date
     */
    public function getCreation_date()
    {
        return $this->creation_date;
    }

    /**
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
