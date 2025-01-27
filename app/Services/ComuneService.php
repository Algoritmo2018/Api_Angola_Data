<?php

namespace App\Services;

use stdClass;
use App\DTOs\Comunes\CreateComuneDTO;
use App\DTOs\Comunes\UpdateComuneDTO;
use App\Repositories\Comune\ComuneRepositoryInterface;

class ComuneService
{


    public function __construct(
        protected ComuneRepositoryInterface $repository
    ) {}

    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null)
    {
        return $this->repository->paginate(
            page: $page,
            totalPerPage: $totalPerPage,
            filter: $filter,
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

    public function new(CreateComuneDTO $dto): stdClass
    {
        return $this->repository->new($dto);
    }
    public function update(UpdateComuneDTO $dto): stdClass|null
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
