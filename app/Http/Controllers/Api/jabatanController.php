<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\jabatanModel;
use Illuminate\Http\Request;

class jabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jabatan = jabatanModel::all();
        return new PostResource(true, 'list jabatan',$jabatan );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jabatan = jabatanModel::create($request->all());

        return response()->json([
           'status' => 'success',
           'message' => 'jabatan created successfully',
           'data' => $jabatan
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(jabatanModel $jabatan)
    {
        return response()->json([
            'status' => 'true',
            'message' => 'Data found',
            'data' => $jabatan
         ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(jabatanModel $jabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jabatanModel $jabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(jabatanModel $jabatan)
    {
        $jabatan->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'jabatan deleted successfully',
            'data' => $jabatan
         ],200);
    }
}
