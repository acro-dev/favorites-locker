<?php

class UsersController extends Controller
{
    public function __construct()
    {
        $this->loadmodel('UsersModel');
    }

    public function verifyUsername($username)
    {
        /**
         * Username must not be empty.
         * Must contain only letters and numbers.
         */
        if (empty($username)) {
            return "Votre nom d'utilisateur doit être renseigné.";
        } else if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            return "Votre nom d'utilisateur ne peut contenir que des lettres ou des chiffres.";
        } else {
            return '';
        }
    }

    public function verifyEmail($email)
    {
        /**
         * Email must match pattern. And must be unique.
         */
        if (empty($email)) {
            return "L'adresse email doit être renseigné.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Adresse email non valide.";
        } else if ($this->UsersModel->checkEmail($email) !== false) {
            return "Cette adresse mail est déjà utilisée.";
        } else {
            return '';
        }
    }

    public function verifyPassword($password, $confirmPassword = '')
    {
        /**
         * Password must be at least 6 characters long,
         * Must match with confim password.
         */
        if (empty($password)) {
            return "Password vide.";
        } else if (strlen($password) < 6) {
            return "Votre mot de passe doit contenir au moins 6 caractères.";
        } else if ($password != $confirmPassword) {
            return "Vos mots de passe ne correspondents pas.";
        } else {
            return '';
        }
    }

    public function signup()
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

            $data['usernameError'] = $this->verifyUsername($data['username']);
            $data['emailError'] = $this->verifyEmail($data['email']);
            $data['passwordError'] = $this->verifyPassword($data['password'], $data['confirmPassword']);

            /**
             * If no error : Create user in database.
             */
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
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
                    $this->goHome();
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

        $this->goHome();

        exit();
    }

    public function editProfile($property)
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

                $this->UsersModel->updateUser($property, $newValue, $id);

                $user = $this->UsersModel->getOne($id);
                $this->createSession($user);

                header('Location: /dashboard/profile/' . $id);
            }
        }

        $data = $this->UsersModel->getOne($_SESSION['userID']);
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
