<?php


namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Models\Order;
use http\Env\Response;

class ProductController extends Controller
{
    public function index (Request $request)

    { 
        $products = Product::all(); 

      
        return view('notes.payment.payment-index', compact('products'));
}

public function checkout()
{
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $products = Product::all();
        $lineItems = [];
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice += $product->price;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'huf',
                    'product_data' => [
                        'name' => $product->name,
                        'images' => [$product->image]
                        //we might have to comment the image line for stripe to no complain
                    ],
                    'unit_amount' => $product->price * 100,
                    //times 100 because we cant 
                ],
                'quantity' => 1,
            ];
        }
        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('notes.payment.checkout-success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true),
        ]);
//here we are associating a session id with a user
        $order = new Order();
        $order->status = 'unpaid';
        $order->total_price = $totalPrice;
        $order->session_id = $session->id;
        $order->save();

        return redirect($session->url);
}

public function success(Request $request) {

    return view('notes.payment.checkout-success');
}


}
