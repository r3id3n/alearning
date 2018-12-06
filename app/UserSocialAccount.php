<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocialAccount extends Model
{
    protected $fillable = ['user_id', 'provider', 'provider_uid'];
    //Red Solial de ingreso del usuario
    public $timestamps = false;
    public function user(){
        //una red solicla pertenece a un usuario
        return $this->belongsTo(User::class);
    }
}
