<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests\Product as ProductRequest;
use App\Model\Penname;
use App\Model\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function edit($id)
    {
        $product = Product::whereId($id)->first();

        if (!$product) {
            abort(404);
        }

        $pen_name = Penname::select('id', 'pen_name')->get();

        $data = [
            'product' => $product,
            'penname' => $pen_name,
        ];
        return view('cms.products.edit')->with($data);

    }

    public function store(ProductRequest $request, $id = null)
    {
        $now = Carbon::now();

        $product = Product::whereId($id)->first();

        if (!$product) {
            $product = new Product();
            $product->created_at = $now;
        }

        try {
            $product->title_th = $request->has('title_th') ? $request->input('title_th') : null;
            $product->title_en = $request->has('title_en') ? $request->input('title_en') : null;
            $product->sku = $request->has('sku') ? $request->input('sku') : null;
            $product->content = $request->has('content') ? $request->input('content') : null;
            $product->stock = $request->has('stock') ? $request->input('stock') : 0;
            $product->pen_name_id = $request->has('pen_name_id') ? $request->input('pen_name_id') : null;
            $product->status = $request->has('status') ? $request->input('status') : 'N';
            $product->status = $request->has('status') ? $request->input('status') : 'N';
            $product->price = $request->has('product_price') ? $request->input('product_price') : 0;
            $product->cost = $request->has('product_cost') ? $request->input('product_cost') : 0;
            $product->register = $request->has('register_cost') ? $request->input('register_cost') : 0;
            $product->ems = $request->has('ems_cost') ? $request->input('ems_cost') : 0;
            $product->remark = $request->has('remark') ? $request->input('remark') : 0;
            $product->updated_at = $now;
            $product->save();

            return redirect('cms/products/' . $product->id);

        } catch (\Exception $e) {
            \Log::error($e);
            throw $e;
//            throw new \Exception('Cant Product Product');
        }

        return redirect('cms/products/create');
    }

    public function create()
    {
        $pen_name = Penname::select('id', 'pen_name')->get();
        $data = [
            'penname' => $pen_name,

        ];
        return view('cms.products.create')->with($data);
    }

    public function index(Request $request)
    {

        $search = $request->has('search') ? $request->input('search') : null;
        $header = ['ID', 'Title', 'SKU', 'Pen Name', 'Cost', 'Reg', 'EMS', 'Stock', 'Status','Process'];

        $products = Product::join('pen_names', function ($q) {
            $q->on('pen_names.id', '=', 'products.pen_name_id');
        })
            ->select('products.*','pen_names.pen_name')
            ->orderBy('id', 'ASC');

        if ($search !== null) {
            $products = $products->where('title_th', 'LIKE', "%$search%")
                ->orWhere('title_en', 'LIKE', "%$search%")
                ->orWhere('pen_name', 'LIKE', "%$search%");
        }


        $products = $products->paginate(30);


        $data = [
            'header' => $header,
            'products' => $products,
        ];


        return view('cms.products.index')->with($data);
    }
}
