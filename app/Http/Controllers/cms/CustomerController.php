<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer as CustomerRequest;
use App\Model\Customer;
use Carbon\Carbon;

class CustomerController extends Controller
{

    public function store(CustomerRequest $request, $id = null)
    {
        $now = Carbon::now();

        $customer = Customer::whereId($id)->first();

        if (!$customer) {
            $customer = new Customer();
            $customer->created_at = $now;
        }

        try {
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->phone_number = $request->input('number');
            $customer->twitter = $request->has('twitter') ? $request->input('twitter') : null;
            $customer->facebook = $request->has('facebook') ? $request->input('facebook') : null;
            $customer->instagram = $request->has('instagram') ? $request->input('instagram') : null;
            $customer->address = $request->has('address') ? $request->input('address') : null;
            $customer->remark = $request->has('remark') ? $request->input('remark') : null;
            $customer->updated_at = $now;
            $customer->save();

            return redirect('cms/customers/' . $customer->id);
//            return response()->json(['success'=>true, 'redirect'=>url('/cms/customers/'.$customer->id)]);
        } catch (\Exception $e) {
            \Log::error($e);
            throw new \Exception('Cant Create Customer');
        }

        return redirect('cms/customers/create');
//        return response()->json(['success'=>false, 'redirect'=>url('/cms/customers/create')]);
    }


    public function edit($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            abort(404);
        }
        $data = [
            'customer' => $customer,
            'order' => []
        ];

        return view('cms.customers.edit')->with($data);
    }


    public function create()
    {
        return view('cms.customers.create');
    }

    public function index()
    {

        $header = ['id', 'name', 'email', 'phone', 'Precess'];
        $customers = Customer::orderBy('id', 'ASC')
            ->paginate(30);

        $data = [
            'header' => $header,
            'customers' => $customers,
        ];


        return view('cms.customers.index')->with($data);
    }

    public function destroy($id)
    {
        $customer = Customer::whereId($id)->first();

        if (!$customer) {
            abort(404);
        }

        try {
            $customer::whereId($id)->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect('cms/customers/' . $id);
        }

        return redirect('cms/customers/');
    }
}
