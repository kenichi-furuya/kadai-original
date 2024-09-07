<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{

    public function show($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);
        $transfers = $user->transfers()-> WHERE('user_id',$id) -> orWHERE('to_user_id',$id) ->orderBy('created_at', 'desc')->paginate(10);
        //$transfers = $user->transfers()->orderBy('created_at', 'desc')->paginate(10);
        $value1 = $user->transfers()-> selectRaw('SUM(price) as tota_in') -> WHERE('user_id',$id) -> WHERE('to_user_id',NULL) ->get();
        $value2 = $user->transfers()-> selectRaw('SUM(price) as total_other') -> WHERE('to_user_id',$id) ->get();
        $value3 = $user->transfers()-> selectRaw('SUM(price) as total_send') -> WHERE('user_id',$id) -> WHERE('to_user_id','!=',null) ->get();// -> WHERE('to_user_id','!=',$id)
        $total = $value1;//+$value2+$value3;
        
        // ユーザー詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'transfers' => $transfers,
            'value1' => $value1,
            'value2' => $value2,
            'value3' => $value3,
            'total' => $total
        ]);
    }

    public function transfers($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);
        $transfers = $user->transfers()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザー詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'transfers' => $transfers,
        ]);
    }

    public function inout($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);
        $transfers = $user->transfers()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザー詳細ビューでそれを表示
        return view('users.inout', [
            'user' => $user,
            'transfers' => $transfers
        ]);
    }
    
    public function send($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);
        $transfers = $user->transfers()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザー詳細ビューでそれを表示
        return view('users.send', [
            'user' => $user,
            'transfers' => $transfers,
        ]);
    }

}