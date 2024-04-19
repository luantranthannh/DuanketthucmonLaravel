<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dtos\Patient\BookingReq;
use App\Models\Banner;
use App\Repositories\PatientRepository;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;


class AddToCartController extends Controller
{
    public function index($patientId){
        $banners=Banner::all();
        $carts = DB::table('add_to_cart')
            ->where('add_to_cart.id', '=', $patientId) // Chỉ định rõ ràng bảng 'add_to_cart' cho cột 'id'
            ->orWhere('add_to_cart.patient_id', '=', $patientId) // Chỉ định rõ ràng bảng 'add_to_cart' cho cột 'patient_id'
            ->join('patients', 'add_to_cart.patient_id', '=', 'patients.id')
            ->join('list_time_doctor', 'add_to_cart.time_id', '=', 'list_time_doctor.id')
            ->join('doctors', 'add_to_cart.doctor_id', '=', 'doctors.id')
            ->leftJoin('users', 'doctors.user_id', '=', 'users.id')
            ->select('add_to_cart.*', 'list_time_doctor.*', 'users.*')
            ->get();
        return view('patients.Cart', ['carts' => $carts, 'banners' => $banners]);
    }

        function getCartById($patientId) {
            $cart = DB::table('add_to_cart')
            ->where('add_to_cart.id', '=', $patientId) // Chỉ định rõ ràng bảng 'add_to_cart' cho cột 'id'
            ->orWhere('add_to_cart.patient_id', '=', $patientId) // Chỉ định rõ ràng bảng 'add_to_cart' cho cột 'patient_id'
            ->join('patients', 'add_to_cart.patient_id', '=', 'patients.id')
            ->join('list_time_doctor', 'add_to_cart.time_id', '=', 'list_time_doctor.id')
            ->join('doctors', 'add_to_cart.doctor_id', '=', 'doctors.id')
            ->leftJoin('users', 'doctors.user_id', '=', 'users.id')
            ->select('add_to_cart.*', 'list_time_doctor.*', 'users.*')
            ->get();
    return $cart;   
        }

    public function add(Request $req)
    {
        $addToCart = new BookingReq($req);
        if ($addToCart->id == "") {
            return response()->json([
                'message' => 'Appointment failed',
            ], 404);
        }
        $newBooking = new Booking($addToCart->patientId, $addToCart->doctorId, $addToCart->date, $addToCart->id);
        $cart = new PatientRepository();
        $result = $cart->insertCart($newBooking);

        return response()->json([
            'message' => 'You have successfully booked your appointment',
        ], 200);
    }

    function deleteCart($cartId) {
        DB::table('add_to_cart')->where('id', $cartId)->delete();
    }
}