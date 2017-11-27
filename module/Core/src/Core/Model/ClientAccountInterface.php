<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 21.07.2017
 * Time: 17:06
 */

namespace Core\Model;


interface ClientAccountInterface extends ModelInterface {

    /**
     * @return string
     */
    public function getAccount();

    /**
     * @return int
     */
    public function getState();

    /**
     * @param ClientInterface $client
     * @return ClientAccountInterface
     */
    public function setClient(ClientInterface $client);

    /**
     * @param string $account
     * @return ClientAccountInterface
     */
    public function setAccount($account);

    /**
     * @param int $state
     * @return ClientAccountInterface
     */
    public function setState($state);
} 