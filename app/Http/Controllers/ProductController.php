<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\BitwiseOr;

class ProductController extends Controller
{
  public function index()
  {

    $products = Product::all();

    return view('products.index')->with('products', $products);
  }

  public function trashView()
  {

    $trashProducts = Product::onlyTrashed()->get();

    return view('products.trash')->with("Tproducts", $trashProducts);
  }

  public function insert()
  {
    return view('products.insert');
  }

  public function insertStore(Request $request)
  {

    $request->validate([
      'title' => 'required|max:191',
      'shortDesc' => 'required',
      'longDesc' => 'required',
      'category' => 'required',
      'price' => 'required'
    ]);


    $image = array();

    if ($files = $request->file('image')) {
      foreach ($files as $file) {
        $ext = $file->getClientOriginalExtension();
        $fullName = Str::random(10) . '.' . $ext;
        $image_url = $fullName;
        $file->move("uploads/", $fullName);
        $image[] = $image_url;
      }
    }

    Product::insert([
      "title" => $request['title'],
      "shortDesc" => $request['shortDesc'],
      "longDesc" => $request['longDesc'],
      "category_id" => $request['category'],
      "price" => $request['price'],
      "file" => implode('|', $image)
    ]);

    session()->flash('status', 'Product add successfully!');
    return back();
  }

  public function singleProduct(Product $id)
  {
    return view('products.single-product')->with("product", $id);
  }

  public function update(Product $id)
  {

    return view('products.update')->with('prod', $id);
  }

  public function updateStore(Request $request, $id)
  {
    $request->validate([
      'title' => 'required|max:191',
      'shortDesc' => 'required',
      'longDesc' => 'required',
      'category' => 'required',
      'price' => 'required'
    ]);

    $findProduct = Product::find($id);

    $image = array();

    if ($request->hasFile('Newimage')) {

      if ($files = $request->file('Newimage')) {

        foreach ($files as $file) {
          $ext = $file->getClientOriginalExtension();
          $fullName = Str::random(10) . '.' . $ext;
          $image_url = $fullName;
          $file->move("uploads/", $fullName);
          $image[] = $image_url;
        }

        $uImage = $findProduct->file;
        $unlinkTag = explode('|', $uImage);
        foreach ($unlinkTag as $unItem) {
          unlink('uploads/' . $unItem);
        }
      }
    } else {
      $image[] = $request['oldImg'];
    }

    if (!is_null($findProduct)) {
      $findProduct->title = $request['title'];
      $findProduct->shortDesc = $request['shortDesc'];
      $findProduct->longDesc = $request['longDesc'];
      $findProduct->price = $request['price'];
      $findProduct->category_id = $request['category'];
      $findProduct->file = implode('|', $image);
      $findProduct->save();

      session()->flash('status', 'Product edit successfully!');
      return back();
    }
  }

  public function trash($id)
  {

    $findProduct = Product::find($id);

    if (!is_null($findProduct)) {

      $findProduct->delete();

      return redirect('/products/trash-view');
    }
  }

  public function restore($id)
  {

    $findProduct = Product::onlyTrashed()->find($id);

    if (!is_null($findProduct)) {

      $findProduct->restore();

      return redirect('/products');
    }
  }

  public function delete($id)
  {

    $findProduct = Product::onlyTrashed()->find($id);

    if (!is_null($findProduct)) {

      $uImage = $findProduct->file;
      $unlinkTag = explode('|', $uImage);
      foreach ($unlinkTag as $img) {
        unlink('uploads/' . $img);
      }

      $findProduct->forceDelete();
      return redirect('/products/trash-view');
    }
  }

  public function productCenter()
  {

    $products = Product::all();

    return view('products.product-center')->with("products", $products);
  }

  // Cart Work

  public function addCart(Product $id)
  {

    $cart = session()->get('cart');

    if (!$cart) {
      $cart = [
        $id->pid => [
          'title' => $id->title,
          'shortDesc' => $id->shortDesc,
          'longDesc' => $id->longDesc,
          'price' => $id->price,
          'image' => $id->file,
          'quantity' => 1
        ]
      ];

      session()->put('cart', $cart);

      return redirect('/all-cart');
    }

    if (isset($cart[$id->pid])) {

      $cart[$id->pid]['quantity']++;

      session()->put('cart', $cart);

      return redirect('/all-cart');
    }

    $cart[$id->pid] = [
      'title' => $id->title,
      'shortDesc' => $id->shortDesc,
      'longDesc' => $id->longDesc,
      'price' => $id->price,
      'image' => $id->file,
      'quantity' => 1
    ];

    session()->put('cart', $cart);

    return redirect('/all-cart');
  }

  public function allCart()
  {
    // echo "<pre>";
    // print_r(session()->get('cart'));

    return view('products.all-cart');
  }

  public function removeAllCart()
  {

    session()->forget('cart');

    return redirect('/product-center');
  }

  public function removeCart($id)
  {

    $cart = session()->get('cart');

    if (isset($cart[$id])) {

      unset($cart[$id]);

      session()->put('cart');

      return back();
    }
  }

  // LOGIN WORK

  public function login()
  {
    return view('auth.login');
  }

  public function register()
  {
    return view('auth.register');
  }

  public function registerStore(Request $request)
  {
    
   $request->validate([
     'name' => 'required|max:191',
     'email' => 'required|email',
     'password' => 'required'
   ]);

   User::insert([
    'name' => $request['name'],
    'email' => $request['email'],
    'password' => md5($request['password'])
   ]);

   session()->flash('status','Register successfull now go login again!');
   return back();

  }
}
