<?php

class UsersModel extends Model
{
    protected $id;
    protected $username;
    protected $email;
    protected $password;

    public function __construct()
    {
        $this->table = 'users';
        $this->getConnection();
    }

    public function login($email, $password)
    {
        $data = $this->checkEmail($email);

        if (!empty($data)) {
            $hash = $data['password'];
            if (password_verify($password, $hash)) {
                return $data;
            }
        } else {
            return false;
        }
    }

    public function signup($data)
    {
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->password = $data['password'];

        $sql = 'INSERT INTO ' . $this->table . ' (username,email,password) VALUES (?,?,?)';
        $query = $this->_connection->prepare($sql);
        $createUser = $query->execute([$this->username, $this->email, $this->password]);

        return $createUser;
    }

    public function checkEmail($email)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE email="' . $email . '"';
        $query = $this->_connection->prepare($sql);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function updateUser($property, $newValue, $id)
    {
        $sql = 'UPDATE ' . $this->table . ' SET ' . $property . '="' . $newValue . '" WHERE id=' . $id;
        $query = $this->_connection->prepare($sql);
        $query->execute();
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
