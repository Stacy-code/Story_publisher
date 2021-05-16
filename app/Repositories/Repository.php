<?php

namespace App\Repositories;

use App\Common\BaseObject\BaseObject;
use Illuminate\Database\Eloquent\Model;
use App\Common\Contracts\Repositories\RepositoryContract;
use Facade\Ignition\Exceptions\InvalidConfig;

/**
 * Class Repository
 *
 * @package App\Repositories
 *
 * @property Model $model
 */
abstract class Repository extends BaseObject implements RepositoryContract
{
    /**
     * @var Model|null
     */
    protected ?Model $entity = null;

    /**
     * @var string $modelClass
     */
    public string $modelClass;

    /**
     * @var Model $entityModel
     */
    public Model $entityModel;

    /**
     * @var array $saveData
     */
    public array $saveData;

    /**
     * @var string $processType
     */
    public string $processType;

    /**
     * AbstractRepository constructor.
     *
     * @param string|null $model
     *
     * @throws InvalidConfig
     */
    public function __construct($model = null)
    {
        if ($model) {
            $this->entity = $model;
        } else {
            throw new InvalidConfig('Model class must be load..');
        }
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->entity;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(array $data = []): array
    {
        $this->saveData = $data;
        $this->entityModel = new $this->modelClass();
        $this->processType = __FUNCTION__;
        return $this->processSave();
    }

    /**
     * @param string $id
     * @param array  $data
     *
     * @return array
     */
    public function update(string $id, array $data = []): array
    {
        $this->saveData = $data;
        $this->entityModel = $this->model
            ->find($id);
        $this->processType = __FUNCTION__;
        return $this->processSave();
    }

    /**
     * @param string $id
     *
     * @return array
     */
    public function delete(string $id): array
    {
        $this->entityModel = $this->model
            ->find($id);
        $this->processType = __FUNCTION__;
        return $this->processDelete();
    }

    /**
     * @return array
     */
    public function processSave(): array
    {
        return ['success' => false];
    }

    /**
     * @return array
     */
    public function processDelete(): array
    {
        return ['success' => false];
    }
}
