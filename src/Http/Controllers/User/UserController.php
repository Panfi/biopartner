<?php

namespace biopartnering\biopartnering\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use biopartnering\biopartnering\Models\User;
use biopartnering\biopartnering\Models\UserDetails;
use biopartnering\biopartnering\Models\Availability;
use Auth;
use Response;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function account()
    {
        return view('biopartnering::users.account');
    }

    public function save_account_details(Request $request)
    {
        $data = $request->get('data');
        $user_id = Auth::user()->id;
        
        foreach ($data as $detail_key => $detail_value)
        {
            $exist = UserDetails::where('user_id', $user_id)->where('detail_key', $detail_key)->count();
            if ($exist)
            {
                UserDetails::where('user_id', $user_id)->where('detail_key', $detail_key)->update(['detail_value' => $detail_value]);
            }
            else
            {
                $user_detail = new UserDetails();
                $user_detail->user_id = $user_id;
                $user_detail->detail_key = $detail_key;
                $user_detail->detail_value = $detail_value;
                $user_detail->save();
            }
        }
        
        return Response::json(['status' => true]);
    }

    public function settings()
    {
        return view('biopartnering::users.settings');
    }

    public function change_password(Request $request)
    {
        $data = $request->get('data');
        $user = Auth::user();

        if (!(Hash::check($data['old_password'], $user->password)))
        {
            return Response::json(['status' => false, "error_description" => "You entered incorrect password!"]);
        }

        $user = User::find($user->id);
        $user->password = $data['new_password'];
        $user->save();

        return Response::json(['status' => true]);
    }

    public function change_email(Request $request)
    {
        $data = $request->get('data');
        $user = Auth::user();

        if ($data['old_email'] != $user->email)
        {
            return Response::json(['status' => false, "error_description" => "You entered incorrect email!"]);
        }

        $exist = User::where('id', "!=", $user->id)->where('email', $data['new_email'])->count();
        if ($exist)
        {
            return Response::json(['status' => false, "error_description" => "Email address already taken!"]);
        }

        $user = User::find($user->id);
        $user->email = $data['new_email'];
        $user->save();
        
        return Response::json(['status' => true]);
    }

    public function update_availability(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');

        Availability::where('id', $id)->update(['status' => $status]);

        return Response::json(['status' => true]);
    }

    public function remove_availability($id)
    {
        Availability::where('id', $id)->delete();

        return Response::json(['status' => true]);
    }

    public function add_availability(Request $request)
    {
        $data = $request->get('data');
        $duration = $data['duration'];
        $date = $data['date'];
        $from_time = ($duration) ? $data['from_time'] : "";
        $to_time = ($duration) ? $data['to_time'] : "";
        $status = $data['status'];

        $user_id = Auth::user()->id;

        //Specific hours
        if($duration)
        {
            //Delete all day availability
            Availability::where('user_id', $user_id)->where('check_date', $date)->where('from_time', "")->delete();
            
            $availability = Availability::where('user_id', $user_id)->where('check_date', $date)->where('from_time', $from_time)->first();
            if(!$availability)
            {
                $availability = new Availability();
            }
        }
        else //All day
        {
            Availability::where('user_id', $user_id)->where('check_date', $date)->delete();
            $availability = new Availability();
        }

        $availability->user_id = $user_id;
        $availability->check_date = $date;
        $availability->from_time = $from_time;
        $availability->to_time = $to_time;
        $availability->status = $status;
        $availability->save();
        
        return $this->get_availability($date);
    }

    public function get_availability($date)
    {
        $availability = Availability::where('user_id', Auth::user()->id)->where('check_date', $date)->get();
        $html = view('biopartnering::users.availability', compact('availability'))->render();

        return Response::json(['status' => true, 'content' => $html]);
    }
}
