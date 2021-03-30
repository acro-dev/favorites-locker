<?php

class FavoritesModel extends Model
{
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

    public function addFavorite($name, $url)
    {
        $sql = 'INSERT INTO favorites (name,url,user_id) VALUES (?,?,?)';
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$name, $url, $_SESSION['userID']]);
    }

    public function editFavorite($data)
    {
        $sql = 'UPDATE ' . $this->table . ' SET name="' . $data['name'] . '", url="' . $data['url'] . '" WHERE id=' . $data['id'];
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute();
    }
}
