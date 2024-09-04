<?php 

class AuthService {
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($name, $email, $password)
    {
        $existingUser = $this->userRepository->findByEmail($email);
        if($existingUser)
        {
            throw new Exception("Email already exist");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User(null, $name, $email, $hashedPassword);

        return $this->userRepository->save($user);
    }

    public function login($email, $password)
    {
        $user = $this->userRepository->findByEmail($email);
        if($user && password_verify($password, $user->password)) {
            return $user;
        }
        
        throw new Exception("Invalid credentials.");
    }
}