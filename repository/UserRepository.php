<?php 

class UserRepository {
    private $conn;

    public function __construct($conn) 
    {
        $this->conn = $conn;
    }

    public function findById($id) 
    {
         // Query untuk mencari pengguna berdasarkan ID
        $query = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
        // Bind parameter ID ke query
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Mengambil hasil query
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Jika pengguna ditemukan, membuat objek dan kembalikan objek User
        if ($row) {
            return new User($row['id'], $row['name'], $row['email'], $row['password']);
        }
        
        // Jika tidak ditemukan, kembalikan null
        return null;
    }

    public function save(User $user) {
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", password_hash($user->password, PASSWORD_BCRYPT));
        
        return $stmt->execute();
    }
}