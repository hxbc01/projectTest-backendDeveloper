<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\statusKepegawaianModel;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class statusKepegawaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = statusKepegawaianModel::all();
        return new PostResource(true, 'list status pegawai',$status );
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = statusKepegawaianModel::create($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'status kepegawaian created successfully',
            'data' => $status
         ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\statusKepegawaianModel  $statusKepegawaianModel
     * @return \Illuminate\Http\Response
     */
    public function show(statusKepegawaianModel $statusKepegawaianModel)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'status kepegawaian created successfully',
            'status_kepegawaian' => $statusKepegawaianModel
         ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\statusKepegawaianModel  $statusKepegawaianModel
     * @return \Illuminate\Http\Response
     */
    public function edit(statusKepegawaianModel $statusKepegawaianModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\statusKepegawaianModel  $statusKepegawaianModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, statusKepegawaianModel $statusKepegawaianModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\statusKepegawaianModel  $statusKepegawaianModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(statusKepegawaianModel $statusKepegawaianModel)
    {
        $statusKepegawaianModel->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'status kepegawaian created successfully',
            'data' => $statusKepegawaianModel
         ],200);
    }
}
