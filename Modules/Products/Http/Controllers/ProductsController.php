<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Products\Entities\Product;
use Modules\Products\Form\ProductsForm;
use Modules\Tags\Entities\Tag;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:products.view');
        $this->middleware('role_or_permission:products.create')->only(['create', 'store']);
        $this->middleware('role_or_permission:products.update')->only(['edit', 'update']);
        $this->middleware('role_or_permission:products.delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $products = Product::all();;

        return view('products::index', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(FormBuilder $formBuilder)
    {
        $product = new Product();

        $form = $formBuilder->create(ProductsForm::class, [
            'method' => 'POST',
            'url' => url('admin/products/store'),
            'model' => $product
        ]);

        return view('products::create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:50|unique:product,name',
        ]);

        DB::beginTransaction();

        try {
            DB::commit();

            $products = $this->save( new Product, $request );

            Session::flash('type', 'success');
            Session::flash('message', 'Product added successfully');

            return redirect()->route('Admin.Products');

        } catch (\Throwable $th) {
            DB::rollBack();

            Session::flash('type', 'error');
            Session::flash('message', $th->getMessage());

            return redirect()->route('Admin.Products');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(FormBuilder $formBuilder, Product $product)
    {
        $form = $formBuilder->create(ProductsForm::class, [
            'method' => 'POST',
            'url' => url('admin/products/update/'.$product->id),
            'model' => $product
        ]);

        return view('products::edit', compact('form', 'product'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Product $product)
    {
        $validate = $request->validate([
            'name' => 'required|max:50|unique:product,name,'.$product->id,
        ]);

        DB::beginTransaction();

        try {
            DB::commit();

            $product = $this->save( $product, $request );

            Session::flash('type', 'success');
            Session::flash('message', 'Product edited successfully');

            return redirect()->route('Admin.Products');
        } catch (\Throwable $th) {

            DB::rollBack();

            Session::flash('type', 'error');
            Session::flash('message', $th->getMessage());

            return redirect()->route('Admin.Products');
        }
    }

    public function save(Product $product, Request $request){

        foreach($product->getFillable() as $fillable){
           $product->$fillable = $request->input($fillable);
        }

        $product->save();

        if($request->has('tags')){
            $product->tags()->sync($request->tags);
        }


        return $product;

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back();
    }
}
