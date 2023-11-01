<?php

declare (strict_types = 1);

namespace App\Models;

use App\Model;

class UserModel extends Model
{
    public function create(string $email, string $name, bool $isActive = true): int
    {
        /*preparing the creation of the new user */
        $stmt = $this->db->prepare(
            'INSERT INTO users (email, full_name, is_active, created_at) 
            VALUES (:email, :full_name, :is_active, now())'
        );
        /*entering in the values  */
        $stmt->execute([
            ':email' => $email,
            ':full_name' => $name,
            ':is_active' => $isActive
        ]);

        /*must call lastInsertId before the commit method and it returns the last id created in the database which is the one created by the execute method above */
        return (int) $this->db->lastInsertId();
    }
}