<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     * http://localhost:8000/api/bookings/
     */

     public function index(){
        return response()->json([
            'ok' => true,
            'message' => 'Retrieved Successfully',
            'data' => Booking::all()
        ], 200);
     }

     /**
      * Store a newly created resource in storage.
      * http://localhost:8000/api/bookings/
      */

      public function store(Request $request){

        $user = Auth::user();

        $validator = validator($request->all(), [
            'user_id' => 'required | exists:users,id',
            'room_id' => 'required | exists:rooms,id',
            'subject' => 'required | max:30',
            'start_time' => 'required | date_format:H:i',
            'end_time' => 'required | date_format:H:i',
            'day_of_week' => 'required | max:10',
            'status' => 'required | max:10',
            'book_until' => 'required | date'
        ]);

        if ($user->role == 'admin') {

            if($validator->fails()){
                return response()->json([
                    'ok' => false,
                    'message' => 'Booking Creation Failed',
                    'errors' => $validator->errors()
                ], 400);
            }
    
            $bookings = Booking::create($validator->validated());
            
    
            return response()->json([
                'ok' => true,
                'message' => 'Booking Created Successfully',
                'data' => $bookings
            ], 200);
          }

        if ($user->role !== 'admin') {
            
            $bookrequest = Booking::create([
                'user_id' => $request->user_id,
                'room_id' => $request->room_id,
                'subject' => $request->subject,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'day_of_week' => $request->day_of_week,
                'status' => "pending",
                'book_until' => $request->book_until
            ]);

            return response()->json([
                'ok' => true,
                'message' => 'Booking Created Successfully, Please wait for approval',
                'data' => $bookrequest
            ]);
        }
    }
       

      /**
       * display the specified resource.
       * http://localhost:8000/api/bookings/{id}
       */

       public function show($id){
        return response()->json([
            'ok' => true,
            'message' => 'Retrieved Successfully',
            'data' => Booking::find($id)
        ], 200);
       }

       /**
        * update the specified resource in storage.
        * http://localhost:8000/api/bookings/{id}
        */

        public function update(Request $request, $id){

            $user = Auth::user();

            if ($user->role !== 'admin') {
                return response()->json([
                    'ok' => false,
                    'message' => 'You are not authorized to update this booking, Please contact System Administrator',
                ], 400);
            }

            $validator = validator($request->all(), [
                'user_id' => 'required | exists:users,id',
                'room_id' => 'required | exists:rooms,id',
                'subject' => 'required | max:30',
                'start_time' => 'required | time',
                'end_time' => 'required | time',
                'day_of_week' => 'required | max:10',
                'status' => 'required | max:10',
                'book_until' => 'required | date'
            ]);

            if($validator->fails()){
                return response()->json([
                    'ok' => false,
                    'message' => 'Booking Update Failed',
                    'errors' => $validator->errors()
                ], 400);
            };

            $bookings = Booking::find($id);
            $bookings->update($validator->validated());
            return response()->json([
                'ok' => true,
                'message' => 'Booking Updated Successfully',
                'data' => $bookings
            ], 200);
        }

        /**
         * remove the specified resource from storage.
         * http://localhost:8000/api/bookings/{id}
         */

         public function destroy($id){
            $bookings = Booking::find($id);
            $bookings->delete();
            return response()->json([
                'ok' => true,
                'message' => 'Booking Deleted Successfully',
                'data' => $bookings
            ], 200);
         }
}
