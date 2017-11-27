<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2017
 * Time: 13:27
 */

namespace Core\Data;

class GroupData extends Data implements GroupDataInterface {

    private $groupId;
    private $name, $description;

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @return string
     */
    public function getGroupName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getGroupDescription()
    {
        return $this->description;
    }

    /**
     * @param int $id
     * @return GroupDataInterface
     */
    public function setGroupId($id)
    {
        $this->set($this->groupId, $id);
        return $this;
    }

    /**
     * @param string $name
     * @return $this|GroupDataInterface
     */
    public function setName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }

    /**
     * @param string $description
     * @return GroupDataInterface
     */
    public function setDescription($description)
    {
        $this->set($this->description, $description);
        return $this;
    }
    
    public function setGroupName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }

    public function setGroupDescription($description)
    {
        $this->set($this->description, $description);
        return $this;
    }

}