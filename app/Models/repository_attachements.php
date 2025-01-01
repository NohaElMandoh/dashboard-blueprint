<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repository_attachements extends Model
{
    use HasFactory;
    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }
}
