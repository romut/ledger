<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.01.2017
 * Time: 11:21
 */

namespace Core\Storage;


use Core\Data\DataInterface;
use Core\Exception\ModelNotDefinedException;
use Core\Exception\ModelTypeNotDefinedException;
use Core\Exception\StorageIsNullException;
use Core\Model\ModelInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\HydratorInterface;

class ModelStorage implements ModelStorageInterface {

    const DATA_INDEX = 0, LAST_INDEX = 1, DESCRIPTOR_INDEX = 2, MODEL_ID_INDEX = 3;

    public static function getModelName(ModelInterface $model)
    {
        return get_class($model);
    }

    private $modelNames = array();

    /**
     * @var AdapterInterface
     */
    protected $dbAdapter;

    /**
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * @var array(array(ModelInterface, array(array(DataInterface)))) $data
     */
    protected $data = array();

    /**
     * @param $row
     * @param string $className
     * @throws ModelTypeNotDefinedException
     * @return ModelInterface
     */
    protected function hydrate($row, $className)
    {
        if (isset($row['class'])) {

            $className = $row['class'];
        }
        elseif (is_null($className)) {

            if (isset($row['model_type_id'])) {

                $className = $this->getModelClass($row['model_type_id']);
            }

            if (is_null($className)) throw new ModelTypeNotDefinedException();
        }

        $model = $this->createModel($className);

        for ($i = 0; $i < count($this->data[$className][self::DATA_INDEX][$model->getIndex()]); ++$i) {

            /**
             * @var DataInterface $data
             */
            $data = $this->data[$className][self::DATA_INDEX][$model->getIndex()][$i];

            $this->hydrator->hydrate($row, $data);
            $data->modify(false);
            $data->select(true);
        }

        return $model;
    }

    /**
     * @param AdapterInterface $dbAdapter
     * @param HydratorInterface $hydrator
     */
    public function __construct(AdapterInterface $dbAdapter = null, HydratorInterface $hydrator = null)
    {
        $this->dbAdapter = $dbAdapter;
        $this->hydrator = is_null($hydrator) ? new ClassMethods() : $hydrator;
    }

    /**
     * @return AdapterInterface
     */
    public function getDatabaseAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * @param AdapterInterface $adapter
     * @return ModelStorageInterface
     */
    public function setDatabaseAdapter(AdapterInterface $adapter)
    {
        $this->dbAdapter = $adapter;
        return $this;
    }

    /**
     * @param HydratorInterface $hydrator
     * @return ModelStorageInterface
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }

    /**
     * @param ModelInterface $model
     * @param int $part
     * @throws StorageIsNullException
     * @return DataInterface
     */
    public function getModelData(ModelInterface $model, $part = 0)
    {
        if (is_null($model)) return null;
        if (is_null($model->getIndex())) throw new StorageIsNullException();

        //print "getModelData (" . self::getModelName($model) . ", index " . $model->getIndex() . ") begin\n";
        //print_r($this->data);

        return $this->data[self::getModelName($model)][self::DATA_INDEX][$model->getIndex()][$part];
    }

    public function getModelClass($modelId)
    {
        if (!isset($this->modelNames[$modelId])) {

            $sql = new Sql($this->dbAdapter);
            $select = new Select();

            $select
                ->columns(array('model_class_name'))
                ->from('models')
                ->where(array('model_id = ?' => $modelId))
            ;

            $stmt = $sql->prepareStatementForSqlObject($select);
            $result = $stmt->execute();

            if (
                $result instanceof ResultInterface &&
                $result->isQueryResult() &&
                $result->getAffectedRows()
            ) {

                $className = $result->current()['model_class_name'];
                $this->modelNames[$modelId] = $className;

                if (!isset($this->data[$className])) {

                    $this->data[$className] = array(

                        self::DATA_INDEX => array(),
                        self::LAST_INDEX => 0,
                        self::DESCRIPTOR_INDEX => array(),
                        self::MODEL_ID_INDEX => $modelId
                    );
                }
            }
        }

        return isset($this->modelNames[$modelId]) ? $this->modelNames[$modelId] : null;
    }

