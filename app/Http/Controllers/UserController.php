<?php

namespace App\Http\Controllers;
use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {

        return view('users.index',compact('user'));
    }




    public function update(Request $request, User $user)
    {

        //to check if the email is unique or not.
        $uniqueEmail = User::where([['id', '<>', $user->id], ['email', '=', $request->email]])->get();
        $uniqueMobile = User::where([['id', '<>', $user->id], ['mobile', '=', $request->mobile]])->get();


        //rule for validations
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'old_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6',
            'confirm_new_password' => 'same:new_password',
            'mobile' => 'required|string|max:11|min:11',
            'dateOfBirth' => 'required|before:today',
        ];

        //validating..
        $v = Validator::make($request->all(), $rules);


        //getting the validator messages
        $messages = $v->messages();
        foreach ($rules as $key => $value) {
            $vErrors[$key] = $messages->first($key);
        }


        //checking if the email is unique
        if (count($uniqueEmail)) {
            $vErrors['email'] = "This email already exists!!";
        }


        //checking if the mobile is unique
        if (count($uniqueMobile)) {
            $vErrors['mobile'] = "This mobile number already exists!!";
        };

        //validating old_password
        if($request->old_password !=="")
        {
            if(!Hash::check($request->old_password,$user->password))
            {
                $vErrors['old_passwordE'] = "Wrong old password !!";
            }
        }



        //Checkin whether to update or not !!
        if ($v->fails() || $vErrors['mobile'] != "" || $vErrors['email']  != "" ||
            !Hash::check($request->old_password,$user->password) )
        {

            return json_encode(array('success'=>false,'user'=>$user,
                'errors'=>$vErrors,'request'=>$request->all()));

        }

        //updating...
        $user->where('id',$user->id)->update([
            'name'=> $request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->new_password),
            'mobile'=>$request->mobile,
            'address'=>$request->address,
            'dateOfBirth'=>$request->dateOfBirth,
        ]);

        //Getting new user credentials.
        $user = User::where('id',$user->id)->first();
        return json_encode(array('success'=>true,'user'=>$user,
            'errors'=>$vErrors,'request'=>$request->all()));


    }


}
