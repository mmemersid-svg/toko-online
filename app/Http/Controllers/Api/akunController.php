<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\akun;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class akunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akuns = akun::all();
        return response()->json([
            'status' => true,
            'messege' => 'data di tampilkan',
            'data' => $akuns,

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:akuns,email',
             'password' => 'required|string|min:8',
        ]);


        if($validator->fails()) {
            return response()->json([
                'status' =>false,
                'message' => 'validasi error',
                'errors' =>$validator->errors()
            ], 422);
        }

        $akuns = akun::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'status' => true,
            'messege' => 'validasi berhasil',
            'data' => $akuns,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $akuns = akun::findOrFail($id);
        return response()->json([
            'status' => true,
            'messege' => 'data show tampilkan' ,
            'data' => $akuns,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $akuns = akun::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name'     => 'required|sometimes|string|max:255',
                'email'    => 'required|sometimes|email|unique:akuns,email,', // <-- WAJIB ADA INI
                'password' => 'required|sometimes|string|min:8',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'validasi error',
                    'errors'  => $validator->errors()
                ], 422);
            }

            $akuns->update([
                'name'     => $request->name ? $request->name : $akuns->name,
                'email'    => $request->email ? $request->email : $akuns->email, // <-- Aman, tidak terhapus & lolos unique
                'password' => $request->password ? Hash::make($request->password) : $akuns->password,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'Data berhasil diperbarui',
                'data'    => $akuns,
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $akuns = akun::findOrFail($id);
        $akuns->delete();
        return response()->json([
            'status' => true,
            'messege' => 'data berhasil di hapus',

        ], 204);
    }
}
