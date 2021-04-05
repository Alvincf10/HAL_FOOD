<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Product;
use App\Cart;
use App\Star;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=User::find(\Auth::user()->id);//getuserbyid
        $categories=Category::all();//getcategories
        $products=Product::all();//getproduct
        $carts=Cart::where("user_id",\Auth::user()->id)->get();;//getcartbyuserid

        return view('home',[
        "user_data"=>$user,
        "categories"=>$categories,
        "products"=>$products,
        "total_cart"=>count ($cart)
        ]);
    }

    public function show($id){
    $product=Product::find($id);//getproductbyid
    $star=Star::where("product_id", $product->id)->first();//getstarbyproductid

    return view('showProduct',[
        "product"=>$product,
        "star"=>$star,
    ]);
    }

    public function addToCart(request $request ,$id){
    $user_id=\Auth::user()->id;
    $product_id=$id;
    $quantity=$request->quantity;

    $cart=Cart::create([
    "user_id"=>$user_id,
    "product_id"=>$product_id,
    "quantity"=>$quantity,
    ]);

    return redirect()->back()->with("massage","Berhasil menambah menu ke keranjang");
    }

    public function create()
    {
        $carts=Cart::where("user_id", \Auth::user()->id)->get(); //getcartbyuserid
        $address=Address::where("user_id", \Auth::user()->id)->get(); //getaddressbyuserid
        $payment=payment::all(); //getpayments

        return view('createOrder',[
        "carts"=>$carts,
        "address"=>$address,
        "payment"=> $payment
        ]);
    }

    public function carts()
    {
       $carts=Cart::where("user_id", \Auth::user()->id)->get(); //getcartbyuserid

       foreach ($carts as $key =>$cart) {
           $cart->product_data=Product::find($cart->product_id);
       }
       return view("carts",[
           "carts"=>$carts
       ]);
    }

    public function increaseQuantityByCartId($id)
    {
        $cart=Cart::find($id);

        $carts=$cart->update([
            "quantity"=>$cart->quantity +1
        ]);
        return redirect()->back()->with("massage","Berhasil menambah Jumlah Pesanan");
    }

    public function decreaseQuantityByCartId($id)
    {
        $cart=Cart::find($id);

        if ($cart->quantity>1) {
            $carts=$cart->update([
            "quantity"=>$cart->quantity -1
        ]);
        return redirect()->back()->with("massage","Berhasil Mengurangi Menu Dari Keranjang");
        }
        return redirect()->back()->with("massage","Gagal Mengurangi Menu Dari Keranjang");
    }

    public function deleteCartById($id)
    {
        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back()->with("massage","Berhasil Menghapus Menu Dari Keranjang");
    }

    public function deleteAllCartByUserId($id)
    {
        $carts=Cart::where("user_id", \Auth::user()->id)->get(); //getcartbyuserid

        $carts->delete();

        return redirect()->back()->with("massage","Berhasil Menghapus Seluruh Menu Dari Keranjang");
    }

    public function addAddress(Request $request)
    {
        $user_id=$request->name;
        $name=$request->address;
        $address=\Auth::user()->id;

        $address=Address::create([
        "user_id"=>$user_id,
        "name"=>$name,
        "address"=>$address,

        ]);
        return redirect()->back()->with("massage","Berhasil Menambah Alamat");
    }

    public function editAddress(Request $request,$id)
    {
        $name=$request->name;
        $address=$request->address;
        $user_id=\Auth::user()-id;

        $address=$address::find($id)->update([
        "user_id"=>$user_id,
        "name"=>$name,
        "address"=>$address,
        ]);

        return redirect()->back()->with("massage","Berhasil Mengupdate Alamat");
    }

    public function storeOrder(Request $request)
    {
        $carts=Cart::where("user_id", \Auth::user()->id)->get(); //getcartbyuserid
        $user_id=\Auth::user()->id;
        $address_id=$request->address_id;
        $status_id=1;
        $payment_id=$request->address_id;

        $invoice_code=$user_id.$payment_id.\Carbon\Carbon::now()->timestamp;

        foreach ($carts as $key =>$cart) {
            Order::create([
            "invoice_code=>$invoice_code",
            "user_id"=>$user_id,
            "address_id"=>$address_id,
            "product_id"=>$cart->product_id,
            "quantity"=>$cart->quantity,
            "status_id"=>$status_id,
            "payment_id"=>$payment_id,
            ]);
        }
        return ("/checkout/$invoice_code");
    }

    public function checkout($invoice_code)
    {
        $orders=Order::where("invoice_code",$invoice_code)->get();//getorderbyid

        return view("checkout",[
            "orders"=>$orders
        ]);
    }

    public function payNow($invoice_code)
    {
        $orders=Order::where("invoice_code",$invoice_code)->get();//getorderbyid

        $orders->update([
            "status_id=>6"
        ]);
        return redirect("/home");
    }

    public function timeout()
    {
        $orders=Order::where("invoice_code",$invoice_code)->get();//getorderbyid

        $orders->update([
            "status_id=>6"
        ]);
        return redirect("/home");
    }
}


