<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 01.02.2017
 * Time: 17:07
 */

namespace Core\Model;


use Core\Data\DataInterface;
use Core\Data\EntryTypeData;
use Core\Data\EntryTypeDataInterface;

class EntryType extends Model implements EntryTypeInterface {

    static public $tableDescriptor = array(
        'entry_types' => array(
            'alias' => 'et',
            'keys' => array('entry_type_id'),
        ),
    );

    /**
     * @return DataInterface[]
     */
    static public function createDataArray()
    {
        return array(new EntryTypeData());
    }

    /**
     * @param int $part
     * @return DataInterface|EntryTypeDataInterface
     * @throws \Core\Exception\DataArrayNotDefinedException
     * @throws \Core\Exception\StorageIsNullException
     */
    protected function getData($part = 0) { return parent::getData($part); }

    public function getId()
    {
        return $this->getData()->getEntryTypeId();
    }

    public function getName()
    {
        return $this->getData(0)->getEntryTypeName();
    }

    public function setName($name)
    {
        $this->getData(0)->setEntryTypeName($name);
        return $this;
    }
}