<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function add(){
        $r=request();

        $image=$r->file('productImage');
        $image->move('images',$image->getClientOriginalName());
        $imageName=$image->getClientOriginalName();

        $addProduct=Product::create([
            'name'=>$r->productName,
            'description'=>$r->productDescription,
            'price'=>$r->productPrice,
            'quantity'=>$r->productQuantity,
            'image'=>$imageName,
            'CategoryID'=>$r->categoryID,
        ]);

        Session::flash('success',"Product create successfully");

        return redirect()->route('viewProduct');
         
      
    }

    public function view() {
        // $viewProduct=Product::all(); // generate SQL select * from product
        $viewProduct=DB::table('products') //DB name
        ->leftjoin('categories','categories.id','=','products.CategoryID')
        ->select('products.*','categories.name as catName')
        ->get();
        return view('showProduct')->with('products',$viewProduct);
    }

    public function edit($id){
        $products=Product::all()->where('id',$id);
        return view('editProduct')->with('products',$products)->with('categoryID',Category::all());

    }

    public function update(){

        $r=request();
        $products=Product::find($r->id);
        if($r->file('productImage')!=''){

        $image=$r->file('productImage');
        $image->move('images',$image->getClientOriginalName());
        $imageName=$image->getClientOriginalName();
        $products->image=$imageName;
        }
            $products->name=$r->productName ;
            $products->description=$r->productDescription;
            $products->price=$r->productPrice;
            $products->quantity=$r->productQuantity;
            $products->CategoryID=$r->CategoryID;
            $products->save();
        

        Session::flash('success',"Product update successfully");

        return redirect()->route('viewProduct');

    }

    public function delete($id){
        $deleteProduct=Product::find($id);
        $deleteProduct->delete();
        Session::flash('success',"Product delete successfully");

        return redirect()->route('viewProduct');
    }

    public function viewProduct(){

        
        $products=Product::paginate(3);
        return view('viewProducts')->with('products',$products);

    }


    public function productdetail($id){
        $products=Product::all()->where('id',$id);
        return view('productDetail')->with('products',$products);
    }
}
