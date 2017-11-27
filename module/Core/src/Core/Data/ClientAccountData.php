<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 21.07.2017
 * Time: 17:04
 */

namespace Core\Data;


class ClientAccountData extends Data implements ClientAccountDataInterface {

    private $id, $account, $state;

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getClientAccount()
    {
        return $this->account;
    }

    /**
     * @return int
     */
    public function getClientAccountState()
    {
        return $this->state;
    }

    /**
     * @param int $id
     * @return ClientAccountDataInterface
     */
    public function setClientId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param string $account
     * @return ClientAccountDataInterface
     */
    public function setClientAccount($account)
    {
        $this->set($this->account, $account);
        return $this;
    }

    /**
     * @param int $state
     * @return ClientAccountDataInterface
     */
    public function setClientAccountState($state)
    {
        $this->set($this->state, $state);
        return $this;
    }
}