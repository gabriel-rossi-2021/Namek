<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{

    protected $table = 'function';
    protected $primaryKey = 'id_function';
    protected $fillables = ['name_function'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $timestamps = false ;
    use HasFactory;
}
