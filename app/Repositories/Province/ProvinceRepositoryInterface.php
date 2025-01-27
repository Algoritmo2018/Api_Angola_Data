<?php

namespace App\Repositories\Province;

use stdClass;
use App\DTOs\Province\CreateProvinceDTO;
use App\DTOs\Province\UpdateProvinceDTO;
use App\Repositories\PaginationInterface;

interface ProvinceRepositoryInterface
{
    public function restore_all();
    public function restore_one(int $id);
    public function show_deleted(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
    public function paginate(int $page = 1, int $totalPerPage = 15, string $filter = null): PaginationInterface;
     public function getAll(string $filter = null): array;
    public function findOne(int $id): stdClass|null;
    public function delete(int $id): void;
    public function new(CreateProvinceDTO $dto): stdClass;
    public function update(UpdateProvinceDTO $dto): stdClass|null;
}
