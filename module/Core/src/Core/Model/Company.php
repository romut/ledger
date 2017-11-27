<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 18.01.2017
 * Time: 19:40
 */

namespace Core\Model;

use Core\Data\ClientData;
use Core\Data\CompanyData;
use Core\Data\EntryData;
use Core\Storage\EntryStorageInterface;

class Company extends Client implements CompanyInterface {

    const CLIENT_TYPE_NAME = 'Company';

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('entry_id'),
            'auto_increment' => 'entry_id',
        ),
        'clients' => array(
            'alias' => 'c',
            'keys' => array('client_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'client_id'
            ),
        ),
        'companies' => array(
            'alias' => 'co',
            'keys' => array('company_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'company_id'
            ),
        ),
    );

    static public function createDataArray() { return array(new EntryData(), new ClientData(), new CompanyData()); }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\ClientDataInterface|\Core\Data\CompanyDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\ClientDataInterface|\Core\Data\CompanyDataInterface
     */
    protected function setData($part = 0) { return parent::setData($part); }

    public function __construct(EntryStorageInterface $storage, $index)
    {
        parent::__construct($storage, $index);

        $this->clientType = $this->getStorage()->getClientType(self::CLIENT_TYPE_NAME);
        $this->getData(1)->setClientTypeId($this->clientType->getId());
        $this->getData(1)->modify(false);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->getData(2)->getCompanyCode();
    }

    /**
     * @param string $code
     * @return CompanyInterface
     */
    public function setCode($code)
    {
        $this->setData(2)->setCompanyCode($code);
        return $this;
    }
}