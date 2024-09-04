<?php 

class UserRepository {
    private $conn;

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }

    public function findByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['id'], $row['name'], $row['email'], $row['password']);
        }
        return null;
    }

    public function findById($id) 
    {
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new User($row['id'], $row['name'], $row['email'], $row['password']);
        }
        
        return null;
    }

    public function save(User $user) {
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", password_hash($user->password, PASSWORD_BCRYPT));
        
       
        if ($stmt->execute()) {
        
        $lastInsertedId = $this->conn->lastInsertId();

        $user->setId($lastInsertedId);

        return $user; 
        }

        return null;  
    }
}