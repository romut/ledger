<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2016
 * Time: 22:35
 */

namespace Core\Model;


use Core\Data\DataInterface;
use Core\Data\EntryData;
use Core\Data\GroupData;

class Group extends Entry implements GroupInterface {

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('id'),
            'auto_increment' => 'id',
        ),
        'groups' => array(
            'alias' => 'g',
            'keys' => array('group_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'id',
                'slave_key' => 'group_id'
            ),
        )
    );

    /**
     * @return DataInterface[]
     */
    static public function createDataArray()
    {
        return array(new EntryData(), new GroupData());
    }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\GroupDataInterface
     * @throws \Core\Exception\NoPermissionException
     */
    protected function getData($part = 0)
    {
        return parent::getData($part);
    }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\GroupDataInterface
     * @throws \Core\Exception\NoPermissionException
     */
    protected function setData($part = 0)
    {
        return parent::setData($part);
    }

    public function getName()
    {
        return is_null($this->getData(1)) ? null : $this->getData(1)->getName();
    }

    public function setName($name)
    {
        if (is_null($this->getData(1))) return $this;

        $this->setData(1)->setName($name);
        return $this;
    }
}