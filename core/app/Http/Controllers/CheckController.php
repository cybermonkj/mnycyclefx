<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mews\Purifier\Facades\Purifier;
use Validator;
use App\Models\User;
use App\Models\Settings;
use App\Models\Logo;
use App\Models\Currency;
use App\Models\Transfer;
use App\Models\Sandplans;
use App\Models\Plans;
use App\Models\Gateway;
use App\Models\Deposits;
use App\Models\Withdraw;
use App\Models\Profits;
use App\Models\Sandprofits;
use App\Models\Social;
use App\Models\About;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\Review;
use App\Models\Earning;
use App\Models\Referral;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Staff;
use App\Models\Admin;
use App\Models\Banktransfer;
use App\Models\Savings;
use Carbon\Carbon;
use Image;






class CheckController extends Controller
{

    public function __construct()
    {		
        $this->middleware('auth');
    }
 

    //Staff
        public function Destroystaff($id)
        {
            $staff = Admin::whereId($id)->delete();
            return back()->with('success', 'Staff was successfully deleted');
        }
        public function Staffs()
        {
            $data['title']='Staffs';
            $data['users']=Admin::where('id', '!=', 1)->latest()->get();
            return view('admin.user.staff', $data);
        }
        public function Newstaff()
        {
            $data['title']='New Staff';
            return view('admin.user.new-staff', $data);
        }        
        public function Createstaff(Request $request)
        {        
            $check=Admin::whereusername($request->username)->get();
            if(count($check)<1){
                $data['username'] = $request->username;
                $data['last_name'] = $request->last_name;
                $data['first_name'] = $request->first_name;
                $data['password'] = Hash::make($request->password);
                $data['profile'] = $request->profile;
                $data['support'] = $request->support;
                $data['promo'] = $request->promo;
                $data['message'] = $request->message;
                $data['deposit'] = $request->deposit;
                $data['settlement'] = $request->settlement;
                $data['transfer'] = $request->transfer;
                $data['referral'] = $request->referral;
                $data['p_inv'] = $request->p_inv;
                $data['s_inv'] = $request->s_inv;
                $data['savings'] = $request->savings;
                $data['blog'] = $request->blog;
                $res = Admin::create($data);  
                return redirect()->route('admin.staffs')->with('success', 'Staff was successfully created');
            }else{
                return back()->with('alert', 'username already taken');
            }
        }  
        public function Managestaff($id)
        {
            $data['staff']=$user=Admin::find($id);
            $data['title']=$user->username;
            return view('admin.user.edit-staff', $data);
        }    
    
        public function staffPassword(Request $request)
        {
            $user = Admin::whereid($request->id)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            return back()->with('success', 'Password Changed Successfully.');
    
        }
        public function Blockstaff($id)
        {
            $user=Admin::find($id);
            $user->status=1;
            $user->save();
            return back()->with('success', 'Staff has been suspended.');
        } 
    
        public function Unblockstaff($id)
        {
            $user=Admin::find($id);
            $user->status=0;
            $user->save();
            return back()->with('success', 'Staff was successfully unblocked.');
        }
        public function Staffupdate(Request $request)
        {
            $data = Admin::whereid($request->id)->first();
            $data->username=$request->username;
            $data->first_name=$request->first_name;
            $data->last_name=$request->last_name;
            if(empty($request->profile)){
                $data->profile=0;	
            }else{
                $data->profile=$request->profile;
            }  
    
            if(empty($request->support)){
                $data->support=0;	
            }else{
                $data->support=$request->support;
            }    
    
            if(empty($request->promo)){
                $data->promo=0;	
            }else{
                $data->promo=$request->promo;
            }     
    
            if(empty($request->message)){
                $data->message=0;	
            }else{
                $data->message=$request->message;
            }     
    
            if(empty($request->deposit)){
                $data->deposit=0;	
            }else{
                $data->deposit=$request->deposit;
            }     
    
            if(empty($request->settlement)){
                $data->settlement=0;	
            }else{
                $data->settlement=$request->settlement;
            }     
    
            if(empty($request->transfer)){
                $data->transfer=0;	
            }else{
                $data->transfer=$request->transfer;
            }     
    
            if(empty($request->referral)){
                $data->referral=0;	
            }else{
                $data->referral=$request->referral;
            }               
            
            if(empty($request->p_inv)){
                $data->p_inv=0;	
            }else{
                $data->p_inv=$request->p_inv;
            }          
            
            if(empty($request->s_inv)){
                $data->s_inv=0;	
            }else{
                $data->s_inv=$request->s_inv;
            }          
            
            if(empty($request->savings)){
                $data->savings=0;	
            }else{
                $data->savings=$request->savings;
            }                      
    
            $res=$data->save();
            if ($res) {
                return back()->with('success', 'Update was Successful!');
            } else {
                return back()->with('alert', 'An error occured');
            }
        }
    //End of Staff
    //Transfer and Earnings
        public function Transfers()
        {
            $data['title']='Transfers';
            $data['transfer']=Transfer::latest()->get();
            return view('admin.transfer.transfer', $data);
        }     
        
