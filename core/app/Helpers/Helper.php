<?php
use Illuminate\Http\Request;
use App\Models\Emailtemplate;
use App\Models\Settings;
use App\Models\Withdraw;
use App\Models\Currency;
use App\Models\User;
use App\Models\Deposits;
use App\Models\Banktransfer;
use App\Models\Logo;
use Twilio\Rest\Client;
use Carbon\Carbon;
use Curl\Curl;
use Illuminate\Support\Facades\Mail;


    function custom_email($type, $id)
    {
        $set=Settings::first();
        $currency=Currency::wherestatus(1)->first();
        $check=Emailtemplate::wheretype($type)->first();
        $from = env('MAIL_FROM_ADDRESS');
        if($check->type=="new_withdraw_request_user"){
            $val=Withdraw::whereid($id)->first();
            $user=User::whereid($val->user_id)->first();
            $find=array("{{amount}}", "{{charge}}", "{{first_name}}", "{{last_name}}", "{{username}}", "{{site_name}}", "{{site_email}}", "{{duration}}", "{{method}}", "{{details}}", "{{reference}}");
            $replace=array(number_format($val->amount, 2).$currency->name, number_format($val->charge, 2).$currency->name, $user->first_name, $user->last_name, $user->username, $set->site_name, $set->email, $val->wallet->period.' '.$val->wallet->duration, $val->wallet->method, $val->details, $val->reference);
            $text = str_replace($find, $replace, str_replace("{{message}}", $check->body, $set->email_template));
            $subject = str_replace($find, $replace, $check->subject);
            Mail::send([], [], function ($message) use($user, $subject, $from, $set, $text){
                $message->to($user->email)->subject($subject)->from($from, $set->site_name)->setBody($text, 'text/html');
            });
        }else if($check->type=="new_withdraw_request_admin"){
            $val=Withdraw::whereid($id)->first();
            $user=User::whereid($val->user_id)->first();
            $find=array("{{amount}}", "{{charge}}", "{{first_name}}", "{{last_name}}", "{{username}}", "{{site_name}}", "{{site_email}}", "{{duration}}", "{{method}}", "{{details}}", "{{reference}}");
            $replace=array(number_format($val->amount, 2).$currency->name, number_format($val->charge, 2).$currency->name, $user->first_name, $user->last_name, $user->username, $set->site_name, $set->email, $val->wallet->period.' '.$val->wallet->duration, $val->wallet->method, $val->details, $val->reference);
            $text = str_replace($find, $replace, str_replace("{{message}}", $check->body, $set->email_template));
            $subject = str_replace($find, $replace, $check->subject);
            Mail::send([], [], function ($message) use($subject, $from, $set, $text){
                $message->to($set->email)->subject($subject)->from($from, $set->site_name)->setBody($text, 'text/html');
            });
        }else if($check->type=="withdraw_request_approve"){
            $val=Withdraw::whereid($id)->first();
            $user=User::whereid($val->user_id)->first();
            $find=array("{{amount}}", "{{charge}}", "{{first_name}}", "{{last_name}}", "{{username}}", "{{site_name}}", "{{site_email}}", "{{duration}}", "{{method}}", "{{details}}", "{{reference}}");
            $replace=array(number_format($val->amount, 2).$currency->name, number_format($val->charge, 2).$currency->name, $user->first_name, $user->last_name, $user->username, $set->site_name, $set->email, $val->duration, $val->wallet->method, $val->details, $val->reference);
            $text = str_replace($find, $replace, str_replace("{{message}}", $check->body, $set->email_template));
            $subject = str_replace($find, $replace, $check->subject);
            Mail::send([], [], function ($message) use($user, $subject, $from, $set, $text){
                $message->to($user->email)->subject($subject)->from($from, $set->site_name)->setBody($text, 'text/html');
            });
        }else if($check->type=="withdraw_request_decline"){
            $val=Withdraw::whereid($id)->first();
            $user=User::whereid($val->user_id)->first();
            $find=array("{{amount}}", "{{charge}}", "{{first_name}}", "{{last_name}}", "{{username}}", "{{site_name}}", "{{site_email}}", "{{duration}}", "{{method}}", "{{details}}", "{{reference}}");
            $replace=array(number_format($val->amount, 2).$currency->name, number_format($val->charge, 2).$currency->name, $user->first_name, $user->last_name, $user->username, $set->site_name, $set->email, $val->duration, $val->wallet->method, $val->details, $val->reference);
            $text = str_replace($find, $replace, str_replace("{{message}}", $check->body, $set->email_template));
            $subject = str_replace($find, $replace, $check->subject);
            Mail::send([], [], function ($message) use($user, $subject, $from, $set, $text){
                $message->to($user->email)->subject($subject)->from($from, $set->site_name)->setBody($text, 'text/html');
            });
        }else if($check->type=="deposit_request_approve"){
            $checkx=Deposits::wheretrx($id)->count();
            if($checkx==1){
                $val=Deposits::wheretrx($id)->first();
            }else{
                $val=Banktransfer::wheretrx($id)->first();
            }
            $user=User::whereid($val->user_id)->first();
            $find=array("{{amount}}", "{{charge}}", "{{first_name}}", "{{last_name}}", "{{username}}", "{{site_name}}", "{{site_email}}", "{{reference}}");
            $replace=array($val->amount.$currency->name, $val->charge.$currency->name, $user->first_name, $user->last_name, $user->username, $set->site_name, $set->email, $val->trx);
            $text = str_replace($find, $replace, str_replace("{{message}}", $check->body, $set->email_template));
            $subject = str_replace($find, $replace, $check->subject);
            Mail::send([], [], function ($message) use($user, $subject, $from, $set, $text){
                $message->to($user->email)->subject($subject)->from($from, $set->site_name)->setBody($text, 'text/html');
            });
        }else if($check->type=="deposit_request_decline"){
            $checkx=Deposits::wheretrx($id)->count();
            if($checkx==1){
                $val=Deposits::wheretrx($id)->first();
            }else{
                $val=Banktransfer::wheretrx($id)->first();
            }
            $user=User::whereid($val->user_id)->first();
            $find=array("{{amount}}", "{{charge}}", "{{first_name}}", "{{last_name}}", "{{username}}", "{{site_name}}", "{{site_email}}", "{{reference}}");
            $replace=array($val->amount.$currency->name, $val->charge.$currency->name, $user->first_name, $user->last_name, $user->username, $set->site_name, $set->email, $val->trx);
            $text = str_replace($find, $replace, str_replace("{{message}}", $check->body, $set->email_template));
            $subject = str_replace($find, $replace, $check->subject);
            Mail::send([], [], function ($message) use($user, $subject, $from, $set, $text){
                $message->to($user->email)->subject($subject)->from($from, $set->site_name)->setBody($text, 'text/html');
            });
        }
    }

    function send_email($to, $name, $subject, $body) {
        $set=Settings::first();
        $from = env('MAIL_FROM_ADDRESS');
        $text = str_replace("{{site_name}}", $set->site_name, str_replace("{{message}}", $body, $set->email_template));
        Mail::send([], [], function ($message) use($subject, $from, $set, $to, $text, $name){
            $message->to($to, $name)->subject($subject)->from($from, $set->site_name)->setBody($text, 'text/html');
        });
     }

