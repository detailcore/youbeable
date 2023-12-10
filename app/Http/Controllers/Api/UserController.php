<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //

    // получить имя пользователя
    public function getUserName(User $user, $user_id)
    {
        $user_name = $user
            ->whereId($user_id)
            ->first();

        abort_unless($user_name, 404, 'Not Found');

        return $user_name;     
    }
}
