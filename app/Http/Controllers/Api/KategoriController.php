<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return response()->json([
            'status' => true,
            'messege' => 'data ada',
            'data'=> $kategoris,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|string|min:10',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' =>false,
                'message' => 'validasi error',
                'errors' =>$validator->errors()
            ], 422);
        }

        $kategoris = Kategori::create($request->all());
        return response()->json([
            'status' => true,
            'messege' => 'data terkirim',
            'data' => $kategoris,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategoris = Kategori::findOrFail($id);
         return response()->json([
            'status' => true,
            'messege' => 'show data ada',
            'data'=> $kategoris,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