    public function getModelId($className)
    {
        if (isset($this->data[$className])) return $this->data[$className][self::MODEL_ID_INDEX];

        $sql = new Sql($this->dbAdapter);
        $select = new Select();

        $select
            ->columns(array('model_id'))
            ->from('models')
            ->where(array('model_class_name = ?' => $className))
        ;

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        if (
            $result instanceof ResultInterface &&
            $result->isQueryResult() &&
            $result->getAffectedRows()
        ) {

            $this->data[$className] = array(

                self::DATA_INDEX => array(),
                self::LAST_INDEX => 0,
                self::DESCRIPTOR_INDEX => array(),
                self::MODEL_ID_INDEX => $result->current()['model_id']
            );
        }

        return isset($this->data[$className]) ? $this->data[$className][self::MODEL_ID_INDEX] : null;
    }

    /**
     * @param string $className
     * @throws ModelNotDefinedException
     * @return ModelInterface
     */
    public function createModel($className)
    {
        $modelId = $this->getModelId($className);
        if (is_null($modelId)) throw new ModelNotDefinedException($className);

        $index = $this->data[$className][self::LAST_INDEX]++;

        /**
         * @var ModelInterface $model
         */
        $this->data[$className][self::DATA_INDEX][$index] = $className::createDataArray();
        $model = new $className($this, $index);
        $model->setModelId($modelId);

        return $model;
    }

    /**
     * @param ModelInterface $model
     * @throws ModelNotDefinedException
     * @return int
     */
    public function createModelCopy($model)
    {
        $modelName = self::getModelName($model);

        if (!isset($this->data[$modelName])) throw new ModelNotDefinedException();

        $index = $this->data[$modelName][self::LAST_INDEX]++;

        /**
         * @var ModelInterface $model
         */
        $this->data[$modelName][self::DATA_INDEX][$index] = array();

        for ($i = 0; $i < count($this->data[$modelName][self::DATA_INDEX][$index]); ++$i) {

            $this->data[$modelName][self::DATA_INDEX][$index][$i] =
                clone $this->data[$modelName][self::DATA_INDEX][$model->getIndex()][$i];
        }

        return $index;
    }

    /**
     * @param ModelInterface $model
     * @return ModelStorageInterface
     */
    public function removeModel(ModelInterface $model)
    {
        unset($this->data[self::getModelName($model)][self::DATA_INDEX][$model->getIndex()]);

        return $this;
    }

    /**
     * @param ModelInterface $model
     * @return bool
     */
    public function isModified(ModelInterface $model)
    {
        $modified = false;
        $modelName = self::getModelName($model);
        $dataPartCount = count($this->data[$modelName][self::DATA_INDEX][$model->getIndex()]);

        for ($i = 0; $i < $dataPartCount && $modified == false; ++$i) {

            /**
             * @var DataInterface $dataPart
             */
            $dataPart = $this->data[$modelName][self::DATA_INDEX][$model->getIndex()][$i];
            if ($dataPart->modified()) $modified = true;
        }

        return $modified;
    }

    /**
     * @param string $modelName
     * @param int|array $id
     * @param null|string|array $order
     * @throws ModelTypeNotDefinedException
     * @return ModelInterface
     */
    public function select($modelName, $id, $order = null)
    {
        $sql = new Sql($this->dbAdapter);
        $select = new Select();
        $where = array();
        $ids = is_array($id) ? $id : ($id == '*' ? array() : array('id' => $id));

        foreach ($modelName::$tableDescriptor as $tableName => $table)
        {
            if (array_key_exists('relation', $table)) {

                $select->join(
                    array_key_exists('alias', $table) ? array($table['alias'] => $tableName) : $tableName,
                    (array_key_exists('alias', $table) ? $table['alias'] . '.' : '') . $table['relation']['slave_key'] .
                    ' = ' . $table['relation']['master_alias'] . '.' . $table['relation']['master_key']
                );
            }
            else {

                $select->from(
                    array_key_exists('alias', $table) ? array($table['alias'] => $tableName) : $tableName
                );
            }
        }

        if (isset($ids['folder_id'])) {

            $select->join(array('fe' => 'folder_entries'), 'e.entry_id = fe.entry_id');
        }

        foreach ($ids as $field => $value) {

            $where[$field . ' = ?'] = $value;
        }

        if (0 < count($where)) $select->where($where);
        if (!is_null($order)) $select->order($order);

        $stmt = $sql->prepareStatementForSqlObject($select);
        //print 'SQL: ' . $stmt->getSql() . "\n";
        $result = $stmt->execute();

        if ($result instanceof ResultInterface && $result->isQueryResult()) {

            if (!$result->getAffectedRows()) return null;

            $array = array();
            foreach ($result as $row) {

                $model = $this->hydrate($row, $modelName);
                $array[] = $model;
            }

            return (count($array) == 1 ? $array[0] : $array);
        }

        return null;
    }

