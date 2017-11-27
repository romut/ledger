<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2017
 * Time: 12:59
 */

namespace Core\Data;


interface EntryUserDataInterface extends DataInterface {

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
    public function getUserId();

    /**
     * @return string
     */
    public function getActionData();

    /**
     * @param int $id
     * @return EntryUserDataInterface
     */
    public function setEntryId($id);

    /**
     * @param int $level
     * @return EntryUserDataInterface
     */
    public function setRightLevel($level);

    /**
     * @param int $id
     * @return EntryUserDataInterface
     */
    public function setUserId($id);

    /**
     * @param string $date
     * @return EntryUserDataInterface
     */
    public function setActionDate($date);
} 