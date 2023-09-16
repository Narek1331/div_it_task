<?php
namespace App\Services;

use App\Models\User;

class UserService{

    /**
     * Create user.
     */
    public function store($name, $email, $password){
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    /**
     * Get users.
     */
    public function all(){
        return User::get();
    }

    /**
     * Get me info by id.
     */
    public function getMeInfo($id){
        return User::find($id);
    }

}

?>
