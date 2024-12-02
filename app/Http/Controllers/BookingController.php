<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     * http://localhost:8000/api/bookings/retrieve
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
      * http://localhost:8000/api/bookings/store
      */

      public function store(Request $request){
        $validator = validator($request->all(), [
            'user_id' => 'required | exists:users,id',
            'room_id' => 'required | exists:rooms,id',
            'subject' => 'required | max:30',
            'start_time' => 'required | date',
            'end_time' => 'required | date',
            'day_of_week' => 'required | max:10',
            'status' => 'required | max:10',
            'book_until' => 'required | date'
        ]);

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

      /**
       * display the specified resource.
       * http://localhost:8000/api/bookings/show/{id}
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
        * http://localhost:8000/api/bookings/update/{id}
        */

        public function update(Request $request, $id){
            $validator = validator($request->all(), [
                'user_id' => 'required | exists:users,id',
                'room_id' => 'required | exists:rooms,id',
                'subject' => 'required | max:30',
                'start_time' => 'required | date',
                'end_time' => 'required | date',
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
         * http://localhost:8000/api/bookings/destroy/{id}
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
