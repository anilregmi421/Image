<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable=['name', 'address', 'image'];
    
    public $primaryKey='id';

    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App/Models/User');
    }
}
