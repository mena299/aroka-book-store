<?php

namespace App\Http\Controllers\cms;

use App\Http\Classes\BasicData;
use App\Imports\OrderImport;
use App\Mail\Tracking;
use App\Model\Customer;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\OrderTransfer;
use App\Model\Product as Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{

    public function uploadWixOrder(Request $request)
    {
        $excel = Excel::toArray(new OrderImport(), $request->file('order'));

        $orders_raw = [];

        /*
            0"Timestamp",
            1"Entry ID",
            2"Email",
            3"phone_number",
            4"Customer Name",
            5"Social Account",
            6"order_number",
            7"amount1",
            8"amount2",
            9"bank",
            10"transfer_date",
            11"Customer Remark",
            12"Staff Remark",
            13"Order Status",
            14"is_pre_order",
            15"Products",
            16"qty",
            17"Shipping Type",
            18"Transporter",
            19"Date of Shipping",
            20"Tracking No",
            21"Shipping Fee",
            22"customer_address"
        */

//        return $excel[0];

        foreach ($excel[0] as $keyO => $csv_orders) {
            if ($keyO <= 0) {
                continue;
            }

            foreach ($csv_orders as $keyOrder => $csv_order) {
                switch ($keyOrder) {
                    case 0 :
                        $order['order_date'] = Carbon::createFromFormat('d/m/Y H:i:s',$csv_order)->toDateTimeString();
                        break;
//                case 1 :
//                    $order['order_no'] = $csv_orders;
//                    break;
                    case 2 :
                        $order['email'] = $csv_order;

                        if ($csv_order == 'aroka.contact@gmail.com') {
                            break;
                        }

                        $order['customer_phone_number'] = $csv_order;
                        $customer = Customer::where('email', '=', $csv_order)->first();
                        if ($customer !== null) {
                            $order['customer_id'] = $customer->id;
                            $order['customer_email'] = $customer->email;
                            $order['customer_phone_number'] = $customer->phone_number;
                        }
                        break;
                    case 3 :
                        $order['phone_number'] = $csv_order;

                        if (isset($csv_order)) {
                            $customer = Customer::where('phone_number', '=', $csv_order)->first();
                            if ($customer !== null) {
                                $order['customer_id'] = $customer->id;
                                $order['customer_email'] = $customer->email;
                                $order['customer_phone_number'] = $customer->phone_number;
                            }
                        }
                        break;
                    case 4 :
                        $order['shipping_name'] = $csv_order;
                        break;
                    case 5 :

                        if (isset($csv_order)) {

                            $sns = explode('@', $csv_order);
                            $customer = null;

                            if (isset($sns[0])  && $sns[0] == 'tw') {
                                $order['customer_phone_number'] = $csv_order;
                                $customer = Customer::where('twitter', 'LIKE', "%$sns[1]%")->first();
                            }elseif (isset($sns[0])  && $sns[0] == 'fb') {
                                $order['customer_phone_number'] = $csv_order;
                                $customer = Customer::where('facebook', 'LIKE', "%$sns[1]%")->first();
                            }

                            if ($customer !== null) {
                                $order['customer_id'] = $customer->id;
                                $order['customer_email'] = $customer->email;
                                $order['customer_phone_number'] = $customer->phone_number;
                            }

                        }

                        break;
                    case 6 :
                        $order['order_no'] = $csv_order;
                        break;
                    case 7 :
                        $order['transfer_amount'] = $csv_order;
                        break;
//                case 8 :
//                    $order[''] = $csv_orders;
//                    break;
                    case 9 :
                        $order['bank'] = $csv_order;
                        break;
                    case 10 :
                        $order['transfer_date'] = Carbon::createFromFormat('d/m/Y H:i:s',$csv_order)->toDateTimeString();

                        break;
                    case 11 :
                        $order['customer_remark'] = $csv_order;
                        break;
                    case 12 :
                        $order['staff_remark'] = $csv_order;
                        break;
                    case 13 :
                        $order['order_status'] = $csv_order;
                        break;
                    case 14 :
                        $order['is_pre_order'] = $csv_order;
                        break;
                    case 15 :
                        $products = explode(',', $csv_order);

                        foreach ($products as $skuqty) {
                            $sku = Str::before($skuqty, '_qty_');
                            $product_data = Product::where('sku', $sku)->select('id', 'price')->first();

                            if (!$product_data) {
                                return "SKU $sku not found";
                            }

                            $order['products']['product_id'][] = $product_data->id;
                            $order['products']['price'][] = $product_data->price;
                            $order['products']['qty'][] = Str::after($skuqty, '_qty_');
                        };

                        break;
                    case 16 :
                        $order['shipping_type'] = $csv_order;
                        break;
                    case 17 :
                        $order['transporter'] = Str::lower($csv_order);
                        break;
                    case 18 :
                        $order['date_of_shipping'] = isset($csv_order) ? Carbon::createFromFormat('d/m/Y', $csv_order)->toDateString() : null;
                        break;
                    case 19 :
                        $order['tracking_no'] = $csv_order;
                        break;
                    case 20 :
                        $order['shipping_fee'] = $csv_order;
                        break;
                    case 21 :
                        $order['shipping_address'] = $csv_order;
                        break;
                }
            }


            $orders[$keyO] = $order;
            $order = null;
        }

//          return $orders;

        $error = [];
        \DB::beginTransaction();
        try {
            foreach ($orders as $key => $value) {
                if (!isset($value['customer_id'])) {
                    $error[$key] = $value;
                    continue;
                }

                $new_order = New Order();
                $new_order->customer_id = $value['customer_id'];
                $new_order->shipping_name = $value['shipping_name'];
                $new_order->customer_remark = $value['customer_remark'] ?? null;
                $new_order->staff_remark = $value['staff_remark'] ?? null;;
                $new_order->status = Str::lower($value['order_status']);
                $new_order->shipping_type = Str::lower($value['shipping_type']);
                $new_order->shipping_fee = $value['shipping_fee'] ?? 0;
                $new_order->shipping_datetime = $value['date_of_shipping'];
                $new_order->tracking = $value['tracking_no'] ?? null;
                $new_order->full_price = $value['transfer_amount'] ?? null;
                $new_order->discount = 0;
                $new_order->net_price = $value['transfer_amount'];
                $new_order->shipping_address = $value['shipping_address'] ?? null;
                $new_order->created_at = Carbon::parse($value['order_date'])->toDateTimeString();
                $new_order->updated_at = Carbon::now();
                $new_order->is_preorder = $value['is_pre_order'] == 1 ? 'Y' : 'N';
                $new_order->old_order_id = 'ecwid_' . $value['order_no'];
                $new_order->transporter = $value['transporter'];
                $new_order->save();

                $new_transfer = New OrderTransfer();
                $new_transfer->order_id = $new_order->id;
                $new_transfer->customer_email = $value['customer_email'] ?? null;
                $new_transfer->customer_phone_number = $value['customer_phone_number'] ?? null;
                $new_transfer->amount = $value['transfer_amount'] ?? 0;
                $new_transfer->transfer_date = $value['transfer_date'] ?? null;
                $new_transfer->bank_name = $value['bank'] ?? null;
                $new_transfer->created_at = Carbon::parse($value['transfer_date'])->toDateTimeString();
                $new_transfer->updated_at = Carbon::now();
                $new_transfer->save();

                foreach ($value['products']['product_id'] as $keyP => $product) {
                    $new_order_product = new OrderProduct();
                    $new_order_product->order_id = $new_order->id;
                    $new_order_product->product_id = $product;
                    $new_order_product->full_price = $value['products']['price'][$keyP] * $value['products']['qty'][$keyP];
                    $new_order_product->discount = 0;
                    $new_order_product->net_price = $value['products']['price'][$keyP] * $value['products']['qty'][$keyP];
                    $new_order_product->created_at = $value['order_date'];
                    $new_order_product->updated_at = Carbon::now();
                    $new_order_product->quantity = $value['products']['qty'][$keyP];
                    $new_order_product->product_fee = 0;
                    $new_order_product->shipping_fee = 0;
                    $new_order_product->auther_amount = 0;
                    $new_order_product->save();
                }
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw  $e;
        }

        if (count($error) == 0) {
            return redirect('cms/orders/list?status=success');
        }
        return ['error' => $error];
    }

    public function uploadDSOTMPreOrder(Request $request)
    {

//        $excel = Excel::import(new OrderImport(), $request->file('order'));
        $excel = Excel::toArray(new OrderImport(), $request->file('order'));

        $data = [];

        /*
        0 : No
         1 : Date
         2 : สถานะการโอน order status
         3 : ชือ สำหรับจัดส่ง name
         4 : เสี้ยวรักฯ dust of the wind
         5 : เสี้ยวใจฯ dark side of the moon
         6 : Twitter Account
         7 : จำนวนเงินที่โอน transfer amount
         8 : ธนาคารที่โอน bank
         9 : วันที่เวลาที่โอน date of transfer
         10 : เบอร์ติดต่อ phone number
         11 : ที่อยู่การจัดส่ง shipping address
         12 : หมายเหตุ customer remark
         13 : ประเภทการจัดส่ง shipping type
         14 : วันที่จัดส่ง date of shipping
         15 : หมายเลขพัสดุ tracking number
         16 : Box Size
        */

        foreach ($excel[0] as $key => $orders) {
            $e = [];
            if ($key <= 2) {
                continue;
            }
            foreach ($orders as $keyOrder => $order) {
                switch ($keyOrder) {
                    case 0 :
                        $e['order_no'] = "pre_dsotm-$order";
                        $e['no'] = $order;
                        break;
                    case 1 :
                        $e['order_date'] = Carbon::createFromFormat('m/d/Y', $order)->toDateString();
                        break;
                    case 2 :
                        $e['order_status'] = 'done';
                        break;
                    case 3 :
                        $e['shipping_name'] = $order;
                        break;
                    case 4 : //dust in the wind
                        if ($order != 0) {
                            $e['products']['product_id'][] = 2;
                            $e['products']['price'][] = 560;
                            $e['products']['qty'][] = $order;

                        }
                        break;
                    case 5 : //dark side of the moon
                        if ($order != 0) {
                            $e['products']['product_id'][] = 3;
                            $e['products']['price'][] = 900;
                            $e['products']['qty'][] = $order;
                        }
                        break;
                    case 6 :
                        $e['twitter_account'] = $order;

                        if ($order === null) {
                            break;
                        }

                        $order = str_replace('@', '', $order);
                        $customer = Customer::where('twitter', 'LIKE', "%$order%")->first();

                        if ($customer) {
                            $e['customer_id'] = $customer->id;
                            $e['customer_email'] = $customer->email;
                            $e['customer_phone_number'] = $customer->phone_number;
                        }

                        break;
                    case 7 :
                        $e['transfer_amount'] = $order;
                        break;
                    case 8 :
                        $e['transfer_bank'] = $order;
                        break;
                    case 9 :
                        $e['transfer_date'] = Carbon::parse($order)->toDateTimeString();
                        break;
                    case 10 :
                        $e['phone_number'] = $order;
                        $customer = Customer::where('phone_number', "$order")->first();

                        if ($customer) {
                            $e['customer_id'] = $customer->id;
                            $e['customer_email'] = $customer->email;
                            $e['customer_phone_number'] = $customer->phone_number;
                        }
                        break;
                    case 11 :
                        $e['shipping_address'] = $order;
                        break;
                    case 12 :
                        $e['customer_remark'] = $order;
                        break;
                    case 13 :
                        $e['shipping_type'] = Str::lower($order);
                        break;
                    case 14 :
                        $e['date_of_shipping'] = isset($order) ? Carbon::createFromFormat('m/d/Y', $order)->toDateString() : null;
                        break;
                    case 15 :
                        $e['tracking_number'] = $order;
                        break;
                }
            }
            $data[$key] = $e;
            $e = [];
        }
        $error = [];

        return $data;

        \DB::beginTransaction();
        try {
            foreach ($data as $key => $value) {
                if (!isset($value['customer_id'])) {
                    $error[$key] = $value;
                    continue;
                }

                $new_order = New Order();
                $new_order->id = $value['no'];
                $new_order->customer_id = $value['customer_id'];
                $new_order->shipping_name = $value['shipping_name'];
                $new_order->customer_remark = $value['customer_remark'] ?? null;
                $new_order->staff_remark = null;
                $new_order->status = $value['order_status'];
                $new_order->shipping_type = $value['shipping_type'];
                $new_order->shipping_fee = 0;
                $new_order->shipping_datetime = $value['date_of_shipping'];
                $new_order->tracking = $value['tracking_number'] ?? null;
                $new_order->full_price = $value['transfer_amount'] ?? null;
                $new_order->discount = 0;
                $new_order->net_price = $value['transfer_amount'];
                $new_order->shipping_address = $value['shipping_address'] ?? null;
                $new_order->created_at = $value['order_date'];
                $new_order->updated_at = Carbon::now();
                $new_order->is_preorder = 'N';
                $new_order->old_order_id = $value['order_no'];
                $new_order->transporter = 'Thai Post';
                $new_order->save();

                $new_transfer = New OrderTransfer();
                $new_transfer->order_id = $new_order->id;
                $new_transfer->customer_email = $value['customer_email'] ?? null;
                $new_transfer->customer_phone_number = $value['phone_number'] ?? null;
                $new_transfer->amount = $value['transfer_amount'] ?? 0;
                $new_transfer->transfer_date = $value['transfer_date'] ?? null;
                $new_transfer->bank_name = isset($value['transfer_bank']) ? str_replace('\t', '', $value['transfer_bank']) : null;
                $new_transfer->created_at = $value['transfer_date'];
                $new_transfer->updated_at = Carbon::now();
                $new_transfer->save();

                foreach ($value['products']['product_id'] as $keyP => $product) {
                    $new_order_product = new OrderProduct();
                    $new_order_product->order_id = $new_order->id;
                    $new_order_product->product_id = $product;
                    $new_order_product->full_price = $value['products']['price'][$keyP] * $value['products']['qty'][$keyP];
                    $new_order_product->discount = 0;
                    $new_order_product->net_price = $value['products']['price'][$keyP] * $value['products']['qty'][$keyP];
                    $new_order_product->created_at = $value['order_date'];
                    $new_order_product->updated_at = Carbon::now();
                    $new_order_product->quantity = $value['products']['qty'][$keyP];
                    $new_order_product->product_fee = 0;
                    $new_order_product->shipping_fee = 0;
                    $new_order_product->auther_amount = 0;
                    $new_order_product->save();
                }
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw  $e;
        }

        return ['error' => $error];
    }

    public function viewOrder($order_id)
    {
        $data = ['order_id' => $order_id];
        return view('cms.orders.detail')->with($data);
    }

    public function trackingSendMail(Request $request, $order_id)
    {
        $order_data = Order::where('orders.id', $order_id)
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
            ->select()
            ->get();

        $orders = [];
        foreach ($order_data as $od) {

            $orders['order_id'] = $od->id;
            $orders['old_order_id'] = $od->old_order_id;
            $orders['customer_name'] = $od->shipping_name;
            $orders['email'] = $od->email;
            $orders['phone_number'] = $od->phone_number;
            $orders['status'] = $od->status;
            $orders['shipping_type'] = $od->shipping_type;
            $orders['price'] = $od->net_price;
            $orders['is_preorder'] = $od->is_preorder;
            $orders['transporter'] = $od->transporter;
            $orders['staff_remark'] = $od->staff_remark;
            $orders['tracking'] = $od->tracking;
            $orders['transporter_id'] = isset($od->transporter) ? array_search($od->transporter, BasicData::transporter()) : 0;
            $orders['shipping_date'] = isset($od->shipping_datetime) ? Carbon::parse($od->shipping_datetime)->toDateString() : null;
            $orders['products'][] = $od->title_th;
        }

        $parcelLink = BasicData::checkParcelLink();
        $link = $parcelLink[$orders['transporter']] ?? null;

        if (Str::lower($orders['transporter']) == 'kerry') {
            $link = $link . '?track=' . $orders['tracking'];
        }

        $meta = [
            'book_name' => collect($orders['products'])->join(',') ?? null,
            'ecwid_order_id' => isset($orders['old_order_id']) ? Str::after($orders['old_order_id'], 'ecwid_') : null,
            'date_of_shipping' => $orders['shipping_date'] ?? null,
            'box_amount' => 1,
            'transporter' => $orders['transporter'] ?? null,
            'shipping_type' => $orders['shipping_type'] ?? null,
            'tracking_number' => $orders['tracking'] ?? null,
            'remark' => $orders['staff_remark'] ?? null,
            'check_link' => $link
        ];

        try {
            if (isset($orders['email'])) {
                Mail::to($orders['email'])->send(new Tracking($meta));
            }

            return redirect('cms/orders/list');
        } catch (\Exception $e) {
            throw $e;
        }
        return ['status' => false, 'meta_data' => $meta];
    }

    public function updateTracking(Request $request)
    {
        $order_id = $request->input('order_id');
        $order = Order::whereId($order_id)->first();

        if (!$order) {
            abort(404);
        }

        try {
            $transporter_data = BasicData::transporter();
            $transporter = $request->input('transporter');

            $order->tracking = $request->input('tracking') ?? null;
            $order->transporter = $transporter <> 0 ? $transporter_data[$transporter] : null;
            $order->updated_at = Carbon::now();
            $order->save();
        } catch (\Exception $e) {
            throw $e;
        }

        return redirect('cms/orders/list?status=success');

    }

    public function index(Request $request)
    {
        $data = array();

        $search = $request->has('search') ? $request->input('search') : null;

        $header = ['Order Id', 'Old Order Id', 'Customer Name', 'Email', 'Phone', 'Products', 'Status', 'Price', 'Is PreOrder', 'Shipping Type', 'Tracking', 'Transporter', 'Process'];

        $order_data = Order::join('order_products', 'order_products.order_id', '=', 'orders.id')
            ->leftJoin('products', 'products.id', '=', 'order_products.product_id')
            ->leftJoin('customers', 'customers.id', '=', 'orders.customer_id')
            ->select('orders.*', 'products.title_th', 'customers.email', 'customers.phone_number');

        if ($search) {
            $order_data = $order_data->orWhere('orders.old_order_id', 'LIKE', "%$search%")
                ->orWhere('orders.shipping_name', 'LIKE', "%$search%")
                ->orWhere('orders.tracking', 'LIKE', "%$search%")
                ->orWhere('customers.phone_number', 'LIKE', "%$search%")
                ->orWhere('customers.email', 'LIKE', "%$search%");
        }

        $order_data = $order_data->orderBy('id', 'desc')->paginate(15);


        $orders = [];

        foreach ($order_data as $od) {

            $orders[$od->id]['order_id'] = $od->id;
            $orders[$od->id]['old_order_id'] = $od->old_order_id;
            $orders[$od->id]['customer_name'] = $od->shipping_name;
            $orders[$od->id]['email'] = $od->email;
            $orders[$od->id]['phone_number'] = $od->phone_number;
            $orders[$od->id]['status'] = $od->status;
            $orders[$od->id]['shipping_type'] = $od->shipping_type;
            $orders[$od->id]['price'] = $od->net_price;
            $orders[$od->id]['is_preorder'] = $od->is_preorder;
            $orders[$od->id]['transporter'] = $od->transporter;
            $orders[$od->id]['tracking'] = $od->tracking;
            $orders[$od->id]['transporter_id'] = isset($od->transporter) ? array_search($od->transporter, BasicData::transporter()) : 0;
            $orders[$od->id]['shipping_date'] = isset($od->shipping_datetime) ? Carbon::parse($od->shipping_datetime)->toDateString() : null;
            $orders[$od->id]['products'][] = $od->title_th;
        }


        foreach ($orders as $key => $or) {
            if (isset($or['products'])) {
                $orders[$key]['products'] = collect($or['products'])->join(',');
            }
        }


        $data = [
            'header' => $header,
            'orders' => $orders,
            'order_data' => $order_data,
            'transporter' => BasicData::transporter()
        ];

        return view('cms.orders.index')->with($data);

    }
}
