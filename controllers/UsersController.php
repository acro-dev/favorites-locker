<?php
class UsersController extends Controller
{
    public function __construct()
    {
        $this->loadmodel('UsersModel');
    }
    public function login()
    {
        $data = [
            'title' => 'Login page',
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => ''
            ];

            if (empty($data['email'])) {
                $data['emailError'] = "Email vide";
            }
            if (empty($data['password'])) {
                $data['passwordError'] = "Password vide.";
            }

            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->UsersModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $this->createSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Email or password was wrong';
                }
            }
        }

        $this->render('login', $data);
    }

    public function createSession($user)
    {
        $_SESSION['userID'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = ucfirst($user['username']);

        header('Location: /');
        exit();
    }

    public function logout()
    {
        unset($_SESSION);
        session_start();
        session_unset();
        session_destroy();

        header('Location: /');
        exit();
    }
}
