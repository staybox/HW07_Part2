<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;

    public function getAllUsers()
    {
        return self::all();

    }
    public function CreateUser($data)
    {
        self::forceCreate(['login' => $data['login'], 'password' => $data['password'], 'name' => $data['name'], 'age' => $data['age'], 'description' => $data['desc'], 'photo' => $data['photo'], 'photo_name' => $data['photo_name']]);
    }

    public function getUserByLogin($login)
    {
        return $this->where('login', $login)->first();
    }

    public function getFiles()
    {
        return self::all();
    }

    public function removeUser($remove_user_id)
    {
        return $this->where('USER_ID',$remove_user_id)->delete();
    }

    public function removePic($userId)
    {
        return $this->where('USER_ID', $userId)->update(['PHOTO' => null, 'PHOTO_NAME' => null]);
    }


    public function auth($login,$password)
    {
        return $this->where('LOGIN', $login)->where('PASSWORD', $password)->first();
    }

    public function getUserById($userId)
    {
        return $this->where('USER_ID', $userId)->first();
    }

    public function UpdateUser($userId, $data)
    {
        $user = $this->where('USER_ID', $userId)->first();


        if ($user !== null) {


            $user->update(['LOGIN' => $data['login'], 'EMAIL' => $data['Email_Parse'], 'NAME' => $data['name'], 'AGE' => $data['age'], 'DESCRIPTION' => $data['desc'], 'PASSWORD' => $data['password'], 'PHOTO' => $data['photo'], 'PHOTO_NAME' => $data['photo_name']]);
        }
    }

}
