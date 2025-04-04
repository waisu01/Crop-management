<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller{

	/*** 画面表示メソッド ***/

	/**
	 * 商品一覧画面を表示する
	 */
	public function view_ItemList(Request $request){

		// ページネーションでどのページを表示するか設定
		$page = $request->input('page', 1);
		session(['CorrentPage' => $page]);

		// itemsテーブルから10件データを取得
		$items = Item::paginate(10);

		// AuthからログインユーザーのIDを取得
		$user_id = Auth::id();

		// 登録画面や登録操作から一覧画面に遷移した場合、登録用セッションを空にする
		if(session()->has('item_register')){
			session()->forget('item_register');
		}
		
		// 編集画面や編集操作から一覧画面に遷移した場合、編集用セッションを空にする
		if(session()->has('item_before')){
			session()->forget('item_before');
		}

		// 編集画面や編集操作から一覧画面に遷移した場合、編集用セッションを空にする
		if(session()->has('item_after')){
			session()->forget('item_after');
		}

		return view('item.ItemList',compact('items','user_id'));
	}

	/**
	 * 商品登録画面を表示する
	 */
	public function view_ItemRegister($from,$user_id){
		if($from == 1){
			if(session()->has('item_register')){
				session()->forget('item_register');
			}
		}
		// アイテム登録画面へ遷移する
		return view('item.ItemRegister',compact('user_id'));
	}

	public function view_ItemRegisterCheck(Request $request, $user_id){

		// バリテーションチェック
		$request->validate([
			'name' => 'required|max:50',
			'status' => 'required|in:0,1',
			'type' => 'required|not_in:0',
			'detail' => 'required|max:255',
		],
		[
			'name.required' => '商品名は必須です',
			'name.max' => '商品名は50字以内にしてください',
			'status.required' => 'ステータスは必須です',
			'status.in' => '有効か無効を選択してください',
			'type.required' => '種別は必須です',
			'type.not_in' => '種別を選択してください',
			'detail.required' => '詳細は必須です',
			'detail.max' => '詳細は255字以内にしてください'
		]);
		
		// バリテーションクリアの場合、セッションに入力された内容を保存する
		session(['item_register' => $request->only(['name', 'type', 'status', 'detail'])]);
		
		// 登録確認画面へ遷移する
		return view('item.ItemRegisterCheck',compact('user_id'));
	}

	/**
	 * 商品更新画面を表示する
	 */
	public function view_ItemUpdate(Item $item = null, $user_id){
		/**
		 * $item != null：アイテムが空でない場合は、一覧画面から遷移している
		 * !session()->has('item_before')：セッション内にitembeforeがない場合、この条件は
		 * 　　　　　　　　　　　　　　　　　 正直いらないかも
		 */
		if($item != null && !session()->has('item_before')){
			session(['item_before' => $item->only(['id','name', 'status', 'type', 'detail','user_id'])]);
		}
		
		/**
		 * $item != null：アイテムが空でない場合は、一覧画面から遷移している
		 * !session()->has('item_after')：セッション内にitem_afterがない場合、この条件は
		 * 　　　　　　　　　　　　　　　　　 正直いらないかも
		 */
		if($item != null && !session()->has('item_after')){
			session(['item_after' => $item->only(['id','name', 'status', 'type', 'detail','user_id'])]);
		}

		// アイテム更新画面へ遷移する
		return view('item.ItemUpdate',compact('user_id',));
	}

	/**
	 * 商品更新確認画面を表示する
	 */
	public function view_ItemUpdateCheck(Request $request,$user_id){

		// バリテーションチェック
		$request->validate([
			'name' => 'required|max:50',
			'status' => 'required|in:0,1',
			'type' => 'required|not_in:0',
			'detail' => 'required|max:255',
		],
		[
			'name.required' => '商品名は必須です',
			'name.max' => '商品名は50字以内にしてください',
			'status.required' => 'ステータスは必須です',
			'status.in' => '有効か無効を選択してください',
			'type.required' => '種別は必須です',
			'type.not_in' => '種別を選択してください',
			'detail.required' => '詳細は必須です',
			'detail.max' => '詳細は255字以内にしてください'
		]);

		// バリテーションに問題ない場合は、対象のアイテムをデータベースから取得
		$item = Item::find($request->id);
		if ($item === null) {
			return redirect()->route('ItemList', ['user_id' => $user_id])
				->with('error', '該当する商品が見つかりませんでした');
		}
		
		// 入力内容が更新前から変わっているかチェック
		$updatedValues = $request->only(['name', 'status', 'type', 'detail']);
		$originalValues = $item->only(['name', 'status', 'type', 'detail']);
	
		// もし変わってないなら更新画面にリダイレクト
		if ($updatedValues == $originalValues) {
			return redirect()->back()
				->withErrors(['no_change' => '変更内容がありません'])
				->withInput();
		}

		// バリテーションＯＫかつ更新されていたら、セッションに変更内容を保存
		session(['item_after' => $request->only(['id','name', 'status', 'type', 'detail','user_id'])]);
		
		// 更新確認画面に遷移する
		return view('item.ItemUpdateCheck',compact('user_id'));
	}
	
	/**
	 * 商品削除確認画面を表示する
	 * 
	 * @param $user_id：ログインしているユーザーのID
	 * @return 商品削除ブレードファイル
	 */
	public function view_ItemDelete(Item $item, $user_id){
		
		// 削除画面に遷移する
		return view('item.ItemDelete',compact('item','user_id'));
	}

	/*** DB操作メソッド ***/
	/**
	 * 指定したitemテーブルを更新する
	 */
	public function update_Item(Request $request,$user_id){
		$target = Item::find($request->id);

		// アイテムの内容を更新する
		// セッションに保存した情報でアイテムを更新するのもよさそうだが、
		// とりあえずは$requestで実装
		$target->name = $request->name;
		$target->status = $request['status'];
		$target->type = $request->type;
		$target->detail = $request->detail;
		$target->user_id = $user_id;

		// 保存する
		$result = $target->save();
		
		// あらかじめセッションに保存していた一覧ページを取り出し、このページに戻る
		$page = session('CorrentPage', 1);

		if($result){
			return redirect()->route('ItemList',['page' => $page])->with('success','データベースの更新に成功しました');
		} else{
			return redirect()->route('ItemList',['page' => $page])->with('error','データベースの更新に失敗しました');
		}
	}

	/**
	 * 指定したitemテーブルのカラムを削除する
	 */
	public function delete_Item($id, $user_id){
		$result = Item::destroy($id);

		// あらかじめセッションに保存していた一覧ページを取り出し、このページに戻る
		$page = session('CorrentPage', 1);

		if($result){
			return redirect()->route('ItemList',['page' => $page])->with('success','データベースの削除に成功しました');
		} else{
			return redirect()->route('ItemList',['page' => $page])->with('error','データベースの削除に失敗しました');
		}
	}

	/**
	 * 入力されたitemテーブルのカラムを登録する
	 */
	public function Register_Item(Request $request){
		$user_id = Auth::id();
		$newItem = Item::create([
			'name' => $request->name,
			'type' => $request->type,
			'status' => $request->status,
			'detail' => $request->detail,
			'user_id' => $user_id
		]);

		// あらかじめセッションに保存していた一覧ページを取り出し、このページに戻る
		$page = session('CorrentPage', 1);
		if($newItem){
			return redirect()->route('ItemList',['page' => $page])->with('success','データベースの登録に成功しました');
		}else {
			return redirect()->route('ItemList',['page' => $page])->with('error','データベースの登録に失敗しました');
		}

	}
}
