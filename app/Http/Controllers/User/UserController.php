<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CommunicateUserRequest;
use App\Mail\CommunicateMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index() : View
    {
        $users = User::where('id','!=',Auth::user()->id)->paginate(10);
        return view('users.index',['users'=>$users]);
    }

    public function communicate(CommunicateUserRequest $request): JsonResponse
    {
        $user = User::where('id',$request->user_id)->first();
        $mailData = [
            'title' => $request->title,
            'body' => $request->body,
        ];

        Mail::to($user->email)->send(new CommunicateMail($mailData));
        return response()->json(['message'=>__('mail send successfully')]);
    }
}
