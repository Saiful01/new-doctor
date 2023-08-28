<?php


use App\Models\BankInformation;
use App\Models\Challenge;
use App\Models\ChallengeRating;
use App\Models\IdeaSupport;
use App\Models\SupportCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

function validatePhoneNumber($phone)
{
    if ($phone == null) {
        return 0;
    }
    if (substr($phone, 0, 1) != '0') {
        $phone = "0" . $phone;
    }
    $pattern = "/^(?:\+88|01)?(?:\d{11}|\d{13})$/";
    if (preg_match($pattern, $phone)) {
        return 1;
    }
}

function getOtp()
{

    return rand(1000, 9999);
}

function getExpireLimit()
{
    return 120;//In second
}

function sendSms($mobile, $message)
{
    return 1;


    $url = "https://smsc.ekshop.gov.bd/externalApi?passkey=099218bg45SD3SWQ12fsegewgerge&smsText=" . $message . "&client=challenge_new&number=" . $mobile;

    $client = new GuzzleHttp\Client();
    $res = $client->get($url);
    return $res->getStatusCode();


}
function sendEmail($data)
{
    try {
        Mail::send('user_create_mail', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->cc(['saiful013101@gmail.com'])
                ->subject($data['subject']);
        });
    }catch (\Exception $exception){
        return $exception->getMessage();
    }



}
function statusEmail($data)
{
    try {
        Mail::send('status_mail', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->cc(['saiful013101@gmail.com'])
                ->subject($data['subject']);
        });
    }catch (\Exception $exception){
        return $exception->getMessage();
    }



}
function invitationEmail($data)
{
    try {
        Mail::send('invitation_mail', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->cc(['saiful013101@gmail.com'])
                ->subject($data['subject']);
        });
    }catch (\Exception $exception){
        return $exception->getMessage();
    }



}
function applicantInvitationEmail($data)
{
    try {
        Mail::send('applicant_invitation_mail', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->cc(['saiful013101@gmail.com'])
                ->subject($data['subject']);
        });
    }catch (\Exception $exception){
        return $exception->getMessage();
    }



}

function getProcess()
{
    return [
        '1' => 'Shortlisting',
        '2' => 'Bootcamp',
        '3' => 'Technical Evaluation',
        '4' => 'Selection Committee',
        '5' => 'Agreement and disbursement',
        '6' => 'Mentoring',

    ];
}

function getUsermark($idea_id)
{

    $data = \App\Models\User::with('userIdeaMarkings.marking_category')->whereHas('userIdeaMarkings', function ($query) use ($idea_id) {
        $query->where('idea_id', $idea_id);
    })->get();
    if ($data) {
        return $data;
    } else {
        return "-";
    }
}

function detailsFormat($post)
{

    return Str::limit(strip_tags($post), 250, '...');

}
function getPlatformInfo()
{

    return \App\Models\PlatformInformation::first();

}

function problemstatementDetailsFormat($post)
{

    return Str::limit(strip_tags($post), 650, '...');

}

function detailsFormatReadMore($post)
{


    return Str::substr($post, 653);

}

function getYoutubeVideoId($link)
{
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $matches);
    if ($matches != null) {
        $video = $matches[0];
    } else {
        $video = "";
    }
    return $video;


    $link = '<iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';

// Extract video ID using regular expression
    preg_match('/embed\/([a-zA-Z0-9_-]+)/', $link, $matches);
    $videoId = $matches[1];

// Alternatively, you can use string manipulation
    $startPosition = strpos($link, 'embed/') + strlen('embed/');
    $endPosition = strpos($link, '"', $startPosition);
    $videoId = substr($link, $startPosition, $endPosition - $startPosition);

// Output the extracted video ID
    echo $videoId;

}

function getDateFormat($date)
{
    if ($date == null) {
        return "-";
    }
    $createdAt = Carbon::parse($date);
    return $createdAt->format('d M, Y g:i A');
}

function getDateOnly($date)
{
    if ($date == null) {
        return "-";
    }
    $createdAt = Carbon::parse($date);
    return $createdAt->format('d M Y');
}

function getTimeOnly($date)
{
    return Carbon::createFromFormat('H:i:s', $date)->format('h:i:s');
}
function getFooterChallenge()
{
    return Challenge::orderBy('created_at', 'DESC')->limit(3)->get();
}

function getPriceAmount($amount)
{
    if ($amount == null) {
        return "-";
    }
    return $formatted_price = number_format($amount, 2, '.', ',');

}

function getApplicantBankData()
{

    return BankInformation::where('applicant_id', '=', Auth::guard('applicant')->user()->id)->get();

}

function getSupportCategories()
{

    return SupportCategory::get();

}
function getApplicantIdeaSupport($idea_id)
{

    return IdeaSupport::with('support_category')->where('idea_id', '=', $idea_id)->get();;

}
function getChallengeFiveRating($id)
{

    return ChallengeRating::where('challenge_id', $id,)
        ->where('rating', '>', 4)
        ->where('rating', '<=', 5)->count();
}
function getChallengeFourRating($id)
{

    return ChallengeRating::where('challenge_id', $id,)
        ->where('rating', '>', 3)
        ->where('rating', '<=', 4)->count();
}
function getChallengeThreeRating($id)
{

    return ChallengeRating::where('challenge_id', $id,)
        ->where('rating', '>', 2)
        ->where('rating', '<=', 3)->count();
}
function getChallengeTwoRating($id)
{

    return ChallengeRating::where('challenge_id', $id,)
        ->where('rating', '>', 1)
        ->where('rating', '<=', 2)->count();
}
function getChallengeOneRating($id)
{

    return ChallengeRating::where('challenge_id', $id,)
        ->where('rating', '>', 0)
        ->where('rating', '<=', 1)->count();
}
function getChallengeAverageRating($id)
{

    $result= ChallengeRating::where('challenge_id', $id)
        ->selectRaw('COUNT(*) AS count, SUM(rating) AS sum, AVG(rating) AS avg')
        ->first();

    return number_format($result->avg);
}

?>



