<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;
use Generator;

class Tickets extends Model
{
    public function all(): Generator
    {
        $stmt = $this->db->query(
            'SELECT *
             FROM users'
        );

        return $this->fetchLazy($stmt);
    }
}