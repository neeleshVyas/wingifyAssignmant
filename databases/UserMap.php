<?php

namespace DBC;

class UserMap extends ObjectMap
{
    protected $table = 'users';

    public function getUserById( $userId )
    {
        return $this->find()->where('userId',$userId)->get();
    }

    public function getUserByCredentials( $username, $password )
    {
        return $this->find()->where('username',$username)->where('password',md5($password))->get();
    }
}

 ?>
