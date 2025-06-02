<?php
class User {
    public static function authenticate($username, $password) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }
    
    public static function create($username, $email, $password, $birthyear) {
        $conn = getDBConnection();
        
        // Tarkista onko käyttäjänimi tai sähköposti jo käytössä
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        
        if ($stmt->get_result()->num_rows > 0) {
            return false;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, birthyear) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $email, $hashedPassword, $birthyear);
        
        return $stmt->execute();
    }
    
    public static function getById($id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT id, username, email, birthyear FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>