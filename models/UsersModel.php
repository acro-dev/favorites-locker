<?php

class UsersModel extends Model
{
    // protected $id;
    // protected $username;
    // protected $email;
    // protected $password;

    public function __construct()
    {
        $this->table = 'users';
        $this->getConnection();
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE email='" . $email . "'";
        $query = $this->_connection->prepare($sql);
        $query->execute();
        $data = $query->fetch();

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
        $query->execute($this->username, $this->email, $this->password);
    }
}
