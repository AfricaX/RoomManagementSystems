<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the room types.
     * http://localhost:8000/api/room_types
     */

     public function index(){
        return response()->json([
            'ok' => true,
            'message' => 'Retrieved Successfully',
            'data' => RoomType::all()
        ], 200);
     }

     /**
      * Create new room type
      *http://localhost:8000/api/room_types/
      */

      public function create(Request $request){
        $validator = validator($request->all(), [
            'room_type' => 'required | max:30 ',
        ]);
    
        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => 'Room Type Creation Failed',
                'errors' => $validator->errors()
            ], 400);
        }
    
        $room_type = RoomType::create($validator->validated());
        return response()->json([
            'ok' => true,
            'message' => 'Room Type Created Successfully',
            'data' => $room_type
        ], 200);
    }

    /**
     * Update room type
     *http://localhost:8000/api/room_types/{room_type}
     */

    public function update(Request $request, Roomtype $room_type) {
        $validator = validator($request->all(), [
            'room_type' => 'required|max:30',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'message' => 'Room Type Update Failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $room_type->update($validator->validated());
        return response()->json([
            'ok' => true,
            'message' => 'Room Type Updated Successfully',
            'data' => $room_type
        ], 200);
    }


    /**
     * Delete room type
     * http://localhost:8000/api/room_types
     */

     public function destroy(Roomtype $room_type){
        $room_type->delete();
        return response()->json([
            'ok' => true,
            'message' => 'Room Type Deleted Successfully',
            'data' => $room_type
        ], 200);
     }
}
