<?php

use App\Models\Order;
use App\Models\User;
use App\Notifications\NewOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('testtest', function(){
// // return 'test';
// $notification_channel = 'mail, database, boradcast';
// $channels = explode(',', $notification_channel);
// // return $channels;
// dd($channels);
// });


// Dont do this just for test only
// Route::get('send-notification', function(){
//     // $user = Auth::user();

//     // Mail::to($user->email)->send(new InvoiceMail());

//     // $user->notify(new newOrderNotification());
// });

// Route::get('invoice', function(){

//     // return view('pdf.invoice');
//     $order = Order::find(1);
//     $pdf = Pdf::loadView('pdf.invoice',['order' => $order]);
//     $pdf->save('invoices/latest.pdf');
// });


//this route when i use app/notification/NewOrder.php >> toDatabase()
Route::get('send-notify', function(){
    // $user = User::find(1);
    $user =Auth::user();

    $order = Order::find(2);

    $user->notify(new NewOrder($order));
     // theres an line under func. notify() coz the (Auth::user()) is not an object from the user
     // {User} has the func. notify() but {Auth::user} didn't have this func.
     // الأوث بجيب اليوزر الحالي الي هو اصلا انستانس من كلاس يوزر + طالما في يوزر مباشر بتعرف على الدالة
});

Route::get('read-notify', function(){
    return view('read_notify');
});

Route::get('read-notify/{id}', function($id){
    Auth::user()->notifications->find($id)->markAsRead();
    // Auth::user()->notifications->find($id)->update(['read_at' => now()]);
    return redirect()->back();
    // return redirect(Auth::user()->notifications->find($id)->data['url']);
})->name('readd');

Route::delete('delete-notify/{id}', function($id){
    Auth::user()->notifications->find($id)->delete();
    return redirect()->back();
})->name('deletee');

Route::get('read-all-notify', function(){
    // Auth::user()->notifications->markAsRead();
    Auth::user()->unreadnotifications->markAsRead();
    return redirect()->back();
})->name('read_all');
