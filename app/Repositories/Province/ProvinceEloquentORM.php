<?php

namespace App\Repositories\Province;

use stdClass; 
use App\DTOs\Province\CreateProvinceDTO;
use App\DTOs\Province\UpdateProvinceDTO;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PaginationInterface;
use App\Repositories\PaginationPresenter; 

class ProvinceEloquentORM implements ProvinceRepositoryInterface
{
    public function __construct(
        protected Province $model
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
        $Province = $this->model
            ->find($id);
        if (!$Province) {
            return null;
        }
        return  (object) $Province->toArray();
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
    public function new(CreateProvinceDTO $dto): stdClass
    { 
       
        $Province = $this->model->create(
            (array) $dto
        );
        return (object) $Province->toArray();
    }
    public function update(UpdateProvinceDTO $dto): stdClass|null
    {
        $Province = $this->model->find($dto->id);
        if (!$Province) {
            return null;
        }
        $dto = (array) $dto;
        if (!empty($dto['name'])) {
            $Province->fill([
                'name' => $dto['name']
            ])->save();
        }
   
        return (object) $Province->toArray();
    }
}
