<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Withdraw;
use App\Models\Withdrawm;
use App\Models\Audit;
use App\Models\Emailtemplate;
use Str;





class WithdrawController extends Controller
{


        
    public function withdrawlog()
    {
        $data['title']='Withdraw logs';
        $data['withdraw']=Withdraw::orderBy('id', 'DESC')->get();
        return view('admin.withdrawal.index', $data);
    } 

    public function withdrawmethod()
    {
        $data['title']='Withdraw methods';
        $data['method']=Withdrawm::orderBy('id', 'DESC')->get();
        $data['email1']=Emailtemplate::wheretype('new_withdraw_request_user')->first();
        $data['email2']=Emailtemplate::wheretype('new_withdraw_request_admin')->first();
        $data['email3']=Emailtemplate::wheretype('withdraw_request_approve')->first();
        $data['email4']=Emailtemplate::wheretype('withdraw_request_decline')->first();
        return view('admin.withdrawal.methods', $data);
    }   

    public function withdrawapproved()
    {
        $data['title']='Approved Withdraw';
        $data['withdraw']=Withdraw::whereStatus(1)->orderBy('id', 'DESC')->get();
        return view('admin.withdrawal.approved', $data);
    } 
    
    public function withdrawunpaid()
    {
        $data['title']='Approved Withdraw';
        $data['withdraw']=Withdraw::whereStatus(0)->orderBy('id', 'DESC')->get();
        return view('admin.withdrawal.unpaid', $data);
    } 
    
    public function withdrawdeclined()
    {
        $data['title']='Declined Withdraw';
        $data['withdraw']=Withdraw::whereStatus(2)->orderBy('id', 'DESC')->get();
        return view('admin.withdrawal.declined', $data);
    }

    public function DestroyWithdrawal($id)
    {
        $data = Withdraw::findOrFail($id);
        if($data->status==0){
            return back()->with('alert', 'You cannot delete an unpaid withdraw request');
        }else{
            $data->delete();
            return back()->with('success', 'Request was Successfully deleted!');
        }

    }  

    public function DestroyMethod($id)
    {
        $data = Withdrawm::findOrFail($id);
        $res =  $data->delete();
        if ($res) {
            return back()->with('success', 'Method was Successfully deleted!');
        } else {
            return back()->with('alert', 'Problem With Deleting Method');
        }
    } 
    
    public function approve($id)
    {
        $data = Withdraw::findOrFail($id);
        $set=Settings::first();
        $data->status=1;
        $data->save();
        if($set->email_notify==1){
            custom_email('withdraw_request_approve', $data->id);      
        }
        $audit['user_id']=$data->user_id;
        $audit['trx']=$data->reference;
        $audit['log']='Withdraw request Approved '.$data->reference;
        Audit::create($audit);  
        return back()->with('success', 'Request was Successfully approved!');
    }  
   
    public function store(Request $request)
    {
        $data=new Withdrawm();
        $data->method=$request->method;
        $data->min=$request->min;
        $data->max=$request->max;
        $data->fiat_charge=$request->fiat_charge;
        $data->percent_charge=$request->percent_charge;
        $data->period=$request->period;
        $data->duration=$request->duration;
        $data->requirements=$request->requirements;
        $data->save();
        return back()->with('success', 'Saved Successfully!');
    }    
    public function update(Request $request)
    {
        $data=Withdrawm::whereid($request->id)->first();
        $data->method=$request->method;
        $data->min=$request->min;
        $data->max=$request->max;
        $data->fiat_charge=$request->fiat_charge;
        $data->percent_charge=$request->percent_charge;
        $data->period=$request->period;
        $data->duration=$request->duration;
        $data->requirements=$request->requirements;
        $data->save();
        return back()->with('success', 'Saved Successfully!');
    } 
    public function SettleUpdate(Request $request)
    {
        $data = Settings::findOrFail(1);
        $data->fill($request->all())->save();     
        $data->save();
        return back()->with('success', 'Update was Successful!');
    }    
    public function WithdrawEmailUpdate(Request $request)
    {
        $data = Emailtemplate::wheretype($request->type)->first();
        $data->fill($request->all())->save();                
        $data->save();
        return back()->with('success', 'Update was Successful!');
    }   
    public function decline($id)
    {
        $data = Withdraw::findOrFail($id);
        $user=User::find($data->user_id);
        $set=Settings::first();
        $data->status=2;
        $data->save();
        if($data->type==1){
            $user->profit=$user->profit+$data->amount+$data->charge;
            $user->save();
        }elseif($data->type==2){
            $user->balance=$user->balance+$data->amount+$data->charge;
            $user->save();
        }elseif($data->type==3){
            $user->ref_bonus=$user->ref_bonus+$data->amount+$data->charge;
            $user->save();
        }
        if($set->email_notify==1){
            custom_email('withdraw_request_decline', $data->id);      
        }
        $audit['user_id']=$data->user_id;
        $audit['trx']=$data->reference;
        $audit['log']='Withdraw request Declined '.$data->reference;
        Audit::create($audit);  
        return back()->with('success', 'Request was Successfully declined!');
    }  
    public function approvem($id)
    {
        $data = Withdrawm::findOrFail($id);
        $data->status=1;
        $data->save();
        return back()->with('success', 'Successfully activated!');
    } 
    
    public function declinem($id)
    {
        $data = Withdrawm::findOrFail($id);
        $data->status=0;
        $data->save();
        return back()->with('success', 'Successfully disabled!');
    }    
    public function deletem($id)
    {
        $data = Withdrawm::findOrFail($id);
        $check=Withdraw::wherecoin_id($id)->count();
        if($check>0){
            return back()->with('alert', 'You can\'t delete this as it is already used in a withdrawal request!');
        }else{
            $data->delete();
            return back()->with('success', 'Successfully deleted!');
        }
    }      
}
