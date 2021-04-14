<?php

namespace Models;

use App\Model;
use PDO;

class UsersModel extends Model
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;

    public function __construct()
    {
        $this->table = 'users';
        $this->getConnection();
    }

    public function login($email, $password): array
    {
        $user = $this->getUserByEmail($email);

        if (!empty($user)) {
            $hash = $user['password'];
            if (password_verify($password, $hash)) {
                return $user;
            }
        }
        return [];

    }

    public function signup($data)
    {
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->password = $data['password'];

        $sql = 'INSERT INTO users (username,email,password) VALUES (?,?,?)';
        $query = $this->_connection->prepare($sql);
        return $query->execute([$this->username, $this->email, $this->password]);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $query = $this->_connection->prepare($sql);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
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
