<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\AddOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public static function middleware(): array
    {
        return [
            'permission:view-orders|create-orders|edit-orders|delete-orders'
        ];
    }
    public function index() : View
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $orders = Order::paginate(10);
        }else{
            $orders = Order::where('user_id',$user->id)->paginate(10);
        }
        return view('orders.index',['orders'=>$orders]);
    }

    public function create() : View
    {
        return view('orders.create');
    }

    public function edit($id) : View
    {
        $user = Auth::user();
        if ($user->hasRole('admin')) {
            $order = Order::where(['id'=>$id])->first();
        }else{
            $order = Order::where(['user_id'=>Auth::user()->id,'id'=>$id])->first();
        }
        if ($order) {
            return view('orders.edit',['order'=>$order]);
        }
        abort(404);
    }

    public function store(AddOrderRequest $request): RedirectResponse
    {
        $order = Order::create($request->validated());
        $order->user_id = Auth::user()->id;
        $order->save();
        // Get the admin (or multiple admins)
        $users = User::role('admin')->get();
        // Notify all admins
        foreach ($users as $user)
        {
            $user->notify(new NewOrderNotification($order));
        }
        return redirect()->route('orders.index')->with('success', 'Order submitted successfully.');
    }


    public function update(UpdateOrderRequest $request,$id) : RedirectResponse
    {
        $order = Order::find($id);
        $order->update([
            'location'=>$request->location,
            'size'=>$request->size,
            'weight'=>$request->weight,
            'pickup_time'=>$request->pickup_time,
            'delivery_time'=>$request->delivery_time,
            'status'=>$request->status,
            'user_id'=>Auth::user()->id,
        ]);
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function delete(Request $request): RedirectResponse
    {
        Order::where(['id' => $request['id']])->delete();
        return back();
    }
}