if (! function_exists('user_ip')) {
    function user_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

if (! function_exists('send_sms')) {
    function send_sms($recipients, $message)
    {
        $temp = Etemplate::first();
        $account_sid = $temp->twilio_sid;
        $auth_token = $temp->twilio_auth;
        $twilio_number = $temp->twilio_number;
        $client = new Client($account_sid, $auth_token);
        try{
            $client->messages->create($recipients, ['from' => $twilio_number,'body' => $message] );
        }catch (TwilioException $e){

        }catch (Exception $e){

        }
    }
}

function sub_check() {
    $set=Settings::first();
    if(env('ENVATO_PURCHASECODE')==null){
        session_start();
        $_SESSION["error"] = "no purchase code found";
        $url = route('ipn.flutter');
    	header("Location: ".$url);
        exit();
    }else{
        if($set->xperiod<Carbon::now()){
            $purchase_code=trim(env('ENVATO_PURCHASECODE'));
            $curl = new Curl();
            $curl->setHeader('Authorization', 'Bearer reEx9VLfeRLIiBnJlJoodlMpnftMDnQl');
            $curl->get('https://api.envato.com/v3/market/author/sale', array(
                'code' => $purchase_code
            ));
            $curl->close();
            if ($curl->error) {
                session_start();
                $_SESSION["error"] = "Invalid Purchase Code";
                $url = route('ipn.flutter');
                header("Location: ".$url);
                exit();
            }else{
                $result=$curl->response;
                if($result->item->id==31933895){
                }else{
                    session_start();
                    $_SESSION["error"] = "Invalid Purchase Code";
                    $url = route('ipn.flutter');
                    header("Location: ".$url);
                    exit();
                }
            }
            $set->xperiod=Carbon::now()->add('10 minutes');
            $set->save();  
        }
    }
}

if (!function_exists('castrotime')) {

    function castrotime($timestamp)
    {
        $datetime1=Carbon::today();
        $datetime2=date_create($timestamp);
        $diff=date_diff($datetime1, $datetime2);
        $timemsg=$datetime1->diffInDays($datetime2);    
        return $timemsg;
    }
}

if (!function_exists('convertFloat')) {
    function convertFloat($floatAsString)
    {
        $norm = strval(floatval($floatAsString));
    
        if (($e = strrchr($norm, 'E')) === false) {
            return $norm;
        }
    
        return number_format($norm, -intval(substr($e, 1)));
    }
}
