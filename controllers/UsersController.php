<?php

namespace Controllers;

use App\Controller;

class UsersController extends Controller
{
    private object $user;

    public function __construct()
    {
        $this->user = $this->loadModel('UsersModel');
    }

    public function verifyUsername($username): string
    {
        /**
         * Username must not be empty.
         * Must contain only letters and numbers.
         */
        if (empty($username)) {
            return "Votre nom d'utilisateur doit être renseigné.";
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            return "Votre nom d'utilisateur ne peut contenir que des lettres ou des chiffres.";
        }

        return '';
    }

    public function verifyEmail($email): string
    {
        /**
         * Email must match pattern. And must be unique.
         */
        if (empty($email)) {
            return "L'adresse email doit être renseigné.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Adresse email non valide.";
        }

        if ($this->user->getUserByEmail($email) !== false) {
            return "Cette adresse mail est déjà utilisée.";
        }

        return '';
    }

    public function verifyPassword($password, $confirmPassword = ''): string
    {
        /**
         * Password must be at least 6 characters long,
         * Must match with confirm password.
         */
        if (empty($password)) {
            return "Password vide.";
        }

        if (strlen($password) < 6) {
            return "Votre mot de passe doit contenir au moins 6 caractères.";
        }

        if ($password !== $confirmPassword) {
            return "Vos mots de passe ne correspondents pas.";
        }

        return '';
    }

    public function signup(): void
    {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

            $data['usernameError'] = $this->verifyUsername($data['username']);
            $data['emailError'] = $this->verifyEmail($data['email']);
            $data['passwordError'] = $this->verifyPassword($data['password'], $data['confirmPassword']);

            /**
             * If no error : Create user in database.
             */
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $createUser = $this->user->signup($data);

                if ($createUser) {
                    $this->goTo('/login');
                } else {
                    echo "Une erreur s'est produite lors de l'inscription. Veuillez réessayer s'il vous plait.";
                }
            }
        }

        $this->render('signup', $data);
    }

    public function login(): void
    {
        // Is an user already connected ?
        if (isset($_SESSION['userId'])) {
            $this->goTo('/dashboard');
        }

        $data = [
            'error' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
            ];


            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->user->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $this->createSession($loggedInUser);
                    $this->goTo();
                } else {
                    $data['error'] = 'Email ou mot de passe incorrect.';
                }
            }
        }

        $this->render('login', $data);
    }

    public function createSession($user): bool
    {
        $_SESSION['userId'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = ucfirst($user['username']);

        return true;
    }

    public function logout(): void
    {
        session_start();
        unset($_SESSION);
        session_unset();
        session_destroy();

        $this->goTo('/');
    }

    public function editProfile($property)
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $newValue = $_POST[$property];

            switch ($property) {
                case 'email':
                    $error = $this->verifyEmail($newValue);
                    break;

                case 'username':
                    $error = $this->verifyUsername($newValue);
                    break;
            }

            if (empty($error)) {

                $id = $_POST['id'];

                $this->user->updateUser($property, $newValue, $id);

                $user = $this->user->getOne($id);
                $this->createSession($user);

                header('Location: /dashboard/profile/' . $id);
            }
        }

        $data = $this->user->getOne($_SESSION['userID']);
        $data['property'] = $property;
        switch ($property) {
            case 'email':
                $data['propertyName'] = "e-mail";
                break;
            case 'username':
                $data['propertyName'] = "nom d'utilisateur";
                break;
        }

        $data['error'] = $error;

        $this->render('editProfile', $data);
    }
}
