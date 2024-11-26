<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        $user = new User();
        $user->name = 'Ana';
        $user->email = 'gerente@mercado.com.br';
        $user->password = Hash::make('123');

        $user->save;

        echo "<h1>cadastro user</h1>";
    }
}
