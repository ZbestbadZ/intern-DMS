<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function store(OrderRequest $request)
    {
        $data = $request->only(['cus_phone', 'cus_name', 'cus_address', 'note']);
        $products = $request->input('products', []);
        $quantities = $request->input('quantities', []);

        $productIds = collect($products)->pluck('id')->toArray();
        $totalPrice = 0;

        DB::beginTransaction();
        $listProduct = Product::whereIn('id', $productIds)->lockForUpdate()->get();
        try {
            $order = Order::create($data);

            foreach ($products as $productData) {
                $product = $listProduct->where('id', $productData->id)->first();

                if (empty($product)) {
                    return $this->responseError('Not found product!');
                }

                $quantity = $quantities[$productData];

                if ($productData->quantity_in_stock - $quantity < 0) {
                    return $this->responseErrors('Quantities exceeded quantities in stock!');
                }

                $price = $productData->price;
                $totalPrice += $productData->price * $quantity;

                OrderDetail::create([
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'price' => $price,
                    'quantity' => $quantity,
                ]);

                $product->update([
                    'quantity_in_stock' => $productData->quantity_in_stock - $quantity,
                ]);
            }

            $order->update(['total_price' => $totalPrice]);
            $orderDetails = OrderDetail::where('order_id', $order->id)->with('products')->get();
            $order['order_details'] = $orderDetails;

            DB::commit();

            return $this->responseWithMessage(compact('order'));
        } catch (Exception $ex) {
            DB::rollBack();
            return $this->responseErrorWithMessage('Error', $ex);
        }
    }
}