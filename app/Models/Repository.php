<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name',
        'description',
        'city_id',
        'type_id',
        'verified',
        'status',
        'location',
        'map',
        'main_photo',
        'user_id',
        'area'
    ];
    public function additional_photos_urls()
    {
        return $this->hasMany(repository_photo::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function attachments()
    {
        return $this->hasMany(repository_attachements::class);
    }
}