    public function selectFolderEntries($id)
    {
        $sql = new Sql($this->dbAdapter);
        $select = new Select();

        $select
            ->columns('e.model_id', 'm.model_name')
            ->from(array('fe' => 'folder_entries', 'e' => 'entries', 'm' => 'models'))
            ->where(array('fe.folder_id = ?' => $id, 'fe.entry_id = e.entry_id', 'e.model_id = m.model_id'))
        ;

        $where = array();
        $ids = is_array($id) ? $id : ($id == '*' ? array() : array('id' => $id));

        return array();
    }

    /**
     * @param ModelInterface $model
     * @return ModelStorageInterface
     */
    public function save(ModelInterface $model)
    {
        //print __CLASS__ . '->' . __FUNCTION__ . ' (model type: ' . $model->getModelName() . ")\n";

        if (!$this->isModified($model)) return $this;

        $sql = new Sql($this->dbAdapter);
        $autoIncrement = array();

        $modelFullName = get_class($model);

        $i = 0;
        foreach ($modelFullName::$tableDescriptor as $tableName => $table) {

            $insert = $this->getModelData($model, $i)->selected() ? false : true;
            $action = $insert ? new Insert($tableName) : new Update($tableName);
            $data = $this->hydrator->extract($this->getModelData($model, $i));

            if ($insert) {

                if (array_key_exists('relation', $table) && 0 < count($autoIncrement)) {

                    $relation = $table['relation'];
                    if (
                        is_null($data[$relation['slave_key']]) &&
                        array_key_exists($relation['master_alias'], $autoIncrement) &&
                        array_key_exists($relation['master_key'], $autoIncrement[$relation['master_alias']])
                    ) {

                        $data[$relation['slave_key']] = $autoIncrement[$relation['master_alias']][$relation['master_key']];
                        $this->hydrator->hydrate(
                            array($relation['slave_key'] => $data[$relation['slave_key']]),
                            $this->getModelData($model, $i)
                        );

                        //print 'Relation hydrate to ' . $this->tables[$i]['name'] . ":\n";
                        //print_r($model->getData($i));
                    }
                }

                $action->values($data);
            }
            elseif (!$this->getModelData($model, $i)->modified()) {

                ++$i;
                continue;
            }
            else {

                $where = array();
                foreach ($table['keys'] as $key) {

                    $where[$key] = $data[$key];
                    unset($data[$key]);
                }

                $action->set($data);
                $action->where($where);
            }

            $stmt = $sql->prepareStatementForSqlObject($action);
            //print 'SQL: ' . $stmt->getSql() . "\n";
            $result = $stmt->execute();

            if ($insert && $result instanceof ResultInterface) {

                if (array_key_exists('auto_increment', $table) && $newId = $result->getGeneratedValue()) {

                    $alias = array_key_exists('alias', $table) ? $table['alias'] : $tableName;

                    $autoIncrement[$alias] = array($table['auto_increment'] => $newId);
                    $this->hydrator->hydrate($autoIncrement[$alias], $this->getModelData($model, $i));
                }
            }

            $this->getModelData($model, $i)->modify(false);
            $this->getModelData($model, $i)->select(true);

            ++$i;
        }

        return $this;
    }

    /**
     * @param ModelInterface $model
     * @return ModelStorageInterface
     */
    public function remove(ModelInterface $model)
    {
        // TODO: Implement remove() method.
    }
}