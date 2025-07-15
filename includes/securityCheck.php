<?php
class SecurityCheck {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function usernameExists($username) {
        $query = $this->conn->prepare("SELECT * FROM UserInfo WHERE Username = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $query->store_result();
        $count = $query->num_rows;
        $query->close();
        return $count > 0;
    }

    public function validateLoginInfo($username, $password) {
        $stmt = $this->conn->prepare("SELECT Password FROM UserInfo WHERE UserName = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
    
        $hashedPassword = "";
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();
    
            if (password_verify($password, $hashedPassword)) {
                $stmt->close();
                return true; 
            }
        }
    
        $stmt->close();
        return false; 
    }
}
?>
