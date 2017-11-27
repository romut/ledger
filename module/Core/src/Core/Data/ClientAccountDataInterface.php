<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 21.07.2017
 * Time: 17:01
 */

namespace Core\Data;


interface ClientAccountDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getClientId();

    /**
     * @return string
     */
    public function getClientAccount();

    /**
     * @return int
     */
    public function getClientAccountState();

    /**
     * @param int $id
     * @return ClientAccountDataInterface
     */
    public function setClientId($id);

    /**
     * @param string $account
     * @return ClientAccountDataInterface
     */
    public function setClientAccount($account);

    /**
     * @param int $state
     * @return ClientAccountDataInterface
     */
    public function setClientAccountState($state);
}