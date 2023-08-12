<?php

namespace App\Http\Controllers\Shop\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SystemSetting;
use App\Mail\EmailManager;
use App\Models\Currency;
use App\Models\Shop;
use Artisan;
use Mail;

class SettingsController extends Controller
{
    # construct
    public function __construct()
    {
        $this->middleware(['permission:edit_shop'])->only('index');
        $this->middleware(['permission:smtp_settings'])->only('smtpSettings');
        $this->middleware(['permission:payment_settings'])->only(['paymentMethods', 'updatePaymentMethods']);
    }

    # admin general settings
    public function index()
    {
        return view('shop.vendor.pages.systemSettings.general');
    }


    # smtp settings
    public function smtpSettings()
    {
        return view('shop.vendor.pages.systemSettings.smtp');
    }

    # update env values
    public function envKeyUpdate(Request $request)
    {
        foreach ($request->types as $key => $type) {
            writeToEnvFile($type, $request[$type]);
        }
        flash(localize("Settings updated successfully"))->success();
        return back();
    }

    # test email
    public function testEmail(Request $request)
    {
        $array['view'] = 'emails.bulkEmail';
        $array['subject'] = "SMTP Test";
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = "This is a test email.";
        try {
            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e);
        }

        flash(localize('An email has been sent.'))->success();
        return back();
    }

    # update settings
    public function update(Request $request)
    {
        $shop = Shop::where('id',auth()->user()->shop_id)->first();
        
        $shop->shop_name = $request->shop_name;
        $shop->slug = strtolower(Str::slug($request->shop_name, '-'));

        $shop->shop_address = $request->shop_address;
        $shop->is_cash_payout = $request->is_cash_payout;
        $shop->shop_logo = $request->image;

        $shop->is_bank_payout = $request->is_bank_payout;

        $shop->bank_name = $request->bank_name;
        $shop->bank_acc_name = $request->bank_acc_name;
        $shop->bank_acc_no = $request->bank_acc_no;


        $shop->save();

        cacheClear();
        flash(localize("Settings updated successfully"))->success();
        return back();
    }

    # social login
    public function socialLogin()
    {
        return view('shop.vendor.pages.systemSettings.socialLogin');
    }

    # activation
    public function updateActivation(Request $request)
    {
        $setting = SystemSetting::where('entity', $request->entity)->first();
        if ($setting != null) {
            $setting->value = $request->value;
            $setting->save();
        } else {
            $setting = new SystemSetting;
            $setting->entity = $request->entity;
            $setting->value = $request->value;
            $setting->save();
        }
        cacheClear();
        return 1;
    }

    # admin payment Methods settings
    public function paymentMethods()
    {
        return view('shop.vendor.pages.systemSettings.paymentMethods');
    }

    # update payment methods
    public function updatePaymentMethods(Request $request)
    {
        foreach ($request->types as $type) {
            writeToEnvFile($type, $request[$type]);
        }

        foreach ($request->payment_methods as $payment_method) {
            if ($request->has(['enable_' . $payment_method])) {
                $activationSetting = SystemSetting::where('entity', 'enable_' . $payment_method)->first();
                $value = $request['enable_' . $payment_method];

                if ($activationSetting != null) {
                    $activationSetting->value = $value;
                    $activationSetting->save();
                } else {
                    $activationSetting = new SystemSetting;
                    $activationSetting->entity = 'enable_' . $payment_method;
                    $activationSetting->value = $value;
                    $activationSetting->save();
                }
            }

            if ($request->has($payment_method . '_sandbox')) {
                $setting = SystemSetting::where('entity', $payment_method . '_sandbox')->first();
                $value = $request[$payment_method . '_sandbox'];

                if ($setting != null) {
                    $setting->value = $value;
                    $setting->save();
                } else {
                    $setting = new SystemSetting;
                    $setting->entity = $payment_method . '_sandbox';
                    $setting->value = $value;
                    $setting->save();
                }
            }
        }

        cacheClear();
        flash(localize("Payment settings updated successfully"))->success();
        return back();
    }

    # auth  settings
    public function authSettings()
    {
        return view('shop.vendor.pages.systemSettings.authSettings');
    }

    # otp  settings
    public function otpSettings()
    {
        return view('shop.vendor.pages.systemSettings.otpSettings');
    }


    #infos general boutique
    public function generalInfo()
    {
        return view('shop.vendor.pages.shop.generalInfo');

    }



}
