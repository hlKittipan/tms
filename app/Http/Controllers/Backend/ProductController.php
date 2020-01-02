<?php

namespace App\Http\Controllers\Backend;

use App\model\Image;
use App\Model\Period;
use App\Model\Price;
use App\Model\Product;
use App\Model\Product_type;
use App\model\ProductManyImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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
            ->where('product_id','=',$id)->get();
        $period = Period::where('periods.product_id','=',$id)->orderBy('date_end','desc')->get();
        //dd($period);
        productDetail(2);
        return view('backends.products.afterCreateProduct',compact('productType','product','image','period'));
    }

    public function createPeriod($id){
        $product_id = $id;
        return view('backends.periods.create',compact('product_id'));
    }

    public function storePeriod(Request $request){
        request()->merge(['staff_id' => Auth::user()->id]);
        $isCheckedAll = $request->has('all');
        if ($isCheckedAll){
            request()->merge([
                'sun' => '1',
                'mon' => '1',
                'tue' => '1',
                'wed' => '1',
                'thu' => '1',
                'fri' => '1',
                'sat' => '1',
                ]);
        }

        $date = $request->date_start;
        if($date == null){
            return redirect()->route('backend.product.period.create',$request->product_id)
                ->with('success','Can not create period please check.');
        }
        //dd($request->all());
        Period::create($request->all());

        return redirect()->route('backend.product.after',$request->product_id)
            ->with('success','Period Create successfully.');
    }

    public function editPeriod($id){
        $period = Period::findOrFail($id);
        return view('backends.periods.edit',compact('period'));
    }

    public function updatePeriod(Request $request){
        request()->merge(['staff_id' => Auth::user()->id]);
        $isCheckedAll = $request->has('all');
        if ($isCheckedAll){
            request()->merge([
                'sun' => '1',
                'mon' => '1',
                'tue' => '1',
                'wed' => '1',
                'thu' => '1',
                'fri' => '1',
                'sat' => '1',
            ]);
        }else{
            request()->merge([
                'sun' => isset($request->sun) ? 1 : 0,
                'mon' => isset($request->mon) ? 1 : 0,
                'tue' => isset($request->tue) ? 1 : 0,
                'wed' => isset($request->wed) ? 1 : 0,
                'thu' => isset($request->thu) ? 1 : 0,
                'fri' => isset($request->fri) ? 1 : 0,
                'sat' => isset($request->sat) ? 1 : 0,
            ]);
        }

        $date = $request->date_start;
        if($date == null){
            return redirect()->route('backend.product.period.create',$request->product_id)
                ->with('success','Can not create period please check.');
        }
        if($request->date_start != $request->current_date_start && $request->date_end != $request->current_date_end){
            request()->merge(['date_start' => Carbon::tomorrow()]);
            $new_period = Period::create($request->all());

            $this->clonePriceToPeriod($request->period_id,$new_period->id);

            $period = Period::findOrFail($request->period_id);
            $period->date_end = Carbon::today();
            $period->save();
        }else{
            $period = Period::findOrFail($request->period_id);
            $period->date_start = $request->date_start;
            $period->date_end = $request->date_end;
            $period->sun =  $request->sun;
            $period->mon =  $request->mon;
            $period->tue =  $request->tue;
            $period->wed =  $request->wed;
            $period->thu =  $request->thu;
            $period->fri =  $request->fri;
            $period->sat =  $request->sat;
            $period->remark = $request->remark;
            $period->save();
        }
        //dd($request->all());

        return redirect()->route('backend.product.after',$request->product_id)
            ->with('success','Period Update successfully.');
    }

    public function createPrice($product_id,$period_id,$status){
        return view('backends.prices.create',compact('product_id','period_id','status'));
    }

    public function storePrice(Request $request){
        //dd($request->all());
        request()->merge(['staff_id' => Auth::user()->id]);
        $date = $request->date_start;
        if($date == null){
            return redirect()->route('backend.product.period.create',$request->product_id)
                ->with('success','Can not create Price please check.');
        }
        //dd($request->all());
        Price::create($request->all());

        return redirect()->route('backend.product.after',$request->product_id)
            ->with('success','Price Create successfully.');
    }

    public function clonePriceToPeriod($period_id,$new_id){
        $price = DB::table('prices')->where('period_id','=',$period_id)->get();
        foreach ($price as $key => $value){
            //dd($value);
            $new = new Price();
            $new->product_id = $value->product_id;
            $new->period_id = $new_id;
            $new->staff_id = Auth::user()->id;
            $new->cost_adult = $value->cost_adult;
            $new->cost_child = $value->cost_child;
            $new->cost_infant = $value->cost_infant;
            $new->public_adult = $value->public_adult;
            $new->public_child = $value->public_child;
            $new->public_infant = $value->public_infant;
            $new->remark = $value->remark;
            $new->save();
        }
    }

    public function editPrice($id){
        //
    }

    public function updatePrice(Request $request){
        //
    }

    public function deletePrice($id){
        $price = Price::findOrFail($id);
        $price->status = 0;
        $price->save();

        return redirect()->route('backend.product.after',$price->product_id)
            ->with('success','Price delete successfully.');
    }

    public function storeImage(Request $request){
        //dd($request->all());
        if ($request->hasFile('gallery')) {
            $files = $request->file('gallery');
            foreach ($files as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path() .'/uploads/'.$request->product_id.'/';
                $src = '/uploads/'.$request->product_id.'/'.$imageName;
                $image->move($destinationPath, $imageName);
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

    public function editImage($id){
        $image = DB::table('images')->join('product_many_images','images_id','=','id')
            ->where('images_id','=',$id)->first();
        //dd($image);
        return view('backends.products.images',compact('image'));
    }

    public function updateImage(Request $request,$id){
        $image = Image::findOrFail($id);
        $image->title = $request->title;
        $image->description = $request->description;
        $image->alt = $request->alt;
        $image->save();

        return redirect()->route('backend.product.after',$request->product_id)
            ->with('success','Image Update successfully.');
    }

    public function destroyImage(Request $request){
        $image = Image::find($request->id);

        if(File::exists(public_path() .$image->src)) {
            File::delete(public_path() .$image->src);
        }

        $image->delete();

        return redirect()->route('backend.product.after',$request->product_id)
            ->with('success','Image Delete successfully.');
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
        $productType = $this->productType;
        return view('backends.products.edit',compact('product','productType'));
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
        $product->update($request->all());
        return redirect()->route('backend.product.index')
            ->with('success','Product type Update successfully.');
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
