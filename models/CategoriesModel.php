<?php

class CategoriesModel extends Model
{
    public $id;
    private $name;

    public function __construct()
    {
        $this->table = "categories";
        $this->getConnection();
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

    public function findCategory($category)
    {
        $sql = "SELECT * FROM categories WHERE name = '" . $category . "'";
        $query = $this->_connection->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
