<?php

namespace App\Http\Controllers;

use App\Models\ItemRegister;
use App\Models\ItemComments;
use App\Models\orders;
use App\Models\order_comments;
use App\Models\User;
use App\Models\Client_detail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ItemFormRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  //　管理画面トップ
  public function admin() {
    return view('admin.admin');
  }

  //　商品管理の記述↓
  //　情報入力
  public function item_register() {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    return view('admin.item.register');
  }
  //　登録処理
  public function item_store(ItemFormRequest $request)  {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $validated = $request->validated();
    $image_path = $request->file('image')->store('public/img');
    $image_name = basename($image_path);
    ItemRegister::create([
      'name' => $request->name,
      'explanation'=> $request->explanation,
      'image' => $image_name,
      'value'=> $request->value,
      'stock'=> $request->stock,
      'status'=> false,
      'delete_flag' => false,
    ]);
    return to_route('admin.item.list');
  }
  //　商品リスト
  public function item_list() {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $items = ItemRegister::select('id','name','stock','status','created_at','updated_at')
    ->where('delete_flag', '!=', true)
    ->get();
    return view('admin.item.list',compact('items'));
  }
  //　商品検索
  public function item_search(Request $request) {
    $keyword = $request->input('keyword');
    $columns = ['name', 'explanation'];
    $query = ItemRegister::query();
    if (!empty($keyword)) {
      $query->where(function ($q) use ($keyword, $columns) {
        foreach ($columns as $column) {
          $q->orWhere($column, 'like', "%{$keyword}%");
        }
      });
    }
    $items = $query->get();
    return view('admin.item.search', compact('items','keyword'));
  }
  //　商品詳細
  public function item_detail($id) {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $item = ItemRegister::find($id);
    $comments = ItemComments::where('item_id',$id)
    ->with('user')
    ->get()
    ->reverse();
    if($item->status == false) {
      $status = '入荷待ち';
    } else {
      $status = '販売中';
    }
    return view('admin.item.detail',compact('item','comments','status'));
  }
  //　情報編集
  public function item_edit($id) {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $item = ItemRegister::find($id);
    $comments = ItemComments::where('item_id',$id)
    ->with('user')
    ->get()
    ->reverse();
    return view('admin.item.edit',compact('item','comments'));
  }
  //　情報更新
  public function item_update(ItemUpdateRequest $request, $id) {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $item = ItemRegister::find($id);
    $validated = $request->validated();
    $item->name = $request->name;
    $item->explanation = $request->explanation;
    if ($request->hasFile('image')) {
      Storage::delete('public/img/'.$item->image);
      $image_path = $request->file('image')->store('public/img');
      $image_name = basename($image_path);
      $item->image = $image_name;
    }
    $item->value = $request->value;
    $item->stock = $request->stock;
    $item->status = $request->status;
    $item->save();
    return to_route('admin.item.detail',['id' => $item->id]);
  }
  //　商品削除
  public function item_delete($id) {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $item = ItemRegister::findOrFail($id);
    $item->delete_flag = true;
    $item->save();
    return to_route('admin.item.list');
  }
  //　商品詳細のコメント登録
  public function item_comment(CommentRequest $request, $id){
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $item = ItemRegister::find($id);
    $validated = $request->validated();
    ItemComments::create([
      'item_id' => $item->id,
      'user_id'=> $user->id,
      'content'=> $request->content,
      'delete_flag' => false
    ]);
    return to_route('admin.item.detail',['id' => $item->id]);
  }

  //　注文管理の記述↓
  //　注文一覧
  public function order_list() {
    $clients = Client_detail::whereHas('orders', function ($query) {
      $query->where('status', false)
      ->where('cancel_flag', false);
      })
    ->with(['orders.orderItems'])
    ->get();
    return view('admin.order.list',compact('clients'));
  }
  //　発送済みの注文
  public function order_sending() {
    $clients = Client_detail::whereHas('orders', function ($query) {
      $query->where('status', true)
      ->where('cancel_flag', false);
      })
    ->with(['orders.orderItems'])
    ->get();
    return view('admin.order.sending',compact('clients'));
  }
  //　キャンセルされた注文
  public function order_canceled() {
    $clients = Client_detail::whereHas('orders', function ($query) {
      $query->where('cancel_flag', true);
      })
    ->with(['orders.orderItems'])
    ->get();
    return view('admin.order.canceled',compact('clients'));
  }
  //　注文検索
  public function client_search(Request $request) {
    $keyword = $request->input('keyword');
    $columns = ['phone_number', 'email','lastname','lastname_furigana','name','name_furigana','postcode','prefectures','town'];
    $query = Client_detail::query();
    if (!empty($keyword)) {
      $query->where(function ($q) use ($keyword, $columns) {
        foreach ($columns as $column) {
          $q->orWhere($column,$keyword);
        }
      });
    }
    $clients = $query->with(['orders.orderItems'])->get();
    return view('admin.order.search', compact('clients','keyword'));
  }
  //　注文詳細
  public function order_detail($id) {
    $user = Auth::user();
    $client = Client_detail::with('orders.orderItems.item')->findOrFail($id);
    $order = $client->orders;
    if($client->payment == '0') {
      $payment = '銀行振込';
    } else {
      $payment = '代引き';
    }
    if($order->status == false) {
      $status = '未発送';
    } else {
      $status = '発送済み';
    }
    if($order->cancel_flag == false) {
      $cancel_flag = '';
    } else {
      $cancel_flag = 'キャンセル';
    }
    $comments = order_comments::where('order_id',$order->id)
    ->with('user')
    ->get()
    ->reverse();
    return view('admin.order.detail',compact('user','order','client','status','cancel_flag','payment','comments'));
  }
  //　情報編集
  public function order_edit($id) {
    $user = Auth::user();
    $client = Client_detail::with('orders.orderItems.item')->findOrFail($id);
    $order = $client->orders;
    if($order->status == true || $order->cancel_flag == true) {
      return redirect()->route('admin.order.list');
    }
    if($client->payment == '0') {
      $payment = '銀行振込';
    } else {
      $payment = '代引き';
    }
    if($order->status == false) {
      $status = '未発送';
    } else {
      $status = '発送済み';
    }
    if($order->cansel_flag == false) {
      $cancel_flag = '';
    } else {
      $cancel_flag = 'キャンセル';
    }
    $comments = order_comments::where('order_id',$id)
    ->with('user')
    ->get()
    ->reverse();
    return view('admin.order.edit',compact('user','order','client','status','cancel_flag','payment','comments'));
  }
  //　情報更新
  public function order_update(OrderUpdateRequest $request, $id) {
    $client = Client_detail::findOrFail($id);
    $client->lastname = $request->lastname;
    $client->name = $request->name;
    $client->lastname_furigana = $request->lastname_furigana;
    $client->name_furigana = $request->name_furigana;
    $client->phone_number = $request->phone_number;
    $client->email = $request->email;
    $client->postcode = $request->postcode;
    $client->prefectures = $request->prefectures;
    $client->town = $request->town;
    $client->building = $request->building;
    $client->save();
    return to_route('admin.order.detail',['id' => $client->id]);
  }
  //　注文詳細のコメント登録
  public function order_comment(CommentRequest $request, $id){
    $client = Client_detail::with('orders.orderItems.item')->findOrFail($id);
    $order = $client->orders;
    $user = Auth::user();
    order_comments::create([
      'order_id' => $order->id,
      'user_id'=> $user->id,
      'content'=> $request->content,
      'delete_flag' => false
    ]);
    return to_route('admin.order.detail',['id' => $client->id]);
  }
  //　発送処理
  public function order_delivery($id) {
    $order = orders::find($id);
    if($order->status == true) {
      return redirect()->route('admin.order.detail',['id' => $order->id]);
    }
    $order->status = true;
    $order->save();
    return to_route('admin.order.sending');
  }
  //　キャンセル処理
  public function order_cancel($id) {
    $order = orders::find($id);
    $order->cancel_flag = true;
    $order->save();
    return to_route('admin.order.canceled');
  }

  //　ユーザー管理の記述↓
  //　情報入力
  public function user_register() {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    return view('admin.user.register');
  }
  //　登録処理
  public function user_store(UserFormRequest $request) {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $validated = $request->validated();
    User::create([
      'name' => $request->name,
      'email'=> $request->email,
      'password' => $request->password,
      'admin_flag'=> false,
      'delete_flag'=> false
    ]);
    return to_route('admin.user.list');
  }
  //　ユーザーリスト
  public function user_list() {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $users = User::select('id','name','email','admin_flag','created_at','updated_at')
    ->where('delete_flag', '!=', true)
    ->get();
    return view('admin.user.list',compact('users'));
  }
  //　ユーザー検索
  public function user_search(Request $request) {
    $keyword = $request->input('keyword');
    $columns = ['name', 'email'];
    $query = User::query();
    if (!empty($keyword)) {
      $query->where(function ($q) use ($keyword, $columns) {
        foreach ($columns as $column) {
          $q->orWhere($column, 'like', "%{$keyword}%");
        }
      });
    }
    $users = $query->get();
    return view('admin.user.search', compact('users','keyword'));
  }
  //　ユーザー詳細
  public function user_detail($id) {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $user = User::find($id);
    if($user->admin_flag == true) {
      $admin_flag = 'あり';
    } else {
      $admin_flag = 'なし';
    }
    return view('admin.user.detail',compact('user','admin_flag'));
  }
  //　情報編集
  public function user_edit($id) {
    $user = Auth::user();
    if($user->admin_flag == false) {
      return redirect()->route('admin.admin');
    }
    $user = User::find($id);
    return view('admin.user.edit',compact('user'));
  }
  //　情報更新
  public function user_update(UserUpdateRequest $request, $id) {
    $user = User::find($id);
    $user->fill($request->only(['name', 'email','admin_flag']));
    if ($request->has('password')) {
      $requestData['password'] = Hash::make($request->password);
    }
    $user->fill($requestData);
      if ($user->isDirty()) {
        $user->save();
      }
    return to_route('admin.user.detail',['id' => $user->id]);
  }
  //　ユーザー削除
  //public function user_delete($id) {
    //$user = Auth::user();
    //if($user->admin_flag == false) {
    //  return redirect()->route('admin.admin');
    //}
    //$user = User::find($id);
    //$user->delete_flag = true;
    //$user->save();
    //return to_route('admin.user.list');
  //}
}
