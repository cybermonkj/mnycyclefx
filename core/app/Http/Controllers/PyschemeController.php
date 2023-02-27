<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;
use App\Models\User;
use App\Models\Plans;
use App\Models\Profits;
use App\Models\Coupon;
use App\Models\Sandplanupdate;
use App\Models\Sandprofits;
use App\Models\Statusimage;
use App\Models\Sandplans;
use App\Models\Settings;
use App\Models\Sandfollowed;
use App\Models\Sandplancategory;
use App\Models\Plancategory;
use App\Models\Savings;
use Carbon\Carbon;
use Image;
use Redirect;
use Str;


class PyschemeController extends Controller
{

//Standard
    public function Plans()
    {
        $data['title']='Plans';
        $data['plan']=Plans::all();
        return view('admin.investment.plans', $data);
    } 
    public function Create()
    {
        $data['title']='Create plan';
        $data['category']=Plancategory::wherestatus(1)->get();
        return view('admin.investment.create', $data);
    } 
    public function Category()
    {
        $data['title']='Category';
        $data['profit']=Plancategory::get();
        return view('admin.investment.category', $data);
    } 
    public function Categorystore(Request $request)
    {
        $data['name'] = $request->name;
        $res = Plancategory::create($data);
        if ($res) {
            return back()->with('success', 'Saved Successfully!');
        } else {
            return back()->with('alert', 'Problem With Creating New Category');
        }
    }
    public function Categoryupdate(Request $request)
    {
        $data = Plancategory::findOrFail($request->id);
        $data->name=$request->name;
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    } 
    public function CategoryDestroy($id)
    {
        $data = Plancategory::findOrFail($id);
        $check=Plans::wherecat_id($id)->count();
        if($check==0){
            $data->delete();
            return back()->with('success', 'Successfully deleted');
        }else{
            return back()->with('alert', 'you can\'t delete this as there is a plan using this category');
        }
    } 
    public function uncategory($id)
    {
        $blog=Plancategory::find($id);
        $blog->status=0;
        $blog->save();
        return back()->with('success', 'Category has been unpublished.');
    } 
    public function pcategory($id)
    {
        $blog=Plancategory::find($id);
        $blog->status=1;
        $blog->save();
        return back()->with('success', 'Category was successfully published.');
    }
    public function Store(Request $request)
    {
        $compound=$request->percent*$request->duration;
        $interest=$compound-100;
        if($interest>0){
            $data['name'] = $request->name;
            $data['percent'] = $request->percent;
            $data['min_deposit'] = $request->min_amount;
            $data['amount'] = $request->max_amount;
            $data['duration'] = $request->duration;
            $data['period'] = "Days";
            $data['ref_percent'] = $request->ref_percent;
            $data['compound'] = $request->compound;
            $data['interest'] = $request->interest;
            $data['status'] = $request->status;
            $data['bonus'] = $request->bonus;
            $data['claim'] = $request->claim;
            $data['cat_id'] = $request->category;
            $data['recurring'] = $request->recurring;
            if($request->hasFile('image')){
                $filename = 'plan_'.time().'.jpg';
                $location = 'asset/images/' . $filename;
                Image::make($request->file('image'))->save($location);
                $data['image'] = $filename;
            }
            $res = Plans::create($data);
            return redirect()->route('admin.py.plans')->with('success', 'Saved Successfully!');
        }else{
            return back()->with('alert', 'Interest can\'t be less than zero, increase duration or daily percent'); 
        }
    } 
    public function Pending()
    {
        $data['title']='Pending investment';
        $data['profit']=Profits::whereStatus(3)->orderBy('date', 'DESC')->get();
        return view('admin.investment.pending', $data);
    }    
    public function Running()
    {
        $data['title']='Running investment';
        $data['profit']=Profits::whereStatus(1)->orderBy('date', 'DESC')->get();
        return view('admin.investment.running', $data);
    }     
    public function Completed()
    {
        $data['title']='Completed investment';
        $data['profit']=Profits::whereStatus(2)->latest()->get();
        return view('admin.investment.completed', $data);
    }    
    public function Coupon()
    {
        $data['title']='Coupons';
        $data['profit']=Coupon::get();
        return view('admin.investment.coupon', $data);
    } 
    public function Couponstore(Request $request)
    {
        $data=new Coupon();
        $data->fill($request->all())->save();
        return back()->with('success', 'Saved Successfully!');
    }
    public function Couponupdate(Request $request)
    {
        $data = Coupon::findOrFail($request->id);
        $data->fill($request->all())->save();
        return back()->with('success', 'Update was Successful!');
    } 
    public function CouponDestroy($id)
    {
        $data = Coupon::findOrFail($id);
        $data->delete();
        return back()->with('success', 'Request was Successfully deleted!');
    } 
    public function uncoupon($id)
    {
        $blog=Coupon::find($id);
        $blog->status=0;
        $blog->save();
        return back()->with('success', 'Coupon has been unpublished.');
    } 
    public function pcoupon($id)
    {
        $blog=Coupon::find($id);
        $blog->status=1;
        $blog->save();
        return back()->with('success', 'Coupon was successfully published.');
    }
    public function Destroy($id)
    {
        $data = Profits::findOrFail($id);
            $res =  $data->delete();
            if ($res) {
                return back()->with('success', 'Request was Successfully deleted!');
            } else {
                return back()->with('alert', 'Problem With Deleting Request');
            }
    }    
    public function Decline($id)
    {
        $data = Profits::findOrFail($id);
        $set=Settings::find(1);
        $user=User::whereid($data->user_id)->first();
        $data->status=4;
        $data->save();
        if($data->type==1){
            $user->balance+$data->amount;
        }elseif($data->type==2){
            $user->profit+$data->amount;
        }elseif($data->type==3){
            $user->ref_bonus+$data->amount;
        }
        $user->save();
        if($set->email_notify==1){
            send_email($user->email, $user->site_name, 'Investment declined', 'Sorry Investment #'.$data->trx.' was declined and funds paid has been refunded. Thanks for choosing us.');
        }
        return back()->with('success', 'Investment Declined');
    }     
    public function Approve($id)
    {
        $data = Profits::findOrFail($id);
        $set=Settings::find(1);
        $user=User::whereid($data->user_id)->first();
        $date=Carbon::now();
        $date1=date_create(Carbon::now());
        $date2=date_create($date);
        $start_date=date_create($date);
        date_add($start_date, date_interval_create_from_date_string($data->plan->duration.' '.$data->plan->period));
        $ndate=date_format($start_date, "Y-m-d H:i:s"); 
        $data->status=1;
        $data->end_date=$ndate;
        $data->date=$date;
        $data->save();
        if($set->email_notify==1){
            send_email($user->email, $user->site_name, 'Investment has started', '#'.$data->trx.' will be updated daily and run for '.$data->duration.' '.$data->period.'(s). Thanks for choosing us.');
        }
        return back()->with('success', 'Investment Approved');
    }    
    public function cc(Request $request)
    {
        $data = Profits::findOrFail($request->id);
        $data->amount=$request->amount;
        $data->save();
        return back()->with('success', 'Successful!');
    } 
    public function PlanDestroy($id)
    {
        $data = Plans::findOrFail($id);
        $check=Profits::whereplan_id($id)->get();
        if(count($check)>0){
            return back()->with('alert', 'You can not delete this plan, users have investments on this');
        }else{
            $data->delete();
            return back()->with('success', 'Plan was successfully deleted');
        }
    } 
    public function Edit($id)
    {
        $plan=$data['plan']=Plans::findOrFail($id);
        $data['title']=$plan->name;
        $data['category']=Plancategory::wherestatus(1)->get();
        return view('admin.investment.edit', $data);
    } 
    public function Update(Request $request)
    {
        $compound=$request->percent*$request->duration;
        $interest=$compound-100;
        if($interest>0){
            $data = Plans::findOrFail($request->id);
            $data->name=$request->name;
            $data->percent=$request->percent;
            $data->min_deposit=$request->min_amount;
            $data->amount=$request->max_amount;
            $data->duration=$request->duration;
            $data->ref_percent=$request->ref_percent;
            $data->compound=$request->compound;
            $data->interest=$request->interest;
            $data->bonus=$request->bonus;
            $data->claim=$request->claim;
            $data->recurring=$request->recurring;
            $data->cat_id = $request->category;
            if(empty($request->status)){
                $data->status=0;	
            }else{
                $data->status=$request->status;
            }
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = 'plan_'.time().'.png';
                $location = 'asset/images/' . $filename;
                Image::make($image)->save($location);
                $path = './asset/images/';
                File::delete($path.$data->image);
                $data['image'] = $filename;
            }
            $data->save();
            return back()->with('success', 'Update was Successful!');
        }else{
            return back()->with('alert', 'Interest can\'t be less than zero, increase duration or daily percent');
        }
    }  
