<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(): JsonResponse
    {
        $notifications = Auth::user()->notifications;
        $data = [
            'unred_notifications_count' => $notifications->where('read_at', null)->count(),
            'total_notifications_count' => $notifications->count(),
            'notifications' => NotificationResource::collection($notifications),
        ];
        return response()->json(['message'=>__('Notification list fetched'),'data'=>$data]);
    }

    /**
     * Mark the notification as read
     */
    public function update(string $id): JsonResponse
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['message'=>__('Notification marked as read')]);
    }

    public function destroy($id): JsonResponse
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();
        return response()->json(['message'=>__('Notification deleted')]);

    }
}
