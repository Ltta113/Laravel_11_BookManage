<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Get all records.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get a single record by ID.
     *
     * @param int $id
     * 
     * @return Model|null
     */
    public function find(int $id): ?Model;

    /**
     * Create a new record.
     *
     * @param array $attributes
     * 
     * @return Model
     */
    public function create(array $attributes = []): Model;

    /**
     * Update an existing record.
     *
     * @param int $id
     * @param array $attributes
     * 
     * @return bool
     */
    public function update(int $id, array $attributes = []): bool;

    /**
     * Delete a record by ID.
     *
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id): bool;
}
