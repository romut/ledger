<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2017
 * Time: 13:05
 */

namespace Core\Data;


class EntryUserData extends Data implements EntryUserDataInterface {

    private $entryId;
    private $rightLevel;
    private $userId;
    private $actionDate;

    /**
     * @return int
     */
    public function getEntryId()
    {
        return $this->entryId;
    }

    /**
     * @return int
     */
    public function getRightLevel()
    {
        return $this->rightLevel;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getActionData()
    {
        return $this->actionDate;
    }

    /**
     * @param int $id
     * @return EntryUserDataInterface
     */
    public function setEntryId($id)
    {
        $this->set($this->entryId, $id);
        return $this;
    }

    /**
     * @param int $level
     * @return EntryUserDataInterface
     */
    public function setRightLevel($level)
    {
        $this->set($this->rightLevel, $level);
        return $this;
    }

    /**
     * @param int $id
     * @return EntryUserDataInterface
     */
    public function setUserId($id)
    {
        $this->set($this->userId, $id);
        return $this;
    }

    /**
     * @param string $date
     * @return EntryUserDataInterface
     */
    public function setActionDate($date)
    {
        $this->set($this->actionDate, $date);
        return $this;
    }
}