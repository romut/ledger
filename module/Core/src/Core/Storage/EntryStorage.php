<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 10.06.2016
 * Time: 14:39
 */

namespace Core\Storage;

use Core\Exception\UnknownClientTypeException;
use Core\Exception\UnknownEntryTypeException;
use Core\Model\BookInterface;
use Core\Model\ClientTypeInterface;
use Core\Model\EntryInterface;
use Core\Model\ModelInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class EntryStorage extends ModelStorage implements EntryStorageInterface {

    /**
     * @var BookInterface $book
     */
    private $book;

    /**
     * @var ClientTypeInterface[] $clientTypes
     */
    private $clientTypes = array();

    /**
     * @var int[][] $checkedEntries
     */
    private $checkedEntries = array();

    /**
     * @return BookInterface
     */
    public function getBook() { return $this->book; }

    /**
     * @param BookInterface $book
     * @return EntryStorageInterface
     */
    public function setBook(BookInterface $book)
    {
        $this->book = $book;

        return $this;
    }

    public function getEntryType(EntryInterface $entry)
    {
        $modelName = ModelStorage::getModelName($entry);

        if (array_key_exists($modelName, $this->entryTypes)) {

            return $this->entryTypes[$modelName];
        }

        /**
         * @var EntryTypeInterface $entryType
         */
        $entryType = $this->select('Core\Model\EntryType', array('entry_type_name' => $modelName));

        if (is_null($entryType)) throw new UnknownEntryTypeException();
        $this->entryTypes[$entryType->getName()] = $entryType;

        return $entryType;
    }

    public function getClientType($clientTypeName)
    {
        if (array_key_exists($clientTypeName, $this->clientTypes)) {

            return $this->clientTypes[$clientTypeName];
        }

        /**
         * @var EntryTypeInterface $entryType
         */
        $clientType = $this->select('Core\Model\ClientType', array('client_type_name' => $clientTypeName));

        if (is_null($clientType)) throw new UnknownClientTypeException();
        $this->clientTypes[$clientTypeName] = $clientType;

        return $clientType;
    }

    /**
     * @param ModelInterface $model
     * @param int $part
     * @return \Core\Data\EntryDataInterface
     */
    public function getModelData(ModelInterface $model, $part = 0)
    {
        return parent::getModelData($model, $part);
    }

    /**
     * @param EntryInterface $entry
     * @param $level
     * @return bool
     */
    public function checkRight(EntryInterface $entry, $level)
    {
        //print __CLASS__ . '->' . __FUNCTION__ . "\n";

        return true;

        if (is_null($this->getBook()) || is_null($this->getBook()->getUser())) return false;

        if (
            array_key_exists($entry->getIndex(), $this->checkedEntries) &&
            array_key_exists($level, $this->checkedEntries[$entry->getIndex()])
        ) {

            return true;
        }

        $data = $this->getModelData($entry, 0);
        $user = $this->getBook()->getUser();

        $sql = new Sql($this->getDatabaseAdapter());
        $select = new Select();

        $select
            ->from(array('eg' => ($data->getDirectRights() ? 'entry_types' : 'entry_type_groups')))
            ->join(array('ug' => 'user_groups'), 'ug.group_id = eg.group_id')
        ;

        if ($data->getDirectRights() == 0) {

            $select->where(array('eg.entry_type_id = ?' => $data->getEntryType()));
        }
        else {

            $select->where(array('eg.entry_id = ?' => $data->getId()));
        }

        if ($level != EntryInterface::READ_LEVEL) $select->where(array('eg.level = ?' => $level));
        $select->where(array('ug.user_id = ?' => $user->getId()));

        $stmt = $sql->prepareStatementForSqlObject($select);
        //print 'Entry type = ' . $data->getEntryType() . '; User ID = ' . $user->getId() . ".\n";
        //print 'SQL: ' . $stmt->getSql() . "\n";
        $result = $stmt->execute();

        $return = (
            $result instanceof ResultInterface &&
            $result->isQueryResult() &&
            0 < $result->getAffectedRows()
        );

        if ($return) $this->checkedEntries[$entry->getIndex()][$level] = null;

        return $return;
    }

    public function resetCheckedEntries()
    {
        $this->checkedEntries = array();
        return $this;
    }
}