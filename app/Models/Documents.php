<?php

namespace App\Models;

use CodeIgniter\Model;

class Documents extends Model
{
    protected $table      = 'files';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'type', 'sender', 'receipient', 'receipient_id', 'subject', 'description', 'status'];
}
