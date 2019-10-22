<?php

namespace App\Http\Controllers\Backend;

use App\model\Image;
use App\Model\Product;
use App\Model\Product_type;
use App\model\ProductManyImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public $productType;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->productType = Product_type::get()->pluck('name','id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->paginate(10);
        //dd($product);
        return view('backends.products.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productType = $this->productType;
        $product_id = 0;
        return view('backends.products.create',compact('productType','product_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'number_of_pax' => 'required|numeric',
            'duration_days' => 'required|numeric',
            'duration_nights' => 'required|numeric',
        ]);
        $code = Carbon::now()->format('ymdhms');
        request()->merge(['status' => '1','code'=>$code,'staff_id' => Auth::user()->id]);
        $product = Product::create($request->all());
        return redirect()->route('backend.product.after',$product->id)
            ->with('success','Product created successfully.');
    }

    public function afterCreateProduct($id){
        $productType = $this->productType;
        $product = Product::findOrFail($id);
        $image = DB::table('product_many_images')
            ->join('images','id','=','images_id')
            ->where('product_id','=',1)->get();
        return view('backends.products.afterCreateProduct',compact('productType','product','image'));
    }

    public function createPeriod($id){
        $product_id = $id;
        return view('backends.periods.create',compact('product_id'));
    }

    public function storeImage(Request $request){
        //dd($request->all());
        //dd($request->hasFile('gallery'));
        if ($request->hasFile('gallery')) {
            //dd($request->file('gallery'));
            $files = $request->file('gallery');
            foreach ($files as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path() .'/uploads/'.$request->product_id.'/';
                $src = '/uploads/'.$request->product_id.'/'.$imageName;
                $image->move($destinationPath, $imageName);
                //dd($src);
                request()->merge(['title' => 'Image title',
                    'alt' => 'Alt Attribute เป็นข้อความที่ทุกรูปภาพควรจะต้องมี เพราะมีประโยชน์ต่อ Google, ผู้ค้นหา และผู้เข้าชมเว็บไซต์',
                    'description' => 'Some quick example text to build on the image title and make up the bulk of the image\'s content.',
                    'file_path'=>$destinationPath,
                    'file_name'=>$imageName,
                    'src'=>$src]);
                $ref_image = Image::create($request->all());
                DB::table('product_many_images')->insert([
                    'product_id' => $request->product_id,
                    'images_id' => $ref_image->id,
                    'created_at' => now()
                ]);
            }
        }
        return redirect()->route('backend.product.after',$request->product_id)
            ->with('success','Image upload successfully.');
    }

    public function setTypeImage($id,$type,$product_id){
        $image = Image::findOrFail($id);
        $image->type = $type;
        $image->save();
        return redirect()->route('backend.product.after',$product_id)
            ->with('success','Image Update successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
