<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2016
 * Time: 22:34
 */

namespace Core\Model;


interface UserInterface extends EntryInterface {

    /**
     * @return string
     */
    public function getLogin();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param string $login
     * @return UserInterface
     */
    public function setLogin($login);

    /**
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password);
}