<?php

class FavoritesModel extends Model
{
    public $id;
    public $name;
    public $url;
    public $catergory;

    public function __construct()
    {
        $this->table = "favorites";
        $this->getConnection();
    }
    public function findAllByUserId()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE user_id=" . $_SESSION['userID'];
        $query = $this->_connection->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFavorite()
    {
        $sql = 'INSERT INTO favorites (name,url,user_id) VALUES (?,?,?)';
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$this->name, $this->url, $_SESSION['userID']]);
    }

    public function editFavorite()
    {
        $sql = 'UPDATE ' . $this->table . ' SET name="' . $this->name . '", url="' . $this->url . '" WHERE id=' . $this->id;
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute();
    }
}
