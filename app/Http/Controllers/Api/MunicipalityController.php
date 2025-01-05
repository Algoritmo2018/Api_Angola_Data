<?php

namespace App\Http\Controllers\Api;

use App\Adapters\ApiAdapter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\MunicipalityService;
use App\DTOs\Municipality\CreateMunicipalityDTO;
use App\DTOs\Municipality\UpdateMunicipalityDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Municipality\StoreMunicipalityRequest;
use App\Http\Requests\Municipality\UpdateMunicipalityRequest; 
use App\Http\Resources\MunicipalityResource; 
 

class MunicipalityController extends Controller
{  
    public function __construct(
        protected MunicipalityService $service
    ) {}

    /**
     * Lista os cursos de uma determinada escola
     */
    public function index(Request $request)
    {
        $Municipalitys = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        return  ApiAdapter::toJson($Municipalitys);
    }
    //Lista os cursos de todas as escolas
    public function index2(Request $request)
    {
        $Municipalitys = $this->service->paginate2(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter,
            filter2: $request->filter2
        );

        return  ApiAdapter::toJson($Municipalitys);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMunicipalityRequest $request)
    {
        $Municipality = $this->service->new(CreateMunicipalityDTO::makeFromRequest($request));
        return new MunicipalityResource($Municipality);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMunicipalityRequest $request, string $id)
    { 
        $Municipality =
            $this->service->update(
                UpdateMunicipalityDTO::makeFromRequest($request)
            );
        if (!$Municipality) {
            return response()->json(['success' => false,'message' => 'Municipality not found'], Response::HTTP_NOT_FOUND);
        }
        return new MunicipalityResource($Municipality);
    }

    /**
     * Aplica o soft delete em um dado registro
     */
    public function destroy(int $id)
    {

        if (!$this->service->findOne($id)) {
            return response()->json(['success' => false,'message' => 'Municipality not found'], Response::HTTP_NOT_FOUND);
        }

        $this->service->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    //Traz todos os cursos que estão deletados
    public function show_deleted(Request $request)
    {

        $Municipalitys = $this->service->show_deleted(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        return  ApiAdapter::toJson($Municipalitys);
    }
    //Restaura todos os cursos deletados com o soft delete
    public function restore_all()
    {
        $this->service->restore_all();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    //Restaura todos os cursos deletados com o soft delete
    public function restore_one(int $id)
    {
        $this->service->restore_one($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}

