<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Package;

class PaymentController extends Controller
{
    
    public function process(Request $request) {
        $package = Package::get();
        $data = $request->all();

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'product_id' => Package::where('id', '2')->first()->id,
            'price' => Package::where('id', 2)->first()->price,
            'status' => 'pending',
        ]);

        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $transaction['price'],
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->firstname,
                'last_name' => Auth::user()->lastname,
                'email' => Auth::user()->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;
        $transaction->save();

        return redirect()->route('payment.details', ['transaction' => $transaction->id]);
    }

    public function checkout(Transaction $transaction) {
        $products = config('products');
        $product = collect($products)->firstWhere('id', $transaction->product_id);

        return view('payment.checkout', compact('transaction', 'product'));
    }

    public function success(Transaction $transaction) {
        $user = Auth::user();
        $transaction->status = 'success';
        $user->tier = 'pro';
        $user->save();
        $transaction->save();

        return view('payment-success');
    }

    public function showDetails(Transaction $transaction)
    {
        return view('payment', compact('transaction'));
    }

}
