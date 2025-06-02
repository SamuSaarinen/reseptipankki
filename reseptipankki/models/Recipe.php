<?php
class Recipe {
    public static function getAll() {
        $conn = getDBConnection();
        $result = $conn->query("
            SELECT r.*, u.username 
            FROM recipes r 
            JOIN users u ON r.user_id = u.id 
            ORDER BY r.created_at DESC
        ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public static function getByCategory($category) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("
            SELECT r.*, u.username 
            FROM recipes r 
            JOIN users u ON r.user_id = u.id 
            WHERE r.category = ? 
            ORDER BY r.created_at DESC
        ");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public static function getById($id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("
            SELECT r.*, u.username 
            FROM recipes r 
            JOIN users u ON r.user_id = u.id 
            WHERE r.id = ?
        ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public static function create($userId, $name, $category, $ingredients, $instructions) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("
            INSERT INTO recipes 
            (user_id, name, category, ingredients, instructions) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("issss", $userId, $name, $category, $ingredients, $instructions);
        
        return $stmt->execute() ? $conn->insert_id : false;
    }
    
    public static function update($id, $name, $category, $ingredients, $instructions) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("
            UPDATE recipes 
            SET name = ?, category = ?, ingredients = ?, instructions = ? 
            WHERE id = ?
        ");
        $stmt->bind_param("ssssi", $name, $category, $ingredients, $instructions, $id);
        return $stmt->execute();
    }
    
    public static function delete($id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("DELETE FROM recipes WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>