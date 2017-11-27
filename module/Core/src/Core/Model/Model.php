<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.01.2017
 * Time: 10:27
 */

namespace Core\Model;


use Core\Data\DataInterface;
use Core\Exception\DataArrayNotDefinedException;
use Core\Exception\StorageIsNullException;
use Core\Storage\ModelStorageInterface;

abstract class Model implements ModelInterface {



    static public function getClassFullName()
    {
        return __NAMESPACE__ . '\\' . __CLASS__;
    }

    const DATE_FORMAT = 'd.m.Y', TIME_FORMAT = 'H:i:s', DATETIME_FORMAT = 'd-m-Y H:i:s';
    const DB_DATE_FORMAT = 'Y-m-d', DB_TIME_FORMAT = 'H:i:s', DB_DATETIME_FORMAT = 'Y-m-d H:i:s';
    const DEFAULT_ENCODING = 'UTF-8', OS_ENCODING = 'CP1251', CONSOLE_ENCODING = 'CP866';

    /**
     * @var ModelStorageInterface $storage
     */
    private $storage;
    private $index;

    /**
     * @return ModelStorageInterface
     */
    public function getStorage() { return $this->storage; }

    protected function isDataNotDefined($part = 0)
    {
        return is_null($this->getStorage()) || is_null($this->storage->getModelData($this, $part));
    }

    /**
     * @param int $part
     * @throws DataArrayNotDefinedException
     * @throws StorageIsNullException
     * @return DataInterface
     */
    protected function getData($part = 0)
    {
        if (is_null($this->getStorage())) throw new StorageIsNullException();

        $data = $this->getStorage()->getModelData($this, $part);
        if (is_null($data)) throw new DataArrayNotDefinedException();

        return $data;
    }

    protected function beforeSave() {}
    protected function afterSave() {}

    /**
     * @param $string
     * @return string
     */
    static public function toOS($string)
    {
        return mb_convert_encoding($string, self::OS_ENCODING);
    }

    /**
     * @param $string
     * @return string
     */
    static public function fromOS($string)
    {
        return mb_convert_encoding($string, self::DEFAULT_ENCODING, self::OS_ENCODING);
    }

    /**
     * @param $string
     * @return string
     */
    static public function toConsole($string)
    {
        return mb_convert_encoding($string, self::CONSOLE_ENCODING);
    }

    /**
     * @param $string
     * @return string
     */
    static public function fromConsole($string)
    {
        return mb_convert_encoding($string, self::DEFAULT_ENCODING, self::CONSOLE_ENCODING);
    }

    static public function toDBDate($date)
    {
        return date_create($date)->format(self::DB_DATE_FORMAT);
    }

    static public function toDBTime($date)
    {
        return date_create($date)->format(self::DB_TIME_FORMAT);
    }

    static public function toDBDateTime($date)
    {
        return date_create($date)->format(self::DB_DATETIME_FORMAT);
    }

    static public function fromDBDate($date)
    {
        return date_create($date)->format(self::DATE_FORMAT);
    }

    static public function fromDBTime($date)
    {
        return date_create($date)->format(self::TIME_FORMAT);
    }

    static public function fromDBDateTime($date)
    {
        return date_create($date)->format(self::DATETIME_FORMAT);
    }

    /**
     * @param ModelStorageInterface $storage
     * @param int $index
     */
    public function __construct(ModelStorageInterface $storage, $index)
    {
        $this->storage = $storage;
        $this->index = $index;
    }

    public function __clone()
    {
        $this->index = $this->storage->createModelCopy($this);
    }

    public function __destruct()
    {
        $this->storage->removeModel($this);
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @return int|null
     */
    public function getModelId()
    {
        return null;
    }

    public function setModelId($modelId)
    {
        return $this;
    }

    /**
     * @return bool
     */
    public function isModified()
    {
        return !is_null($this->storage) && $this->storage->isModified($this);
    }

    /**
     * @return ModelInterface
     */
    public function save()
    {
        if (is_null($this->storage)) return $this;

        $this->beforeSave();
        $this->getStorage()->save($this);
        $this->afterSave();

        return $this;
    }
}