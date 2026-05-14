public function updateProfile($id, $username, $password = null) {
    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username = ?, password = ? WHERE id = ?";
        return $this->db->execute($sql, [$username, $hashedPassword, $id]);
    } else {
        $sql = "UPDATE users SET username = ? WHERE id = ?";
        return $this->db->execute($sql, [$username, $id]);
    }
}

public function deleteUser($id) {
    $sql = "DELETE FROM users WHERE id = ?";
    return $this->db->execute($sql, [$id]);
}

// Metoda pro získání všech uživatelů (pro admina)
public function getAllUsers() {
    return $this->db->query("SELECT id, username, role FROM users");
}