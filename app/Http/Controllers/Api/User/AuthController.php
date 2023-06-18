<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\users\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Traits\GeneralTrait;


class AuthController extends Controller
{
    use GeneralTrait;
        public function register(Request $request){
                try{
                // validation
                    $rules = [
                        "full_name" => "required|regex:/^[\pL\s\-]+$/u",
                        'sex'=>"required|in:male,female,other", 
                        'date_of_birth'=>"required",
                        'favourits'=>"required",
                        'country'=>"required",
                        'city'=>"required",
                        'address'=>"required|exists:provinces,name|string", 
                        'mobile'=>"required|regex:/^[0-9]+$/|unique:users,mobile|min:4|max:11",
                        'email' => "required|regex:/^[\pL\s\-]+$/u",
                        'password' => "required|regex:/^[\pL\s\-]+$/u",
                       
                        
                    ];
                    $messages = [
                        "required"=>"this filed is Required",
                        "full_name.regex"=>"this filed must be letters",
                        "in"=>"this value is not in the list",
                        "exists"=>"this province is not in the list",
                        "mobile.regex"=>"this filed shoud be numeric",
                        "mobile.min"=>"the mobile content very short",
                        "mobile.unique"=>"the mobile number has already been registered"

                    ];

                    $validator = Validator::make($request->all(), $rules , $messages);

                    if ($validator->fails()) {
                        $code = $this->returnCodeAccordingToInput($validator);
                        return $this->returnValidationError($code, $validator);
                    }

                    //register
                    $user = User::create([
                      
                        'full_name'=>$request->full_name,
                        'sex'=>$request->sex,
                        'date_of_birth'=>$request->date_of_birth,
                        'favourits'=>$request->favourits,
                        'country'=>$request->country,
                        'city'=>$request->city,
                        'address'=>$request->address,
                        'mobile'=>$request->mobile,
                        'email'=>$request->email,
                        'password'=>$request->password,
                     

                    ]);
                    $token = JWTAuth::fromUser($user);
                    if (!$token)
                         return $this->returnError('E001', 'an error Occurred , try again');

                    //return token
                    $msg = "Welcome, your profile successfully created";
                    return $this->returnData('token', $token , $msg);
            }catch(Exception $ex){
                return $this->returnError($ex->getCode(), $ex->getMessage());
            }
        }
        public function login(Request $request){
            try {
                //validation
                $rules = [
                    'email' => "required|regex:/^[\pL\s\-]+$/u",
                    'password' => "required|regex:/^[\pL\s\-]+$/u",
                ];
                $messages = [
                    "required"=>"this filed is Required"


                ];
                $validator = Validator::make($request->only(['email','password']), $rules , $messages);
                if ($validator->fails()) {
                    $code = $this->returnCodeAccordingToInput($validator);
                    return $this->returnValidationError($code, $validator);
                }

                // login

                // $credentials = $request->only(['email','password]);
                $email = $request->input('email');
                $password = $request->input('password');
                $userLogin = User::where('email' , '=' , $email && 'password' , '=' , $password)->first();
                if ($userLogin == null){
                    return $this->returnError('E001', 'This mail and password is incorrect, try again');
                }
                $token = JWTAuth::fromUser($userLogin);
                //return token
                $msg = "you are loggin successfully";
                return $this->returnData('token', $token , $msg);
            } catch (Exception $ex) {
                return $this->returnError($ex->getCode(), $ex->getMessage());

            }
        }
        public function logout(Request $request){
            $token = $request -> header('auth-token');
            if($token){
            try {

                JWTAuth::setToken($token)->invalidate(); //logout
            }catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                return  $this -> returnError('','some thing went wrongs');
            }
            return $this->returnSuccessMessage('Logged out successfully');
            }else{
                $this -> returnError('','some thing went wrongs');
            }

        }
}
