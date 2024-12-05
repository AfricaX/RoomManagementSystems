<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of section.
     * http://localhost:8000/api/sections
     */

     public function index(){
        return response()->json([
            'ok' => true,
            'message' => 'Retrieved Successfully',
            'data' => Section::all()
        ],200);
     }

     /**
      * Create section
      * http://localhost:8000/api/sections/
      */

      public function create(Request $request){
        $validator = validator($request->all(), [
            'section_name' => 'required | max:30',
            'section_type' => 'required | max:30'
        ]);

        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => 'Section Creation Failed',
                'errors' => $validator->errors()
            ], 400);
        }
            
        $sections = Section::create($validator->validated());
        return response()->json([
            'ok' => true,
            'message' => 'Section Created Successfully',
            'data' => $sections
        ], 200);
      }

      /**
       * Update section
       * http://localhost:8000/api/sections/{id}
       */

       public function update(Request $request, $id){
        $validator = validator($request->all(), [
            'section_name' => 'required | max:30',
            'section_type' => 'required | max:30'
        ]);

        if($validator->fails()){
            return response()->json([
                'ok' => false,
                'message' => 'Section Update Failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $sections = Section::find($id);
        $sections->update($validator->validated());
        return response()->json([
            'ok' => true,
            'message' => 'Section Updated Successfully',
            'data' => $sections
        ], 200);
       }

       /**
        * Show specific section
        * http://localhost:8000/api/sections/{id}
        */

        public function show($id){
           return response()->json([
               'ok' => true,
               'message' => 'Retrieved Successfully',
               'data' => Section::find($id)
           ], 200);
        }

        /**
         * Delete section
         * http://localhost:8000/api/sections/{id}
         */

         public function destroy($id){
            $sections = Section::find($id);
            $sections->delete();
            return response()->json([
                'ok' => true,
                'message' => 'Section Deleted Successfully',
                'data' => $sections
            ], 200);
         }
}
