<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function show(){
        echo "finee";die;
    }

    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|digits:10|starts_with: 6,7,8,9',
            'email' => 'required|email'
        ]);
        if($validatedData->fails()){
            return response()->json(['code'=>400,'msg'=>$validatedData->errors()->first()]);
        }

        //$input = $request->all();

        $user = new UserData;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->description=$request->description;
        $user->role_id=$request->role_id;
        $user->image=$request->image;
        $user->save();

        return redirect('form')->with('status', 'Ajax Form Data Has Been validated and store into database');

    }
}
