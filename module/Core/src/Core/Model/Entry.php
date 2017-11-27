<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2016
 * Time: 22:31
 */

namespace Core\Model;

use Core\Data\EntryDataInterface;
use Core\Exception\NoPermissionException;
use Core\Storage\EntryStorageInterface;

abstract class Entry extends Model implements EntryInterface {

    /**
     * @var EntryTypeInterface $entryType
     */
    private $entryType;

    /**
     * @var EntryInterface
     */
    private $parent;

    /**
     * @var GroupInterface[] $entryGroups
     */
    private $entryGroups;

    /**
     * @var UserInterface[] $entryUsers
     */
    private $entryUsers;

    private function loadParent()
    {
        if (is_null($this->parent) && !is_null($this->getData()) && !is_null($this->getData()->getParentId())) {

            /**
             * @var EntryTypeInterface $entryType
             */
            $entryType = $this->getStorage()->select('EntryType', $this->getData()->getEntryTypeId());
            $this->parent = $this->getStorage()->select($entryType->getName(), $this->getData()->getParentId());
        }

        return $this->parent;
    }

    private function loadEntryGroups()
    {
        if (is_null($this->entryGroups));
        return $this->entryGroups;
    }

    /**
     * @param int $part
     * @throws NoPermissionException
     * @return EntryDataInterface
     */
    protected function getData($part = 0)
    {
        if (!$this->checkRight(self::READER_LEVEL)) throw new NoPermissionException();

        return parent::getData($part);
    }

    /**
     * @param int $part
     * @return EntryDataInterface
     */
    protected function getDirectData($part = 0)
    {
        return parent::getData($part);
    }

    /**
     * @param int $part
     * @throws NoPermissionException
     * @return EntryDataInterface
     */
    protected function setData($part = 0)
    {
        if (!$this->checkRight(self::EDITOR_LEVEL)) throw new NoPermissionException();

        return parent::getData($part);
    }

    /**
     * @return EntryStorageInterface
     */
    public function getStorage() { return parent::getStorage(); }

    public function setModelId($modelId)
    {
        $this->getDirectData()->setModelId($modelId);
        return $this;
    }

    /**
     * @return BookInterface
     */
    protected function getBook()
    {
        return is_null($this->getStorage()) ? null : $this->getStorage()->getBook();
    }

    /**
     * @throws NoPermissionException
     * @return int
     */
    public function getId()
    {
        if (!$this->checkRight(self::READER_LEVEL)) throw new NoPermissionException();

        return is_null($this->getData()) ? null : $this->getData()->getEntryId();
    }

    /**
     * @return string
     * @throws NoPermissionException
     */
    public function getName()
    {
        if (!$this->checkRight(self::READER_LEVEL)) throw new NoPermissionException();

        return is_null($this->getData()) ? null : $this->getData(0)->getEntryId();
    }

    /**
     * @return array
     * @throws NoPermissionException
     */
    public function getDescription()
    {
        if (!$this->checkRight(self::READER_LEVEL)) throw new NoPermissionException();

        return '';
    }

    /**
     * @throws NoPermissionException
     * @return EntryInterface
     */
    public function getParent()
    {
        if (!$this->checkRight(self::READER_LEVEL)) throw new NoPermissionException();

        return $this->loadParent();
    }

    /**
     * @param EntryInterface $parent
     * @throws NoPermissionException
     * @return EntryInterface
     */
    public function setParent(EntryInterface $parent)
    {
        if (!$this->checkRight(self::EDITOR_LEVEL)) throw new NoPermissionException();

        $this->parent = $parent;

        return $this;
    }

    /**
     * @throws NoPermissionException
     * @return EntryInterface
     *
     */
    public function sign()
    {
        if (!$this->checkRight(self::SIGNER_LEVEL)) throw new NoPermissionException();

        return $this;
    }

    /**
     * @param int $level
     * @return bool
     */
    public function checkRight($level = self::READER_LEVEL)
    {
        return is_null($this->getStorage()) || $this->getStorage()->checkRight($this, $level);
    }

    /**
     * @throws NoPermissionException
     * @return EntryInterface
     */
    public function unsign()
    {
        if (!$this->checkRight(self::SIGNER_LEVEL)) throw new NoPermissionException();

        return $this;
    }

    /**
     * @throws NoPermissionException
     * @return EntryInterface
     */
    public function execute()
    {
        if (!$this->checkRight(self::EXECUTOR_LEVEL)) throw new NoPermissionException();

        return $this;
    }

    /**
     * @throws NoPermissionException
     * @return EntryInterface
     */
    public function rollback()
    {
        if (!$this->checkRight(self::EXECUTOR_LEVEL)) throw new NoPermissionException();

        return $this;
    }

    /**
     * @return bool
     */
    public function isSigned()
    {
        return $this->getData(0)->getState() == self::SIGNED_STATE;
    }

    /**
     * @return bool
     */
    public function isExecuted()
    {
        return $this->getData(0)->getState() == self::EXECUTED_STATE;
    }
}