        public function Referrals()
        {
            $data['title']='Referral earnings';
            $data['earning']=Earning::latest()->get();
            return view('admin.transfer.referral', $data);
    } 
    //End
        

    public function Destroyuser($id)
    {
        $check=User::whereid($id)->first();
        $profit = Profits::whereUser_id($id)->delete();
        $sprofit = Sandprofits::whereUser_id($id)->delete();
        $deposit = Deposits::whereUser_id($id)->delete();
        $ticket = Ticket::whereUser_id($id)->delete();
        $withdraw = Withdraw::whereUser_id($id)->delete();
        $earning = Earning::whereReferral($id)->delete();
        $referral = Referral::whereRef_id($id)->delete();
        $bank_transfer = Banktransfer::whereUser_id($id)->delete();
        $savings = Savings::whereUser_id($id)->delete();
        $transfer = Transfer::where('Receiver_id', $id)->orWhere('Temp', $check->email)->delete();
        $user = User::whereId($id)->delete();
        return back()->with('success', 'User was successfully deleted');
    } 

    public function dashboard()
    {
        $data['title']='Dashboard';
        $data['totalusers']=User::count();
        $data['blockedusers']=User::whereStatus(1)->count();
        $data['activeusers']=User::whereStatus(0)->count();
        $data['totalticket']=Ticket::count();
        $data['openticket']=Ticket::whereStatus(0)->count();
        $data['closedticket']=Ticket::whereStatus(1)->count();        
        $data['totalreview']=Review::count();
        $data['pubreview']=Review::whereStatus(1)->count();
        $data['unpubreview']=Review::whereStatus(0)->count();        
        $data['totaldeposit']=Deposits::count();
        $data['approveddep']=Deposits::whereStatus(1)->count();
        $data['declineddep']=Deposits::whereStatus(2)->count();
        $data['pendingdep']=Deposits::whereStatus(0)->count();         
        $data['btotaldeposit']=Banktransfer::count();
        $data['bapproveddep']=Banktransfer::whereStatus(1)->count();
        $data['bdeclineddep']=Banktransfer::whereStatus(2)->count();
        $data['bpendingdep']=Banktransfer::whereStatus(0)->count();               
        $data['totalwd']=Withdraw::count();
        $data['approvedwd']=Withdraw::whereStatus(1)->count();
        $data['declinedwd']=Withdraw::whereStatus(2)->count();
        $data['pendingwd']=Withdraw::whereStatus(0)->count();        
        $data['totalplan']=Plans::count();
        $data['appplan']=Plans::whereStatus(1)->count();
        $data['penplan']=Plans::whereStatus(0)->count();         
        $data['stotalplan']=Sandplans::count();
        $data['sappplan']=Sandplans::whereStatus(1)->count();
        $data['spenplan']=Sandplans::whereStatus(0)->count();        
        $data['totalprofit']=Profits::count();
        $data['appprofit']=Profits::whereStatus(1)->count();
        $data['penprofit']=Profits::whereStatus(0)->count();        
        $data['stotalprofit']=Sandprofits::count();
        $data['sappprofit']=Sandprofits::whereStatus(1)->count();
        $data['spenprofit']=Sandprofits::whereStatus(0)->count();
        $data['messages']=Contact::count();
        return view('admin.dashboard.index', $data);
    }    
    
    public function Users()
    {
		$data['title']='Clients';
		$data['users']=User::latest()->get();
        return view('admin.user.index', $data);
    }    
    
    public function Messages()
    {
		$data['title']='Messages';
		$data['message']=Contact::latest()->get();
        return view('admin.user.message', $data);
    }    
    
    public function Ticket()
    {
		$data['title']='Ticket system';
		$data['ticket']=Ticket::latest()->get();
        return view('admin.user.ticket', $data);
    }   
    
    public function Email($id,$name)
    {
		$data['title']='Send email';
		$data['email']=$id;
		$data['name']=$name;
        return view('admin.user.email', $data);
    }    
    
    public function Promo()
    {
		$data['title']='Send email';
        $data['client']=$user=User::all();
        return view('admin.user.promo', $data);
    } 
    
    public function Sendemail(Request $request)
    {        	
        $set=Settings::first();
        send_email($request->to, $request->name, $request->subject, $request->message);  
        return back()->with('success', 'Mail Sent Successfuly!');
    }
    
    public function Sendpromo(Request $request)
    {        	
        $set=Settings::first();
        $user=User::all();
        foreach ($user as $val) {
            $x=User::whereEmail($val->email)->wherestatus(0)->first();
            if($set->email_notify==1){
                send_email($x->email, $x->username, $request->subject, $request->message);
            }
        }      
        return back()->with('success', 'Mail Sent Successfuly!');
    }  
    
