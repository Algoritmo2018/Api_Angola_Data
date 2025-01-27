<?php

namespace App\Repositories\Comune;

use stdClass; 
use App\DTOs\Comunes\CreateComuneDTO;
use App\DTOs\Comunes\UpdateComuneDTO;
use App\Models\Comune; 
use App\Repositories\PaginationInterface;
use App\Repositories\PaginationPresenter; 

class ComuneEloquentORM implements ComuneRepositoryInterface
{
    public function __construct(
        protected Comune $model
    ) {}

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    { 
        $result = $this->model 
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query
                        ->where('name', 'like', "%{$filter}%")
                        ->orWhere('id', $filter); 
                }
            })
  ->with('municipality','municipality.province')
            ->orderBy('id', 'desc')
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    } 
    public function getAll(string $filter = null): array
    {

        return $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('name', 'like', "%{$filter}%");
                }
            })
            ->get()
            ->toArray();
    }
    public function findOne(int $id): stdClass|null
    {
        $Comune = $this->model
            ->find($id);
        if (!$Comune) {
            return null;
        }
        return  (object) $Comune->toArray();
    }
    public function delete(int $id): void
    {

        $this->model->findOrFail($id)->delete();
    }
    public function show_deleted(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface
    {
        $result = $this->model
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('deleted_at', '<>', null);
                    $query->where('name', 'like', "%{$filter}%");
                }
            })
            ->onlyTrashed()
            ->with('municipality','municipality.province')
            ->orderBy('id', 'desc')
            ->paginate($totalPerPage, ['*'], 'page', $page);

        return new PaginationPresenter($result);
    }
    public function restore_all()
    {
        $this->model->onlyTrashed()->restore();
    }
    public function restore_one(int $id)
    {
        $RestoreDeleted = $this->model->withTrashed()->find($id);
        $RestoreDeleted->restore();
    }
    public function new(CreateComuneDTO $dto): stdClass
    { 
       
        $Comune = $this->model->create(
            (array) $dto
        );
        return (object) $Comune->toArray();
    }
    public function update(UpdateComuneDTO $dto): stdClass|null
    {
        $Comune = $this->model->find($dto->id);
        if (!$Comune) {
            return null;
        }
        $dto = (array) $dto;
        if (!empty($dto['name'])) {
            $Comune->fill([
                'name' => $dto['name']
            ])->save();
        }
        if (!empty($dto['municipality_id'])) {
            $Comune->fill([
                'municipality_id' => $dto['municipality_id']
            ])->save();
        }
   
        return (object) $Comune->toArray();
    }
}
