<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transfer;

class TransfersController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザーを取得
            $user = \Auth::user();
            // ユーザーの入出金の一覧を作成日時の降順で取得
            $transfers = $user->transfers()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'transfers' => $transfers,
            ];
        }
        
        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }

    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $to_user_id = $request->input('to_user_id');
        $price = $request->input('price');
        /////////////////////////////////////////////////////////
        // 振込 to_user_id 確認 バリデーション
        if ($user_id == $to_user_id) {
            $request->validate([
                //'to_user_id' => 'exclude_if:to_user_id,user_id|required',
                //'to_user_id' => Rule::unique('transfers')->ignore($user->id)
            ]);
            // 前のURLへリダイレクトさせる
            return back();
        }
        ////////////////////////////////////////////////////////
        //振込 マイナス除外 バリデーション
        if ($to_user_id != "") {
            //"振込の場合、price +";
            $request->validate([
                'content' => 'required|max:255',
                'price' => 'required|gt:0',
            ]);
        } else {
            //"必須入力";
            $request->validate([
                'content' => 'required|max:255',
                'price' => 'required',
            ]);
        }
        /////////////////////////////////////////////////////////////
        // 振込 price マイナス除外 バリデーション
        if ($price < 0) {
            //"price -の場合、null？";
            $request->validate([
                'to_user_id' => 'lt:0',
            ]);
        }

        // 認証済みユーザーの入出金として作成（リクエストされた値をもとに作成）
        $request->user()->transfers()->create([
            'to_user_id' => $request->to_user_id,
            'content' => $request->content,
            'price' => $request->price,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }

}
