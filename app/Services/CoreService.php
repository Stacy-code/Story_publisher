<?php

namespace App\Services;

use App\Repositories\Repository;
use App\Common\BaseObject\BaseObject;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Services\CoreServiceTrait;
use App\Common\Contracts\Services\CoreServiceContract;

/**
 * Class CoreService
 *
 * @package App\Data\Services
 */
abstract class CoreService extends BaseObject implements CoreServiceContract
{
    use CoreServiceTrait;

    /**
     * @var self|null $instance
     */
    private static ?self $instance = null;

    /**
     * @var string $modelClass
     */
    public static string $modelClass;

    /**
     * @var string $repositoryClass
     */
    public static string $repositoryClass;

    /**
     * @var Repository $repository
     */
    public Repository $repository;

    /**
     * @var Model $model
     */
    public static Model $model;

    /**
     * CoreService constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->setInstance($this);
    }

    /**
     * @param CoreService $service
     */
    private function setInstance(CoreService $service): void
    {
        self::$instance = $service;
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        $static = static::class;
        self::$instance = new $static(
            new static::$repositoryClass(new static::$modelClass())
        );
        return self::$instance;
    }

    /**
     * @return Repository
     */
    public static function getRepository(): Repository
    {
        return self::getInstance()->repository;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data = []): array
    {
        $result = $this->repository->create($data);
        $result['msg'] = $result['success']
            ? 'Успешно сохранено' : 'Ошибка сохранения';
        return $result;
    }

    /**
     * @param string $id
     * @param array  $data
     *
     * @return array
     */
    public function update(string $id, array $data = []): array
    {
        $result = $this->repository->update($id, $data);
        $result['msg'] = $result['success']
            ? 'Успешно сохранено' : 'Ошибка сохранения';
        return $result;
    }

    /**
     * @param string $id
     *
     * @return array
     */
    public function delete(string $id): array
    {
        $result = $this->repository->delete($id);
        $result['msg'] = $result['success']
            ? 'Успешно удалено' : 'Ошибка удаления';
        return $result;
    }
}
