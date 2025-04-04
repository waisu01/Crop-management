<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
{
    /**
     * ホーム画面の表示
     */
    public function home()
    {
        $items = item::all();
        return view('home.home',compact('items'));
    }
    
    /**
     * 一覧画面の表示
     */
    public function list(Request $request)
    {

        if (isset($request->search)) {
            $items = item::where('status',1)
                ->where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('type', $request->search)
                ->paginate(5);
            }
        else {
            $items = item::where('status',1)->paginate(5);
        }
        return view('home.list', [
            'items' => $items,
            'search' => $request->search
        ]);

    }

    /**
     * 詳細画面の表示
     */
    public function show($id)
    {
        $item = item::find($id);

        return view('home.show', compact('item'));
    }
}