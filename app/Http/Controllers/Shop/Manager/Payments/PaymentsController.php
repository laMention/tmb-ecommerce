<?php

namespace App\Http\Controllers\Shop\Manager\Payments;

use App\Http\Controllers\Shop\Manager\Payments\IyZico\IyZicoController;
use App\Http\Controllers\Shop\Manager\Payments\Paypal\PaypalController;
use App\Http\Controllers\Shop\Manager\Payments\Stripe\StripePaymentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Shop\Manager\Payments\Paytm\PaytmPaymentController;
use App\Http\Controllers\Shop\Manager\Payments\Razorpay\RazorpayController;
use App\Models\OrderGroup;

class PaymentsController extends Controller
{
    # init payment gateway
    public function initPayment()
    {
        $payment_method = session('payment_method');
        if ($payment_method == 'paypal') {
            return (new PaypalController())->initPayment();
        } else if ($payment_method == 'stripe') {
            return (new StripePaymentController())->initPayment();
        } else if ($payment_method == 'paytm') {
            return (new PaytmPaymentController())->initPayment();
        } else if ($payment_method == 'razorpay') {
            return (new RazorpayController())->initPayment();
        } else if ($payment_method == 'iyzico') {
            return (new IyZicoController)->initPayment();
        }
        # todo::[update versions] more gateways
    }

    # payment successful
    public function payment_success($payment_details = null)
    {
        if (session('payment_type') == 'order_payment') {
            return (new CheckoutController())->updatePayments(json_encode($payment_details));
        }
        # else - other payments [update versions]
    }

    # payment failed
    public function payment_failed()
    {
        if (session('payment_type') == 'order_payment') {
            $orderGroup = OrderGroup::where('order_code', session('order_code'))->first();
            if (getSetting('enable_cod') == 1) {
                $orderGroup->payment_method = "cod";
                $orderGroup->save();
                # order success 
                clearOrderSession();
                flash(localize('Payment failed, Please pay in cash on delivery'))->success();
                return getView('pages.checkout.invoice', ['orderGroup' => $orderGroup]);
            } else {
                # delete order
                $orderGroup->order->orderItems()->delete();
                $orderGroup->order()->delete();
                $orderGroup->delete();
                clearOrderSession();
                flash(localize('Payment failed, please try again'))->error();
                return redirect()->route('home');
            }
        }
    }
}
