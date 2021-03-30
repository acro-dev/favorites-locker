<?php

class UsersController extends Controller
{
    public function __construct()
    {
        $this->loadmodel('UsersModel');
    }

    public function signup()
    {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => ''
            ];

            /**
             * Username can be not unique but must be not empty
             */
            if (empty($data['username'])) {
                $data['usernameError'] = "Votre nom d'utilisateur doit être renseigné.";
            }
            /**
             * Email must match pattern. And must be unique.
             */
            if (empty($data['email'])) {
                $data['emailError'] = "L'adresse email doit être renseigné.";
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = "Adresse email non valide.";
            } else if ($this->UsersModel->checkEmail($data['email']) !== false) {
                $data['emailError'] = "Cette adresse mail est déjà utilisée.";
            }

            /**
             * Password must be at least 6 characters long and match confirmPassword.
             */

            if (empty($data['password'])) {
                $data['passwordError'] = "Password vide.";
            } else if (strlen($data['password']) < 6) {
                $data['passwordError'] = "Votre mot de passe doit contenir au moins 6 caractères.";
            } else if ($data['password'] != $data['confirmPassword']) {
                $data['passwordError'] = "Vos mots de passe ne correspondents pas.";
            } else {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }

            /**
             * If no error : Create user in database.
             */
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError'])) {
                $createUser = $this->UsersModel->signup($data);

                if ($createUser) {
                    header('Location: /users/login');
                } else {
                    echo "Une érreur s'est produite lors de l'inscription. Veuillez reéssayer s'il vous plait.";
                }
            }
        }

        $this->render('signup', $data);
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

                    header('Location: /');
                    exit();
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
    }

    public function logout()
    {
        session_start();
        unset($_SESSION);
        session_unset();
        session_destroy();

        header('Location: /');
        exit();
    }

    public function editEmail($id)
    {
        $data = $this->UsersModel->getOne($id);
        $this->render('editProfile', $data);
    }

    public function editProfile($property)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $newValue = $_POST[$property];
            $id = $_POST['id'];
            $this->UsersModel->updateUser($property, $newValue, $id);
            $user = $this->UsersModel->getOne($id);
            $this->createSession($user);


            header('Location: /dashboard/profile/' . $id);
        } else {
            $data = $this->UsersModel->getOne($_SESSION['userID']);
            $data['property'] = $property;

            $this->render('editProfile', $data);
        }
    }
}
