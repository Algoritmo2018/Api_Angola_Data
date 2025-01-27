<?php

namespace App\Http\Controllers\Api;

use App\Adapters\ApiAdapter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ProvinceService;
use App\DTOs\Province\CreateProvinceDTO;
use App\DTOs\Province\UpdateProvinceDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Province\StoreProvinceRequest;
use App\Http\Requests\Province\UpdateProvinceRequest; 
use App\Http\Resources\ProvinceResource;  

class ProvinceController extends Controller
{
 
    public function __construct(
        protected ProvinceService $service
    ) {}

    /**
     * Lista as provincias de Angola 
     */
    public function index(Request $request)
    {
        $Provinces = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        return  ApiAdapter::toJson($Provinces);
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProvinceRequest $request)
    {
        $Province = $this->service->new(CreateProvinceDTO::makeFromRequest($request));
        return new ProvinceResource($Province);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvinceRequest $request, string $id)
    { 
        $Province =
            $this->service->update(
                UpdateProvinceDTO::makeFromRequest($request)
            );
        if (!$Province) {
            return response()->json(['success' => false,'message' => 'Province not found'], Response::HTTP_NOT_FOUND);
        }
        return new ProvinceResource($Province);
    }

    /**
     * Aplica o soft delete em um dado registro
     */
    public function destroy(int $id)
    {

        if (!$this->service->findOne($id)) {
            return response()->json(['success' => false,'message' => 'Province not found'], Response::HTTP_NOT_FOUND);
        }

        $this->service->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    //Traz todos as provincias que estão deletados
    public function show_deleted(Request $request)
    {

        $Provinces = $this->service->show_deleted(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        return  ApiAdapter::toJson($Provinces);
    }
    //Restaura todos as provincias deletados com o soft delete
    public function restore_all()
    {
        $this->service->restore_all();
        return response()->json([], 200);
    }

    //Restaura todos as provincias deletados com o soft delete
    public function restore_one(int $id)
    {
        $this->service->restore_one($id);

        return response()->json([], 200);
    }
}
