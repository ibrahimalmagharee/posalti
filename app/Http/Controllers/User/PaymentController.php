<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Stripe;
use Session;

class PaymentController extends Controller{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('is_user');
        $this->middleware('lang');
    }

    public function index(){
        $links = \App\Models\Social::all();
        $amount = \Auth::user()->last_financial()->value;
        return view('user.payment', compact(['links', 'amount']));
    }

    public function guidv4($data = null){
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public function generate_random_letters($length){
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= chr(rand(ord('a'), ord('z')));
        }
        return $random;
    }

    public function store(Request $request){
        $last_financial = \Auth::user()->last_financial();

        if($last_financial->status){
            return redirect()->back()->withErrors(['message'=> Lang::get('content.Already paid')]);
        }

        $uniqueid = $this->generate_random_letters(6);
        $myuuid = $this->guidv4();
        // $secretkey = "//BCt096F5ZaWOZNdU9P448JQquGy5n1w7qGlSrgQ1TxN9vDBVIsD/uLWEauz5UYbGcWXfhkWtdp4B27w4oeDHRcOFyG2JNcco5ik2dYsh9YHw6i320RiAJcB+lMwxZFqX0SwmiCmmpv48cbRMJ0yY8BU9gkVZVPsfRGAABvHSkLufijjz4GLOk1AyGStbaW86pvIlEf0QU84XEAP06WH906zKjJ30ZcZiCo2scCXDM/kTe4wC6KNZ4xYZGQByu8Hxt3HNdzTUCYCOPri3PfLrgetOAULBC4YbYyijFkgSzswCnjDrU5MZnqynRQZuwXqUZuGx8EKU/tTziILjxy06sd28goy7jUtDtueSZZ713OpjDz7XukFT5POb0CIgg2bo3YYpXOlIjbKfOOpsFTpyy7n3aQIc2M6ygw8DsJS/ivJoGpObHIxewe5yJZ66U6muwwX4ke2REoAEoT/59C29uTvc+PYqmCkPbsEOQsf6/Igy/AJApKtpXFmD7p3LxhWsSd3euux2CskOvkogCS/w==";
        $secretkey = "AK4EqSNHz7MViVa0c6ix3GOq7NIX1t7aK02AQUbGPa9TJs/zwC1x4RN8i4QhvY/j887BBYHoVYsyoXv8FtwKVNIonhSDyJ/fWTjuqaBdlSPlQdVNWgD0qtA1so5IYhnw+h0VV77ldC3zyL1XM3nlTYgBQmCmIvdXbpFsX9cjmdinn1kFVmoW3hmdFwjTV0QRPz7PkuX5enilHQcVGghZ2MP7eRYBb9uLvc+r8R6FGcSKr4rQoJW7A0JK0jzSGEAz3VH0M6454ugS/NuHJSmNyFrzSxzGAz2mSVbh0wGdMrMTPYZ3NPIM1w12Pv/t8rM5u10l/pDRqjn6yCwWlOiMqC8qOPMitjJ1c+Rrn0hCrIzGIxnVlACom9B+4o4cZxnZHRihU6EmPHtRxrRXIItmUKffgAsIgFv5GgGzyO9JrA2bY9Zh7vU63nSKcZxYpsWMvMxmLHUy7XdrOlNa7rI/YOqU+muNsrwmC1YA4/0XvIC1a+ciyzeGSyxpd9QYMiSRWdkTU21hJl7r9UD0ATRI5g==";
        $data = [];
        // 4444333322221111
        $data['Uid'] = $myuuid;
        // $data['KeyId'] = "0b287af6-49ee-4d9e-ad62-1205e2c58dba";
        $data['KeyId'] = "e17633fc-b072-4875-b56a-c8522b4decb7";
        $data['Amount'] = strval($last_financial->value);
        $data['FirstName'] = \Auth::user()->name;
        $data['LastName'] = "bawsalti";
        $data['Phone'] = "0000000000";
        $data['Email'] = \Auth::user()->email;
        $data['TransactionId'] = $uniqueid;
        $data_string = json_encode($data);
        $resultheader = "Uid=" . $data['Uid'] . ',KeyId=' . $data['KeyId'] . ',Amount=' . $data['Amount'] . ',FirstName=' . $data['FirstName'] . ',LastName=' . $data['LastName'] . ',Phone=' . $data['Phone'] . ',Email=' . $data['Email']. ',TransactionId=' . $data['TransactionId'];

        $s = hash_hmac('sha256', $resultheader, $secretkey, true);
        $authorisationheader = base64_encode($s);
        $curl = curl_init();

        $sandboxAPI = "https://skipcashtest.azurewebsites.net/api/v1/payments";
        $productionAPI = "https://api.skipcash.app/api/v1/payments";

        curl_setopt_array($curl, array(
            CURLOPT_URL => $productionAPI,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_HTTPHEADER => array(
                'Content-Type:application/json', 'Authorization:' . $authorisationheader
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);

        $result = $response['resultObj'];
        $payUrl = $result['payUrl'];

        return Redirect::to($payUrl);
    }

    public function check_payment(Request $request){

        $id =  $_GET['id']; // get Id from URL after redirected.

        $curl = curl_init();
        $clientId = "e536d43a-193a-4ea9-bed7-5ef5a131b841";

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.skipcash.app/api/v1/payments/" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type:application/json', 'Accept: application/json', 'Authorization: ' . $clientId
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        if(isset($response['resultObj'])){
            if($response['resultObj']['statusId'] == 2 && $response['resultObj']['status'] == "paid"){

                $financial_user = \App\Models\Financial::where('user_id', \Auth::user()->id)->get()->last();
                $financial_user->status = 1;
                $financial_user->type_payment = 'credit';
                $financial_user->payment_created_at = now();
                $financial_user->save();

                return redirect()->route('index.payment.checked_payment')->withSuccess(Lang::get('content.Payment completed successfully'));

            }else{
                return redirect()->route('index.payment.checked_payment')->withErrors(Lang::get('content.Payment process error, please check the process again or check with management'));
            }
        }else{
            return redirect()->route('index.payment.checked_payment')->withErrors(Lang::get('content.Payment process error, please check the process again or check with management'));
        }
    }

    public function index_checked_payment(){
        $links = \App\Models\Social::all();
        return view('user.check-payment', compact('links'));
    }
}
