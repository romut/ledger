<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2017
 * Time: 12:54
 */

namespace Core\Data;


class EntryGroupData extends Data implements EntryGroupDataInterface {

    private $entryId;
    private $rightLevel;
    private $groupId;

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
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int $id
     * @return EntryGroupDataInterface
     */
    public function setEntryId($id)
    {
        $this->set($this->entryId, $id);
        return $this;
    }

    /**
     * @param int $level
     * @return EntryGroupDataInterface
     */
    public function setRightLevel($level)
    {
        $this->set($this->rightLevel, $level);
        return $this;
    }

    /**
     * @param int $groupId
     * @return EntryGroupDataInterface
     */
    public function setGroupId($groupId)
    {
        $this->set($this->groupId, $groupId);
        return $this;
    }
}