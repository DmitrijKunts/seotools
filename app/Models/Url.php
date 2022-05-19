<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['url'];

    public $timestamps = false;

    public function index()
    {
        return $this->hasMany(UrlIndex::class)->orderBy('created_at');
    }
}
