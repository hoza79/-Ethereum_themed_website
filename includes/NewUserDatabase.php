<?php
class NewUserDatabase {
    private $server;
    private $username;
    private $password;
    private $database_name;
    private $conn;

    public function __construct($server, $username, $password, $database_name) {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->database_name = $database_name;
    }

    public function connect() {
        $this->conn = new mysqli($this->server, $this->username, $this->password, $this->database_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function insertNewUser($firstname, $lastname, $age, $username, $password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 
            $stmt = $this->conn->prepare
                ("INSERT INTO UserInfo (FirstName, LastName, Age, UserName, Password)
                  VALUES (?,?,?,?,?)");
            $stmt->bind_param("ssiss", $firstname, $lastname, $age, $username, $hashedPassword);
            $stmt->execute();
        
            if (!$stmt->affected_rows > 0) {
                echo "Error: " . $stmt->error;
            }
        
            $stmt->close();
    }

    public function insertContactForm($name, $email, $subject) {
         $sql = "INSERT INTO user_contact_forms (Name, Email, Subject) 
                VALUES ('$name', '$email', '$subject')";
        
        if (!mysqli_query($this->conn, $sql)) {
            echo "Error inserting record: " . mysqli_error($this->conn);
        }
    }
    
}

?>
