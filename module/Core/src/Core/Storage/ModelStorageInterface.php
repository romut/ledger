<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.01.2017
 * Time: 10:19
 */

namespace Core\Storage;


use Core\Data\DataInterface;
use Core\Model\EntryInterface;
use Core\Model\ModelInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

interface ModelStorageInterface {

    /**
     * @return AdapterInterface
     */
    public function getDatabaseAdapter();

    /**
     * @param AdapterInterface $adapter
     * @return ModelStorageInterface
     */
    public function setDatabaseAdapter(AdapterInterface $adapter);

    /**
     * @param HydratorInterface $hydrator
     * @return ModelStorageInterface
     */
    public function setHydrator(HydratorInterface $hydrator);

    /**
     * @param ModelInterface $model
     * @param int $part
     * @return DataInterface
     */
    public function getModelData(ModelInterface $model, $part = 0);

    /**
     * @param int $modelId
     * @return string
     */
    public function getModelClass($modelId);

    /**
     * @param string $className
     * @return int
     */
    public function getModelId($className);

    /**
     * @param string $modelName
     * @return ModelInterface
     */
    public function createModel($modelName);

    /**
     * @param ModelInterface $model
     * @return int
     */
    public function createModelCopy($model);

    /**
     * @param ModelInterface $model
     * @return ModelStorageInterface
     */
    public function removeModel(ModelInterface $model);

    /**
     * @param ModelInterface $model
     * @return bool
     */
    public function isModified(ModelInterface $model);

    /**
     * @param string $modelName
     * @param int|array $id
     * @param null|string|array $order
     * @return ModelInterface
     */
    public function select($modelName, $id, $order = null);

    /**
     * @param int $folderId
     * @return EntryInterface[]
     */
    public function selectFolderEntries($folderId);

    /**
     * @param ModelInterface $model
     * @return ModelStorageInterface
     */
    public function save(ModelInterface $model);

    /**
     * @param ModelInterface $model
     * @return ModelStorageInterface
     */
    public function remove(ModelInterface $model);
}