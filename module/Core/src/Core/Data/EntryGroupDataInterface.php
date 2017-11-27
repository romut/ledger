<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2017
 * Time: 12:40
 */

namespace Core\Data;


interface EntryGroupDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getEntryId();

    /**
     * @return int
     */
    public function getRightLevel();

    /**
     * @return int
     */
    public function getGroupId();

    /**
     * @param int $id
     * @return EntryGroupDataInterface
     */
    public function setEntryId($id);

    /**
     * @param int $level
     * @return EntryGroupDataInterface
     */
    public function setRightLevel($level);

    /**
     * @param int $groupId
     * @return EntryGroupDataInterface
     */
    public function setGroupId($groupId);
}