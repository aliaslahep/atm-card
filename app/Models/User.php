<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Modules\Role\Models\Role;
use Response;
use App\UserStatusError;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable {
    
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'role_id', 'first_name', 'last_name', 'mobile_number', 'email', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;

    protected $table = 'rb_users';

    public function setFirstNameAttribute($value) {

        $this->attributes['first_name'] = ucfirst($value);

    }

    public function setEmailAttribute($value) {

        $this->attributes['email'] = strtolower($value);

    }

    public function role() {

        $roleTable = (new Role())->getTable();

        return $this->belongsTo('App\Modules\Role\Models\Role');

    }
    
    public function findForPassport($username) {
        
        return $this->where('username', $username)->first();
        
    }
    
    public function validateForPassportPasswordGrant($password)  {
        //check for password
        if (Hash::check($password, $this->getAuthPassword())) {
            //is user active?
            if ($this->status == 1) {
                return true;
            } else {

                $status = array(

                    '0' => [

                        'message' => 'User is not active'
                    ],
                    '2' => [

                        'message' => 'User is not active'
                    ],

                );

                if (array_key_exists($this->status, $status)) {

                    $message=$status[$this->status]['message'];

                    throw UserStatusError::invalidCredentials1($message);

                }

            }
        }
    }
  

}
