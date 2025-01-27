<?php


namespace App\Http\Controllers\Api;

use App\Adapters\ApiAdapter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\ComuneService;
use App\DTOs\Comunes\CreateComuneDTO;
use App\DTOs\Comunes\UpdateComuneDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comune\StoreComuneRequest;
use App\Http\Requests\Comune\UpdateComuneRequest; 
use App\Http\Resources\ComuneResource; 


class ComuneController extends Controller
{
 
    public function __construct(
        protected ComuneService $service
    ) {}

    /**
     * Lista os cursos de uma determinada escola
     */
    public function index(Request $request)
    {
        $Comunes = $this->service->paginate(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        return  ApiAdapter::toJson($Comunes);
    }
    //Lista os cursos de todas as escolas
    public function index2(Request $request)
    {
        $Comunes = $this->service->paginate2(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter,
            filter2: $request->filter2
        );

        return  ApiAdapter::toJson($Comunes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComuneRequest $request)
    {
        $Comune = $this->service->new(CreateComuneDTO::makeFromRequest($request));
        return new ComuneResource($Comune);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComuneRequest $request, string $id)
    { 
        $Comune =
            $this->service->update(
                UpdateComuneDTO::makeFromRequest($request)
            );
        if (!$Comune) {
            return response()->json(['success' => false,'message' => 'Comune not found'], Response::HTTP_NOT_FOUND);
        }
        return new ComuneResource($Comune);
    }

    /**
     * Aplica o soft delete em um dado registro
     */
    public function destroy(int $id)
    {

        if (!$this->service->findOne($id)) {
            return response()->json(['success' => false,'message' => 'Comune not found'], Response::HTTP_NOT_FOUND);
        }

        $this->service->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    //Traz todos os cursos que estão deletados
    public function show_deleted(Request $request)
    {

        $Comunes = $this->service->show_deleted(
            page: $request->get('page', 1),
            totalPerPage: $request->get('per_page', 15),
            filter: $request->filter
        );

        return  ApiAdapter::toJson($Comunes);
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

