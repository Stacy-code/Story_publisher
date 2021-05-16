<?php

namespace App\Common\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryContract
 *
 * @package App\Common\Contracts\Repositories
 */
interface RepositoryContract
{
    /**
     * @return Model
     */
    public function getModel(): Model;

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data = []): array;

    /**
     * @param string $id
     * @param array  $data
     *
     * @return array
     */
    public function update(string $id, array $data = []): array;

    /**
     * @param string $id
     *
     * @return array
     */
    public function delete(string $id): array;

    /**
     * @return array
     */
    public function processSave(): array;

    /**
     * @return array
     */
    public function processDelete(): array;
}
