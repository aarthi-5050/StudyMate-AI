<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\StudyNote;
use App\Models\Document;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Show Login Page
    public function login()
{
      return view('Auth.login');
}
public function sendOtp(Request $request)
{
    DB::beginTransaction();

    try{

        $otp = rand(1000,9999);

        session([
            'otp'=>$otp,
            'otp_email'=>$request->email
        ]);

        Mail::raw(
            "Your StudyMateAI Login OTP is : ".$otp,
            function($message) use($request){

                $message->to($request->email)
                        ->subject('StudyMateAI OTP');

            }
        );

        DB::commit();

        Log::info('OTP Sent Successfully',[
            'email'=>$request->email
        ]);

        return response()->json([
            'success'=>true
        ]);

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('OTP Sending Failed',[
            'error'=>$e->getMessage()
        ]);

        return response()->json([
            'success'=>false
        ]);
    }
}
    public function loginCheck(Request $request)
{
    DB::beginTransaction();

    try{

        if(
            $request->email == session('otp_email') &&
            $request->password == session('admin_password','123456') &&
            $request->otp == session('otp')
        ){

            session([
                'admin'=>true
            ]);

            session()->forget('otp');

            DB::commit();

            Log::info('Admin Login Success',[
                'email'=>$request->email
            ]);

            return redirect()->route('dashboard');
        }

        DB::rollBack();

        Log::warning('Admin Login Failed',[
            'email'=>$request->email
        ]);

        return back()->with('error','Invalid Credentials or OTP');

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('Login Error',[
            'error'=>$e->getMessage()
        ]);

        return back()->with('error','Something Went Wrong');
    }
}
public function dashboard()
{
    if (!session()->has('admin')) {
        return redirect()->route('login');
    }

    $notesCount = StudyNote::count();

    $documentsCount = Document::count();

    $chatCount = ChatMessage::count();

    return view('Admin.dashboard', compact(
        'notesCount',
        'documentsCount',
        'chatCount'
    ));
}

 public function logout()
{
    DB::beginTransaction();

    try{

        session()->forget('admin');
        session()->forget('otp');
        session()->forget('otp_email');

        DB::commit();

        Log::info('Admin Logout Successfully');

        return redirect()->route('login');

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('Logout Failed',[
            'error'=>$e->getMessage()
        ]);

        return back();
    }
}
public function resetPassword()
{
    return view('Auth.reset_password');
}

public function updatePassword(Request $request)
{
    DB::beginTransaction();

    try{

        $currentPassword = session('admin_password','123456');

        if($request->current_password != $currentPassword){

            DB::rollBack();

            return back()->with('error','Current Password Incorrect');
        }

        if($request->new_password != $request->confirm_password){

            DB::rollBack();

            return back()->with('error','Passwords Do Not Match');
        }

        session([
            'admin_password'=>$request->new_password
        ]);

        DB::commit();

        Log::info('Password Updated Successfully');

        return redirect()->route('login')
            ->with('success','Password Updated Successfully');

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('Password Update Failed',[
            'error'=>$e->getMessage()
        ]);

        return back()->with('error','Password Update Failed');
    }
}

public function forgotPassword()
{
    return view('Auth.forgot_password');
}

public function forgotPasswordSave(Request $request)
{
    DB::beginTransaction();

    try{

        if($request->new_password != $request->confirm_password){

            DB::rollBack();

            return back()->with('error','Passwords Do Not Match');
        }

        session([
            'admin_password'=>$request->new_password
        ]);

        DB::commit();

        Log::info('Forgot Password Changed Successfully');

        return redirect()->route('login')
            ->with('success','Password Changed Successfully');

    }
    catch(\Exception $e){

        DB::rollBack();

        Log::error('Forgot Password Failed',[
            'error'=>$e->getMessage()
        ]);

        return back()->with('error','Password Change Failed');
    }
}






}