<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2017
 * Time: 13:25
 */

namespace Core\Data;


interface GroupDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getGroupId();

    /**
     * @return string
     */
    public function getGroupName();

    /**
     * @return string
     */
    public function getGroupDescription();

    /**
     * @param int $id
     * @return GroupDataInterface
     */
    public function setGroupId($id);

    /**
     * @param string $name
     * @return GroupDataInterface
     */
    public function setGroupName($name);

    /**
     * @param string $description
     * @return GroupDataInterface
     */
    public function setGroupDescription($description);
} 