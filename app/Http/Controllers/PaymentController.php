<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SiteController;
use App\Mail\BookingConfirmation;
use App\Models\Site;
use Redirect;
use Session;
use Mail;

class PaymentController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Dubai');
        // date_default_timezone_set('Asia/Kolkata');
        $site = new Site();
        $emirates = $site->getEmirates();
        $layoutCarTypes = $site->getCarType();
        $country = $site->getCountry();
    
        view()->share('emirates', $emirates);
        view()->share('country', $country);
        view()->share('layoutCarTypes', $layoutCarTypes);
    }

    public function initiatePayment(Request $request)
    {
        $siteController = new SiteController();
        $credentials = Session::get('bookingDetails');
        $rateData = $siteController->calculateRate($credentials);

        $data = [
            "method" => "create",
            "store" => config('constants.TELR_STORE_ID'),
            "authkey" => config('constants.TELR_AUTH_KEY'),
            "framed" => 0,
            "order" => [
                "cartid" => uniqid(),
                "test" => "1",
                "amount" => $rateData['total'],
                "currency" => "AED",
                "description" => "My purchase"
            ],
            "return" => [
                "authorised" => url('/payment/success'),
                "declined" => url('/payment/failure'),
                "cancelled" => url('/payment/cancel')
            ]
        ];

        $response = Http::withOptions([
            'verify' => false,
        ])->withHeaders([
            'Content-Type' => 'application/json',
            'accept' => 'application/json',
        ])->post('https://secure.telr.com/gateway/order.json', $data);


        if ($response->successful()) {
            Session::put('transactionStatus', 'Started');
            $responseData = $response->json();
            return redirect($responseData['order']['url']);
        } else {
            dd($response->status(), $response->body());
        }
    }

    public function paymentSuccess(Request $request)
    {
        if(Session::has('transactionStatus')){
            Session::forget('transactionStatus');
            $site = new Site();
            $siteController = new SiteController();
            $credentials = Session::get('bookingDetails');
            $rateData = $siteController->calculateRate($credentials);
            $credentials['rate'] = $rateData['total'];
            $credentials['vat'] = $rateData['vat'];
            $credentials['emirate'] = $rateData['emirate'];
            $credentials['totalRate'] = $rateData['rate'];
            $credentials['deposit'] = $rateData['deposit'];
            $credentials['babySeat'] = $rateData['babySeat'];
            $credentials['status'] = 'success';
            $credentials['transaction_time'] = now();
            $bookingCheck = $site->checkCarBooking($credentials);
            if(!$bookingCheck){
                $res = $site->saveBookingData($credentials);
                if($res){
    
                    $data['id'] = $credentials['userId'];
                    $userData = $site->getMyDetails($data);
                    if($userData){
                        $credentials['user_data'] = $userData;
                        $credentials['bookingId'] = $res;
                        Mail::to($userData[0]->email)->send(new BookingConfirmation((object)$credentials,'user'));
                        // Mail::to(config('constants.ADMIN_EMAIL'))->send(new BookingConfirmation((object)$credentials,'admin'));
                    }
                }else{
                    $data['message'] = 'Transaction Success but Booking Failed';
                    return view('/payment/failure',$data);
                }
                return view('/payment/success',$credentials);
            }else{
                $data['message'] = 'Transaction Success but Booking not possible';
                return view('/payment/failure',$data);
            }
            
        }else{
            return Redirect::to('/home');
        }
    }

    public function paymentFailure(Request $request)
    {
        Session::forget('transactionStatus');
        $data['message'] = 'Payment failure';
        return view('/payment/failure',$data);
    }
}