//End

//Project
    public function SandFemail($id)
    {
        $data['title']='Send email';
        $data['plan']=$id;
        return view('admin.project.email', $data);
    }
    public function SandSendfpromo(Request $request)
    {        	
        $set=Settings::first();
        $user=Sandfollowed::whereplan_id($request->id)->get();
        foreach ($user as $email) {
            $x=User::whereid($email->user_id)->first();
            if($set->email_notify==1){
                send_email($x->email, $x->username, $request->subject, $request->message);
            }
        }      
        return back()->with('success', 'Mail Sent Successfuly!');
    }
    public function SandPlans()
    {
        $data['title']='Plans';
        $data['plan']=Sandplans::orderby('id','desc')->get();
        return view('admin.project.plans', $data);
    }   
    public function SandStatusCreate($id)
    {
        $data['title']='Create Status Update';
        $data['plan']=$id;
        return view('admin.project.add_status', $data);
    }    
    public function SandCreate()
    {
        $data['title']='Create plan';
        $data['category']=Sandplancategory::wherestatus(1)->get();
        return view('admin.project.create', $data);
    } 

    public function SandStatusStore(Request $request)
    { 
        $data['information'] = $request->information;
        $data['report'] = $request->report;
        $data['activity'] = $request->activity;
        $data['stage'] = $request->stage;
        $data['weeks'] = $request->weeks;
        $data['plan_id'] = $request->plan;
        $res = Sandplanupdate::create($data);
        $plan=Sandplans::whereid($request->plan)->first();
        $set=Settings::first();
        $ff = Sandfollowed::whereplan_id($request->plan)->get();
        foreach($ff as $val){
            $user=User::whereid($val->user_id)->first();
            if($set['email_notify']==1){
                send_email($user->email, $user->first_name.' '.$user->last_name, $plan->name. 'staus has been updated', $request->activity);
            }
        }
        if ($res) {
            return redirect()->route('admin.sand.plan.edit', ['id' => $request->plan])->with('success', 'Saved Successfully!');
        } else {
            return back()->with('alert', 'Problem With Creating New Plan');
        }
    }    

    public function SandStore(Request $request)
    {
        $dt = Carbon::create($request->start_date);
        $dt->add($request->duration.' '.$request->period)->toDateString();   
        $data['name'] = $request->name;
        $data['slug'] = Str::slug($request->name, '-');
        $data['description'] = Purifier::clean($request->description);
        $data['start_date'] = Carbon::create($request->start_date)->toDateString();
        $data['price'] = $request->price;
        $data['duration'] = $request->duration;
        $data['period'] = $request->period;
        $data['units'] = $request->units;
        $data['original'] = $request->units;
        $data['status'] = $request->status;
        $data['interest'] = $request->interest;
        $data['cat_id'] = $request->category;
        $data['location'] = $request->location;
        $data['insurance'] = $request->insurance;
        $data['ref_percent'] = $request->ref_percent;
        $data['expiring_date'] = $dt;
        $data['type'] = 1;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'plan_'.time().'.jpg';
            $location = 'asset/images/' . $filename;
            Image::make($image)->resize(500,280)->save($location);
            $data['image'] = $filename;
        }
        $res = Sandplans::create($data);
        if ($res) {
            return redirect()->route('admin.sand.py.plans')->with('success', 'Saved Successfully!');
        } else {
            return back()->with('alert', 'Problem With Creating New Plan');
        }
    }    

    public function SandSubmitStatusImage(Request $request)
    {
        $data['title'] = $request->title;
        $data['update_id'] = $request->id;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'planupdate_'.time().'.jpg';
            $location = 'asset/images/' . $filename;
            Image::make($image)->save($location);
            $data['image'] = $filename;
        }
        $res = Statusimage::create($data);
        if ($res) {
            return back()->with('success', 'Saved Successfully!');
        } else {
            return back()->with('alert', 'An Error occured');
        }
    } 

    public function Sanddeleteproductimage($id)
    {
        $data = Statusimage::findOrFail($id);
        $path = './asset/images/';
        File::delete($path.$data->image);
        $res =  $data->delete();
        if ($res) {
            return back()->with('success', 'Image Deleted Successfully!');
        } else {
            return back()->with('alert', 'Problem With Deleting Image');
        }
    }

    public function SandPending()
    {
        $data['title']='Pending investment';
        $data['profit']=Sandprofits::whereStatus(1)->latest()->get();
        return view('admin.project.pending', $data);
    }     

    public function SandCompleted()
    {
        $data['title']='Completed investment';
        $data['profit']=Sandprofits::whereStatus(2)->latest()->get();
        return view('admin.project.completed', $data);
    }    
    public function SandCategory()
    {
        $data['title']='Category';
        $data['profit']=Sandplancategory::get();
        return view('admin.project.category', $data);
    } 
    public function SandCategorystore(Request $request)
    {
        $data['name'] = $request->name;
        $res = Sandplancategory::create($data);
        if ($res) {
            return back()->with('success', 'Saved Successfully!');
        } else {
            return back()->with('alert', 'Problem With Creating New Category');
        }
    }
    public function SandCategoryupdate(Request $request)
    {
        $data = Sandplancategory::findOrFail($request->id);
        $data->name=$request->name;
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    } 
    public function SandCategoryDestroy($id)
    {
        $data = Sandplancategory::findOrFail($id);
        $check=Sandplans::wherecat_id($id)->count();
        if($check==0){
            $data->delete();
            return back()->with('success', 'Successfully deleted');
        }else{
            return back()->with('alert', 'you can\'t delete this as there is a plan using this category');
        }
    } 
    public function Sanduncategory($id)
    {
        $blog=Sandplancategory::find($id);
        $blog->status=0;
        $blog->save();
        return back()->with('success', 'Category has been unpublished.');
    } 
    public function Sandpcategory($id)
    {
        $blog=Sandplancategory::find($id);
        $blog->status=1;
        $blog->save();
        return back()->with('success', 'Category was successfully published.');
    }
    public function SandDestroy($id)
    {
        $data = Sandprofits::findOrFail($id);
            $res =  $data->delete();
            if ($res) {
                return back()->with('success', 'Request was Successfully deleted!');
            } else {
                return back()->with('alert', 'Problem With Deleting Request');
            }
    }    
    public function SandPlanDestroy($id)
    {
        $data = Sandplans::findOrFail($id);
        $check=Sandprofits::whereplan_id($id)->get();
        if(count($check)>0){
            return back()->with('alert', 'You can not delete this plan, users have investments on this');
        }else{
            $data->delete();
            return back()->with('success', 'Plan was successfully deleted');
        }
    }  
    public function SandEdit($id)
    {
        $plan=$data['plan']=Sandplans::findOrFail($id);
        $data['title']=$plan->name;
        $data['category']=Sandplancategory::wherestatus(1)->get();
        $data['updates']=Sandplanupdate::whereplan_id($id)->get();
        return view('admin.project.edit', $data);
    }    
    public function SandInvest($id)
    {
        $data['profit']=Sandprofits::whereplan_id($id)->get();
        $data['title']='Investors';
        return view('admin.project.trades', $data);
    }    
    public function SandStatusEdit($id)
    {
        $plan=$data['plan']=Sandplanupdate::findOrFail($id);
        $data['title']=$plan->activity;
        return view('admin.project.edit_status', $data);
    }     
    public function SandStatusImage($id)
    {
        $plan=$data['plan']=Statusimage::whereupdate_id($id)->get();
        $data['title']='Status Image';
        $data['check']=$id;
        return view('admin.project.status_image', $data);
    } 
    public function SandUpdate(Request $request)
    {
        $set=Settings::first();
        $data = Sandplans::findOrFail($request->id);
        $data->name=$request->name;
        $data->slug = Str::slug($request->name, '-');
        $data->description=Purifier::clean($request->description);
        $data->location=$request->location;
        $data->cat_id=$request->category;
        $data->insurance=$request->insurance;
        $data->status=$request->status;
        $data->ref_percent = $request->ref_percent;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = 'plan_'.time().'.png';
            $location = 'asset/images/' . $filename;
            Image::make($image)->resize(500,280)->save($location);
            $path = './asset/images/';
            File::delete($path.$data->image);
            $data['image'] = $filename;
        }
        $res=$data->save();
        if ($res) {
            if($request->has('start_date')){
                $investors=Sandprofits::whereplan_id($request->id)->count();
                if($investors<1){
                    $data->start_date = Carbon::create($request->start_date)->toDateString();
                    $data->price = $request->price;
                    $data->duration = $request->duration;
                    $data->period = $request->period;
                    $data->units = $request->units;
                    $data->original = $request->units;
                    $data->save();
                    return back()->with('success', 'Update was Successful!');
                }else{
                    return back()->with('alert', 'You can\'t update start date as investors are already subscribed to this plan');
                }
            }
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }     
    public function SandStatusUpdate(Request $request)
    {
        $data = Sandplanupdate::findOrFail($request->plan);
        $data->information=$request->information;
        $data->report=$request->report;
        $data->activity=$request->activity;
        $data->stage=$request->stage;
        $data->weeks=$request->weeks;
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }  
//End

public function saving()
{
    $data['title'] = "Savings";
    $data['savings']=Savings::latest()->paginate(6);
    return view('admin.transfer.saving', $data);
} 
}
