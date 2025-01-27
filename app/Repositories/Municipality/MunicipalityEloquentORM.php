<?php

namespace App\Repositories\Municipality;

use stdClass;
use App\DTOs\Municipality\CreateMunicipalityDTO;
use App\DTOs\Municipality\UpdateMunicipalityDTO;
use App\Models\Municipality;
use App\Repositories\PaginationInterface;
use App\Repositories\PaginationPresenter;

class MunicipalityEloquentORM implements MunicipalityRepositoryInterface
{
    public function __construct(
        protected Municipality $model
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
            ->with('province')
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
        $Municipality = $this->model
            ->find($id);
        if (!$Municipality) {
            return null;
        }
        return  (object) $Municipality->toArray();
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
    public function new(CreateMunicipalityDTO $dto): stdClass
    {

        $Municipality = $this->model->create(
            (array) $dto
        );
        return (object) $Municipality->toArray();
    }
    public function update(UpdateMunicipalityDTO $dto): stdClass|null
    {
        $Municipality = $this->model->find($dto->id);
        if (!$Municipality) {
            return null;
        }
        $dto = (array) $dto;
        if (!empty($dto['name'])) {
            $Municipality->fill([
                'name' => $dto['name']
            ])->save();
        }
        if (!empty($dto['province_id'])) {
            $Municipality->fill([
                'province_id' => $dto['province_id']
            ])->save();
        }

        return (object) $Municipality->toArray();
    }
}
