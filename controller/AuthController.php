<?php 

class AuthController {
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function showLogin() {
        include 'views/login.php';
    }

    public function showRegister() {
        include 'views/register.php';
    }

    public function handleLogin() {
        try {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->authService->login($email, $password);
            session_start();
            $_SESSION['user'] = $user;
            header('Location: /dashboard');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function handleRegister() {
        try {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->authService->register($name, $email, $password);
            header('Location: /login');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
    }
}