<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PublicApiController extends Controller
{
    public function otpSent(Request $request)
    {
        if ((strpos(URL::previous(), "forgot-password") == true)) {
            $exist = Applicant::where('phone', $request->phone)->first();
            if (!$exist) {
                return [

                    'code' => 201,
                    'message' => "This phone number has no account, Please enter register Phone Number",
                    'data' => $request->all(),
                ];
            }

        } else {

            $validator = Validator::make($request->all(), [
                'phone' => 'unique:applicants',
            ]);

            if ($validator->fails()) {

                return [

                    'code' => 400,
                    'message' => "You have register Account for this Phone Number, Please login your account",
                    'data' => $request->all(),

                ];
            }
        }


        $phone = $request['phone'];
     /*   if (validatePhoneNumber($phone) != 1) {
            return [
                'code' => 201,
                'message' => "The number is not valid",
                'data' => $request->all(),
                'phone' => $phone,
            ];
        }*/

        $otp = getOtp();
        $is_exist = Otp::where('phone', $phone)->where('is_used', false)->orderBy('created_at', 'DESC')->first();
        if ($is_exist) {
            if (Carbon::parse($is_exist->created_at)
                    ->addSeconds(getExpireLimit()) >= \Carbon\Carbon::now()) {
                $message = "You have an active OTP";
                $code = 201;
                $expire_time = Carbon::parse($is_exist->created_at)->addSeconds(getExpireLimit());
                $time_expire = $expire_time->diffInSeconds(\Carbon\Carbon::now());

                return [
                    'code' => $code,
                    'message' => $message,
                    'time' => $time_expire,
                    'otp' => $is_exist->otp,
                ];
            } else {
                $code = 200;
                $message = "Check your inbox for OTP";
                Otp::create([
                    'phone' => $phone,
                    'otp' => $otp,
                ]);
                $sms = "Your Dr Mustafiz Appointment verification code is " . $otp;
                $sms_status = sendSms($phone, $sms);

            }
        } else {
            $code = 200;
            $message = "Check your inbox for OTP";

            $sms = "Your Dr Mustafiz Appointment verification code is " . $otp;
            $sms_status = sendSms($phone, $sms);
            Otp::create([
                'phone' => $phone,
                'otp' => $otp,
            ]);

        }
        return [
            'code' => $code,
            'message' => $message,
            'data' => $request->all(),
            'otp' => $otp,
        ];
    }

    public function otpVerify(Request $request)
    {

        //return $request->all();

        $phone_number = $request['phone'];
        $otp = $request['otp'];
        $is_exist = OTP::where('phone', $phone_number)->where('otp', $otp)->where('is_used', false)->orderBy('created_at', 'DESC')->first();
        if (!$is_exist) {
            return [
                'code' => 400,
                'message' => "OTP is wrong Please enter right OTP",
            ];
        } else {

            if (\Carbon\Carbon::parse($is_exist->created_at)
                    ->addSeconds(getExpireLimit()) < \Carbon\Carbon::now()) {

                return [
                    'code' => 400,
                    'message' => "OTP is Expired",
                ];

            } else {

                OTP::where('phone', $phone_number)->where('otp', $otp)->update(['is_used' => true]);
                return [
                    'code' => 200,
                    'message' => "OTP verified Successfully, please Fill next form",
                ];

            }
        }
    }

    public function registrationSave(Request $request)
    {

       // return $request->all();

        $request['password'] = Hash::make($request['password']);
        $createdAt = Carbon::parse($request['dob']);
        $request['dob']= $createdAt->format('d-m-y');
        try {
            $applicant = Applicant::create($request->all());
            Auth::guard('applicant')->loginUsingId($applicant->id);
            return [
                'code' => 200,
                'message' => "Congratulations! You have successfully registered",
            ];
        } catch (\Exception $e) {
            return [
                'code' => 400,
                'message' => $e->getMessage(),
            ];
        }

    }

    public function resetPassword(Request $request)
    {

        //return $request->all();
        $request['password'] = Hash::make($request['password']);
        $applicant = Applicant::where('phone', $request['phone'])->first();
        try {

            Applicant::where('id', $applicant->id)->update(['password' => $request['password']]);
            return [
                'code' => 200,
                'message' => "Your password has been successfully updated, Please Login Your Account",
            ];
        } catch (\Exception $e) {
            return [
                'code' => 400,
                'message' => $e->getMessage(),
            ];
        }

    }
}
