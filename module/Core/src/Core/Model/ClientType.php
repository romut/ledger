<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 16:02
 */

namespace Core\Model;


use Core\Data\ClientTypeData;
use Core\Data\DataInterface;

class ClientType extends Model implements ClientTypeInterface {

    static public $tableDescriptor = array(
        'client_types' => array(
            'alias' => 'ct',
            'keys' => array('client_type_id'),
            'auto_increment' => 'client_type_id',
        ),
    );

    /**
     * @param int $part
     * @return \Core\Data\ClientTypeDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @return DataInterface[]
     */
    static public function createDataArray()
    {
        return array(new ClientTypeData());
    }

    public function getId()
    {
        return $this->getData()->getClientTypeId();
    }

    public function getName()
    {
        return $this->getData()->getClientTypeName();
    }

    public function setName($name)
    {
        $this->getData()->setClientTypeName($name);
        return $this;
    }
}