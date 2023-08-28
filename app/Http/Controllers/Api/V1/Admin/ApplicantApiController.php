<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use App\Http\Resources\Admin\ApplicantResource;
use App\Models\Applicant;
use App\Models\Otp;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ApplicantApiController extends Controller
{
    public function otpSent(Request $request)
    {


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



        $phone = $request['phone'];
          if (validatePhoneNumber($phone) != 1) {
               return [
                   'code' => 400,
                   'message' => "The number is not valid",
                   'data' => $request->all(),
                   'phone' => $phone,
               ];
           }

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
        $validator = Validator::make($request->all(), [

            "phone" => 'required',
            "otp" => 'required',

        ]);

        if ($validator->fails()) {
            return [
                'code' => 400,
                'message' => 'validation error',
                'errors' => $validator->errors(),
                'request_data' => $request->all(),
            ];
        }

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
                    'message' => "OTP verified Successfully",
                ];

            }
        }
    }

    public function registrationSave(Request $request)
    {

        // return $request->all();


        $validator = Validator::make($request->all(), [
            "name" => 'required',
            "phone" => 'required|unique:applicants',
            "password" => 'required',
            "gender" => 'required',
            "age" => 'required',
            "dob" => 'required',
            "blood_group" => 'required'
        ]);

        if ($validator->fails()) {
            return [
                'code' => 400,
                'message' => 'validation error',
                'errors' => $validator->errors(),
                'request_data' => $request->all(),
            ];
        }

        $request['password'] = Hash::make($request['password']);
        $createdAt = Carbon::parse($request['dob']);
        $request['dob']= $createdAt->format('d-m-y');
        try {
            $applicant = Applicant::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Registration Successfully Done',
                'token' =>$applicant->createToken("Patient API Token")->plainTextToken,
                'applicant_data' => $applicant,
            ], 200);

        } catch (\Exception $e) {
            return [
                'code' => 400,
                'message' => $e->getMessage(),
            ];
        }

    }
    public function patientLogin(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'phone' => 'required',
                    'password' => 'required'
                ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 400);
            }

            if (!Auth::guard('applicant')->attempt($request->only(['phone', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Phone & Password does not match with our record.',
                ], 400);
            }

            $applicant = Applicant::where('phone', $request->phone)->first();

            return response()->json([
                'status' => true,
                'message' => 'Patient Logged In Successfully',
                'token' =>$applicant->createToken("Patient API Token")->plainTextToken,
                'applicant_data' => $applicant,
            ], 200);

        } catch (\Exception $exception) {

            return response()->json([
                'status' => false,
                'message' => $exception->getMessage()
            ], 400);
        }

    }
    public function index()
    {
        // abort_if(Gate::denies('applicant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApplicantResource(Applicant::with(['division', 'district', 'upazila'])->get());
    }

    public function store(StoreApplicantRequest $request)
    {
        $applicant = Applicant::create($request->all());

        return (new ApplicantResource($applicant))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Applicant $applicant)
    {
        //abort_if(Gate::denies('applicant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ApplicantResource($applicant->load(['division', 'district', 'upazila']));
    }

    public function update(UpdateApplicantRequest $request, Applicant $applicant)
    {
        $applicant->update($request->all());

        return (new ApplicantResource($applicant))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Applicant $applicant)
    {
        // abort_if(Gate::denies('applicant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $applicant->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
