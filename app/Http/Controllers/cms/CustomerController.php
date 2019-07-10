<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer as CustomerRequest;
use App\Model\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        } catch (\Exception $e) {
            \Log::error($e);
            throw $e;
        }

        return redirect('cms/customers/create/list');
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

    public function index(Request $request)
    {

        $search = $request->has('search') ? $request->input('search') : null;
        $header = ['ID', 'Name', 'Email', 'Phone','Remark', 'Precess'];
        $customers = Customer::orderBy('id', 'ASC');

        if ($search !== null) {
            $customers = $customers->where('name', 'LIKE', "%$search%")
                ->orWhere('twitter', 'LIKE', "%$search%")
                ->orWhere('facebook', 'LIKE', "%$search%")
                ->orWhere('instagram', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('phone_number', 'LIKE', "%$search%")
                ->orWhere('remark', 'LIKE', "%$search%");
        }

        $customers = $customers->paginate(30);

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
