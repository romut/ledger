<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 21.07.2017
 * Time: 17:09
 */

namespace Core\Model;


use Core\Data\ClientAccountData;
use Core\Data\DataInterface;

class ClientAccount extends Model implements ClientAccountInterface {

    static public $tableDescriptor = array(
        'client_accounts' => array(
            'alias' => 'ca',
            'keys' => array('client_id','client_account'),
        ),
    );

    /**
     * @return DataInterface[]
     */
    static public function createDataArray()
    {
        return array(new ClientAccountData());
    }

    /**
     * @param int $part
     * @return \Core\Data\ClientAccountDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->getData()->getClientAccount();
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->getData()->getClientAccountState();
    }

    /**
     * @param ClientInterface $client
     * @return $this|ClientAccountInterface
     */
    public function setClient(ClientInterface $client)
    {
        $this->getData()->setClientId($client->getId());
        return $this;
    }

    /**
     * @param string $account
     * @return ClientAccountInterface
     */
    public function setAccount($account)
    {
        $this->getData()->setClientAccount($account);
        return $this;
    }

    /**
     * @param int $state
     * @return ClientAccountInterface
     */
    public function setState($state)
    {
        $this->getData()->setClientAccountState($state);
        return $this;
    }
}