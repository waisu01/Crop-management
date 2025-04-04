<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();

        return view('user.index', compact('user'));
    }

    // 編集画面にIDを活用してデータを表示する
    public function edit(Request $request, $id)
    {
        $user = User::where('id', '=', $id)->first();

        return view('user.edit', compact('user'));
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        // バリデーション
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => ['required','email','max:255',Rule::unique('users')->ignore($user->id)],
            'role' => 'required',
        ],
        [
            'name.required' => '名前の入力は必須です',
            'name.max' => '名前は50文字以内で入力して下さい',
            'email.required' => 'メールアドレスの入力は必須です',
            'email.email' => 'メールアドレスを正しく入力して下さい',
            'email.max' => 'メールアドレスは255文字以内で入力して下さい',
            'email.unique' => 'このメールアドレスは他のユーザーが使用しています。別のメールアドレスを入力して下さい',
            'role.required' => '付与する権限を選択して下さい'

        ]);
        
        // 更新前のデータを取得
        $originalData = $user->toArray();

        // データを更新
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // 更新後のデータを比較
        if ($user->isDirty()) {
            $user->save();
            return redirect('/user/index')->with('success', "ユーザーID $user->id を更新しました");
        } else {
            return redirect('/user/index')->with('info', "ユーザーID $user->id の更新した項目はありません");
        }
    }

    // 削除処理
    public function destroy(Request $request, $id)
    {

        // 管理者は自分を削除出来ない
        $loggedInUserId = Auth::id(); 

        if ($loggedInUserId == $id) {
            return redirect()->back()->withErrors(['error' => '管理者である自分のIDを削除することはできません。管理者権限をもっている他のユーザーへ削除依頼をしてください。']);
        }

        $user = User::find($id);
        $user->delete();

        return redirect('/user/index')->with('danger', "ユーザーID $user->id を削除しました");
    }
}

