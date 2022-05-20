<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlIndex extends Model
{
    use HasFactory;

    protected $fillable = ['val'];

    public function url()
    {
        return $this->belongsTo(Url::class);
    }

}
