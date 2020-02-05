<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'first_name', 'last_name','token_type', 'email', 'password','password_confirmation'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function generateToken()
 {
        $this->api_token = str_random( 60 );
        $this->save();

        return $this->api_token;
    }
}
