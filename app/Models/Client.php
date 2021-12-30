<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $with  = 'cities';
    protected $primaryKey = 'code';
    protected $fillable=['name','city'];
    use HasFactory;

    public function cities(){
        return $this->hasOne(Cities::class, 'code','city');
    }
}