    public function Replyticket(Request $request)
    {        
        $set=Settings::first();
        $ticket=Ticket::whereTicket_id($request->ticket_id)->first();
        $user=User::find($ticket->user_id);
        $data['ticket_id'] = $request->ticket_id;
        $data['reply'] = $request->reply;
        $data['status'] = 0;      
        $data['staff_id'] = $request->staff_id;
        $res = Reply::create($data);  
        if($set['email_notify']==1){
            send_email($user->email, $user->first_name.' '.$user->last_name, 'Ticket Reply:'. $request->ticket_id, $request->reply);
        }    
        return back()->with('alert', 'Reply sent');
    }    
    
    public function Destroymessage($id)
    {
        $data = Contact::findOrFail($id);
        $res =  $data->delete();
        if ($res) {
            return back()->with('success', 'Request was Successfully deleted!');
        } else {
            return back()->with('alert', 'Problem With Deleting Request');
        }
    }     
    
    public function Destroyticket($id)
    {
        $data = Ticket::findOrFail($id);
        $res =  $data->delete();
        if ($res) {
            return back()->with('success', 'Request was Successfully deleted!');
        } else {
            return back()->with('alert', 'Problem With Deleting Request');
        }
    } 

    public function Manageuser($id)
    {
        $data['client']=$user=User::find($id);
        $data['title']=$user->username;
        $data['deposit']=Deposits::whereUser_id($user->id)->orderBy('id', 'DESC')->get();
        $data['withdraw']=Withdraw::whereUser_id($user->id)->orderBy('id', 'DESC')->get();
        $data['profit']=Profits::whereUser_id($user->id)->orderBy('id', 'DESC')->get();
        $data['ticket']=Ticket::whereUser_id($user->id)->orderBy('id', 'DESC')->get();
        $data['earning'] = Earning::whereReferral($user->id)->orderBy('id', 'DESC')->get();
        $data['referral'] = Referral::whereRef_id($user->id)->orderBy('id', 'DESC')->get();
        $data['transfer'] = Transfer::where('sender_id',$user->id)->orWhere('receiver_id',$user->id)->orderBy('id', 'DESC')->get();
        return view('admin.user.edit', $data);
    }     
    
    public function Manageticket($id)
    {
        $data['ticket']=$ticket=Ticket::find($id);
        $data['title']='#'.$ticket->ticket_id;
        $data['client']=User::whereId($ticket->user_id)->first();
        $data['reply']=Reply::whereTicket_id($ticket->ticket_id)->get();
        return view('admin.user.edit-ticket', $data);
    }    
    
    public function Closeticket($id)
    {
        $ticket=Ticket::find($id);
        $ticket->status=1;
        $ticket->save();
        return back()->with('success', 'Ticket has been closed.');
    }     
    
    public function Blockuser($id)
    {
        $user=User::find($id);
        $user->status=1;
        $user->save();
        return back()->with('success', 'User has been suspended.');
    } 

    public function Unblockuser($id)
    {
        $user=User::find($id);
        $user->status=0;
        $user->save();
        return back()->with('success', 'User was successfully unblocked.');
    }

    public function Approvekyc($id)
    {
        $user=User::find($id);
        $user->kyc_status=2;
        $user->save();
        return back()->with('success', 'Kyc has been approved.');
    }    
    

    public function Rejectkyc($id)
    {
        $user=User::find($id);
        $user->kyc_status='0';
        $user->kyc_link='';
        $user->save();
        return back()->with('success', 'Kyc was successfully rejected.');
    } 
    public function declinekyc(Request $request,$id)
    {
        $user=User::find($id);
        $user->kyc_status=2;
        $user->kyc_link=null;
        $user->kyc_reason=$request->reason;
        $user->save();
        $set=Settings::find(1);
        if($set->email_notify==1){
            send_email($user->email, $user->username, 'KYC Declined', $request->reason); 
        } 
        return back()->with('success', 'Kyc was successfully rejected.');
    } 

    public function Profileupdate(Request $request)
    {
        $data = User::findOrFail($request->id);
        $data->username=$request->username;
        $data->first_name=$request->first_name;
        $data->last_name=$request->last_name;
        $data->phone=$request->mobile;
        $data->address=$request->address;
        $data->balance=$request->balance;
        if(empty($request->email_verify)){
            $data->email_verify=0;	
        }else{
            $data->email_verify=$request->email_verify;
        }           
        if(empty($request->fa_status)){
            $data->fa_status=0;	
        }else{
            $data->fa_status=$request->fa_status;
        }    
        if(empty($request->kyc_status)){
            $data->kyc_status=0;	
            $data->kyc_link=null;	
        }else{
            $data->kyc_status=$request->kyc_status;
        }           
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }
    

    public function logout()
    {

        $set=Settings::find(1);
        if(Auth::guard('admin')->user()->id==1){
            $route=$set->admin_url;
        }else{
            $route="staff";
        }
        Auth::guard('admin')->logout();
        return redirect('/'.$route)->with('success', 'Just Logged Out!');
    }
        
}
