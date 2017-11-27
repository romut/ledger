<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 23.06.2016
 * Time: 14:49
 */

namespace Core\Data;


class UserData extends Data implements UserDataInterface {

    protected $userId;
    protected $login;
    protected $password;
    protected $name;

    public function getUserId()
    {
        return $this->userId;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $id
     * @return UserDataInterface
     */
    public function setUserId($id)
    {
        $this->set($this->userId, $id);
        return $this;
    }

    /**
     * @param $login
     * @return UserDataInterface
     */
    public function setLogin($login)
    {
        $this->set($this->login, $login);
        return $this;
    }

    /**
     * @param $password
     * @return UserDataInterface
     */
    public function setPassword($password)
    {
        $this->set($this->password, $password);
        return $this;
    }

    /**
     * @param $name
     * @return UserDataInterface
     */
    public function setName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }
}