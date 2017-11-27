<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 23.06.2016
 * Time: 14:44
 */

namespace Core\Data;


interface UserDataInterface extends DataInterface {

    public function getUserId();
    public function getLogin();
    public function getPassword();
    public function getName();

    /**
     * @param $id
     * @return UserDataInterface
     */
    public function setUserId($id);

    /**
     * @param $login
     * @return UserDataInterface
     */
    public function setLogin($login);

    /**
     * @param $password
     * @return UserDataInterface
     */
    public function setPassword($password);

    /**
     * @param $name
     * @return UserDataInterface
     */
    public function setName($name);
} 