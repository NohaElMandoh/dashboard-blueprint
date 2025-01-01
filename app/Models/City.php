<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    use HasFactory;

    protected $fillable = ['name'];

    protected $casts = [
        'name' => 'array',
    ];

    public function getNameAttribute($value)
    {
        return json_decode($value, true);
    }

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = json_encode([
    //         'en' => $value['en'],
    //         'ar' => $value['ar'],
    //     ]);
    // }
}
