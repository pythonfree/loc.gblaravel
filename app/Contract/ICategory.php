<?php

namespace App\Contract;

interface ICategory
{
    public function getAll(): array;
    public function getIdBySlug(string $slug): ?int;
    public function getTitleBySlug(string $slug): ?string;
}
