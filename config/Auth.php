<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 6/4/19
 * Time: 8:29 PM
 */

class Auth
{

    public function encryptPassword($password){

        return md5($password);
    }

    public function comparePassword($requestedPass, $pass){

        if($this->encryptPassword($requestedPass)==$pass)
            return true;
        else
            return false;
    }
}