<?php

class FavoritesModel extends Model
{
    public function __construct()
    {
        $this->table = "favorites";
        $this->getConnection();
    }
    public function findByUserId()
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE user_id=" . $_SESSION['userID'];
        $query = $this->_connection->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function addFavorite($url)
    {
        $sql = 'INSERT INTO favorites (url,user_id) VALUES (?,?)';
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$url, $_SESSION['userID']]);
    }

    public function editFavorite($data)
    {
        $sql = 'UPDATE ' . $this->table . ' SET name="' . $data['name'] . '", url="' . $data['url'] . '" WHERE id=' . $data['id'];
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute();
    }
}
