<?php

namespace App\Http\Controllers\Api\Shopping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shopping\ShoppingRequest;
use App\Http\Resources\Shopping\ShoppingResource;
use App\Http\Services\Shopping\ShoppingService;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ShoppingService $service)
    {

        return $service->getAllPaginate($request);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShoppingRequest $request, ShoppingService $service)
    {
        $shopping = $service->create($request);

        return response()->json([
            'data' => new ShoppingResource($shopping)
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, ShoppingService $service)
    {
        $shopping = $service->getById($id);
        
        return response()->json([
            $shopping
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShoppingRequest $request, $id, ShoppingService $service)
    {
        $shopping = $service->update($request, $id);

        return response()->json([
            'data' => new ShoppingResource($shopping)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ShoppingService $service)
    {
        $shopping = $service->delete($id);

        return response()->json([
            $shopping
        ],200);
    }
}
