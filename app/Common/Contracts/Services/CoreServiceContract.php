<?php

namespace App\Common\Contracts\Services;

use App\Common\Contracts\Repositories\RepositoryContract;

/**
 * Interface CoreServiceContract
 *
 * @package App\Common\Contracts\Services
 */
interface CoreServiceContract
{
	/**
	 * @return RepositoryContract
	 */
	public static function getRepository(): RepositoryContract;

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
}
