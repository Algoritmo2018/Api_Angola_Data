<?php

namespace App\Services;

use stdClass;
use App\DTOs\Province\CreateProvinceDTO;
use App\DTOs\Province\UpdateProvinceDTO;
use App\Repositories\Province\ProvinceRepositoryInterface;

class ProvinceService
{


    public function __construct(
        protected ProvinceRepositoryInterface $repository
    ) {}

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null)
    {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter,
        );
    }
    public function paginate2(int $page = 1, int $totalPerPage = 15, string $filter = null, string $filter2 = null)
    {
        return $this->repository->paginate2(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter,
            filter2: $filter2,
        );
    }

    public function getAll(string $filter = null): array
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(int $id): stdClass
    |null
    {
        return $this->repository->findOne($id);
    }

    public function new(CreateProvinceDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }
    public function update(UpdateProvinceDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(int $id): void
    {
         $this->repository->delete($id);
    }
    public function show_deleted(int $page = 1, int $totalPerPage = 15, string $filter = null)
    {
        return $this->repository->show_deleted(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter,
        );
    }
    public function restore_all()
    {
         $this->repository->restore_all();
    }
    public function restore_one(int $id)
    {
         $this->repository->restore_one($id);
    }
}
