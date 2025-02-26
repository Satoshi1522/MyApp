<?php

namespace App\Http\Controllers;
use App\Models\ItemRegister;
use App\Models\client_detail;
use App\Models\orders;
use App\Models\order_items;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VueController extends Controller
{
  //　メインページ
  public function index() {
    $items = ItemRegister::where('delete_flag', '!=', true)
    ->where('status', '=', true)
    ->get();
    return view('vue.index',compact('items')) ;
  }
  //　商品詳細ページ
  public function item($id) {
    $item = ItemRegister::find($id);
    //　税率設定
    $tax_value = floor($item->value * 1.1);
    return view('vue.item',compact('item','tax_value'));
  }
  //　カートページ
  public function cart(Request $request) {
    $cart = session()->get('cart', []);
    //　合計金額
    $total = array_reduce($cart, function ($sum, $item) {
      return $sum + $item['subtotal'];
    }, 0);
    return view('vue.cart', compact('cart','total'));
  }
  //　カートへの商品追加
  public function add(Request $request)    {
      $item_id = $request->input('item_id');
      $name = $request->input('name');
      $value = $request->input('value');
      $quantity = $request->input('quantity');
      $image = $request->input('image');
      $cart = $request->session()->get('cart', []);
      if (isset($cart[$item_id])) {
          $cart[$item_id]['quantity'] += $quantity;
          $cart[$item_id]['subtotal'] = $cart[$item_id]['value'] * $cart[$item_id]['quantity'];
      } else {
        $cart[$item_id] = [
          'name' => $name,
          'value' => $value,
          'quantity' => $quantity,
          'image' => $image,
          'subtotal' => $value * $quantity
        ];
      }
      $request->session()->put('cart', $cart);
      return redirect()->route('vue.cart');
    }
    //　カートからの商品削除
    public function remove(Request $request)    {
      $item_id = $request->input('item_id');
      $cart = $request->session()->get('cart', []);
      unset($cart[$item_id]);
      $request->session()->put('cart', $cart);
      return redirect()->route('vue.cart');
    }
    //　購入ページ
  public function checkout(Request $request) {
    $cart = session()->get('cart', []);
    if (empty($cart)) {
      return redirect()->route('vue.cart');
    }
    $total = array_reduce($cart, function ($sum, $item) {
      return $sum + $item['subtotal'];
    }, 0);
    return view('vue.checkout',compact('cart', 'total'));
  }
  //　注文情報の送信
  public function submit(CheckoutRequest $request) {
    $cart = session()->get('cart', []);
    if (empty($cart)) {
      return redirect()->route('vue.cart');
    }
    $total = array_reduce($cart, function ($sum, $item) {
      return $sum + $item['subtotal'];
    }, 0);
    $validated = $request->validated();
    $client_id = Str::uuid();
    $errors = [];
    foreach ($cart as $item_id => $item) {
      $itemStock = ItemRegister::find($item_id);
      if ($itemStock->stock <= 0) {
        $errors[] = "{$item['name']}の在庫が不足しております。在庫数を超える注文はできません。";
      }
    }
    if (count($errors) > 0) {
      return redirect()->route('vue.cart')->with('errors', $errors);
    }
    $client_detail = client_detail::create([
      'client_id' => $client_id,
      'phone_number' => $request->phone_number,
      'email'=> $request->email,
      'lastname'=> $request->lastname,
      'lastname_furigana' => $request->lastname_furigana,
      'name' => $request->name,
      'name_furigana' => $request->name_furigana,
      'company'=> $request->company,
      'postcode' => $request->postcode,
      'prefectures'=> $request->prefectures,
      'town' => $request->town,
      'building' => $request->building,
      'payment'=> $request->payment,
    ]);
    $order = $client_detail->orders()->create([
      'client_id' => $client_detail->client_id,
      'total_amount'=> $request->total_amount,
      'status'=> false,
      'pay_status'=> false,
      'cancel_flag' => false
    ]);
    foreach ($cart as $item_id => $item) {
      $order->orderItems()->create([
        'order_id' => $order->id,
        'item_id' => $item_id,
        'value' => $item['value'],
        'quantity' => $item['quantity'],
        'subtotal' => $item['subtotal'],
      ]);
      $itemStock = ItemRegister::find($item_id);
      $itemStock->stock -= $item['quantity'];
      $itemStock->save();
    }
  session()->forget('cart');
  return redirect()->route('vue.checkout.complete');
  }
  public function complete() {
    return view('vue.complete') ;
  }
}
