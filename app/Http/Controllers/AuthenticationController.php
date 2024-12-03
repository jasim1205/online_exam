<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\ClassList;
use App\Http\Requests\Authentication\SignupRequest;
use App\Http\Requests\Authentication\SigninRequest;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthenticationController extends Controller
{
    public function signUpForm(){
        $classlist = ClassList::get();
        return view('authentication.register',compact('classlist'));
    }

    public function signUpStore(SignupRequest $request){
        //dd($request);
        try{
            $user=new User;
            $user->name=$request->FullName;
            $user->contact_no=$request->contact_no;
            $user->email=$request->EmailAddress;
            $user->username=$request->username;
            $user->gender=$request->gender;
            $user->password=Hash::make($request->password);
            $user->remember_password=$request->password;
            $user->class_id=$request->class_id;
            $user->status=1;
            $user->role_id=2;
            if($user->save()){
                $this->notice::success('Successfully Registered');
                return redirect('/');
            }else
                $this->notice::error('something wrong! Please try again');
                return redirect('/');
        }catch(Exception $e){
            dd($e);
            $this->notice::error('something wrong! Please try again');
            return redirect('/');
        }

    }

    public function signInForm(){
        return view('authentication.login');
    }

    public function signInCheck(SigninRequest $request){
        try{
             $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        if ($user) {
            if ($user->status == 1) {
                if (Hash::check($request->password, $user->password)) {
                    $this->setSession($user);

                    // Check if the current user's role is 'employee'
                    if (currentUser() === 'student') {
                        $this->notice::success('Successfully Login');
                        return redirect()->route('student_dashboard'); // Redirect to employee dashboard
                    } else {
                        $this->notice::success('Successfully Login');
                        return redirect()->route('dashboard'); // Redirect to default dashboard
                    }
                } else {
                    $this->notice::error('Your User name or password is wrong!');
                    return redirect()->route('login');
                }
            } else {
                $this->notice::error('You are not an active user. Please contact the administrator.');
                return redirect()->route('login');
            }
        } else {
            $this->notice::error('Your User name or password is wrong!');
            return redirect()->route('login');
        }
    } catch (Exception $e) {
        dd($e);
        $this->notice::error('Your User name or password is wrong!');
        return redirect()->route('login');
    }
}

    public function setSession($user){
        return request()->session()->put([
                'userId'=>encryptor('encrypt',$user->id),
                'Name'=>encryptor('encrypt',$user->name),
                'username'=>encryptor('encrypt',$user->username),
                'birthday'=>$user->date_of_birth,
                'contact'=>$user->contact_no,
                'email'=>$user->email,
                'address'=>$user->address,
                'gender'=>$user->gender,
                'join'=>encryptor('encrypt',$user->created_at?->format('d-m-Y')),
                'role_id'=>encryptor('encrypt',$user->role_id),
                'accessType'=>encryptor('encrypt',$user->full_access),
                'role'=>encryptor('encrypt',$user->role->name),
                'roleIdentity'=>encryptor('encrypt',$user->role->identity),
                'image'=>$user->image ?? 'no-image.png'
            ]
        );
    }

    public function signOut(){
        request()->session()->flush();
        $this->notice::error('Successfully Logged Out!');
        return redirect('/');
    }

    public function show(User $data)
    {
        //  dd(session()->all());
        $profile = User::find(currentUserId());
        return view('user.profile', compact('data','profile')); 
    }

    public function forgotPassword()
    {
        return view('authentication.forget-password');
    }


    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ], 
        [
          'email.exists' => 'The email address does not exists.', // Customize the error message
        ]);

        $token = Str::random(64);

          DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->from('quiz@itjashim.com', 'Quiz');
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token) { 
        return view('authentication.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|confirmed'/*min:6|*/,
              'password_confirmation' => 'required'
          ]);
 
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect()->route('clientlogin')->with('message', 'Your password has been changed!');
    }
}