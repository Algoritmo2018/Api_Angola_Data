<?php

namespace App\Repositories\Comune;

use stdClass;
use App\DTOs\Comunes\CreateComuneDTO;
use App\DTOs\Comunes\UpdateComuneDTO;
use App\Repositories\PaginationInterface;

interface ComuneRepositoryInterface
{
    public function restore_all();
    public function restore_one(int $id);
    public function show_deleted(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function paginate2(int $page = 1, int $totalPerPage = 15, string $filter = null,string $filter2 = null): PaginationInterface;
    public function getAll(string $filter = null): array;
    public function findOne(int $id): stdClass|null;
    public function delete(int $id): void;
    public function new(CreateComuneDTO $dto): stdClass;
    public function update(UpdateComuneDTO $dto): stdClass|null;
}
