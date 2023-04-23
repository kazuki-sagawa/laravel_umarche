<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next) {
            // dd($request->route()->parameter('shop')); // 文字列
            // dd(Auth::id()); // 数字

            $id = $request->route()->parameter('shop');

            if(!is_null($id)) // null判定
            {
                $shopOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopOwnerId; // キャスト 文字列->数値に型変換
                $ownerId = Auth::id();

                if($shopId !== $ownerId)
                {
                    abort(404); // 404画面表示
                }
            }
            return $next($request);
        });
    }

    public function index()
    {
        $ownerId = Auth::id();
        $shops = Shop::where('owner_id', $ownerId)->get();


        return view('owner.shop.index', compact('shops'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {

    }
}