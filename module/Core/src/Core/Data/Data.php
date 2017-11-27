<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.01.2017
 * Time: 14:19
 */

namespace Core\Data;


class Data implements DataInterface {

    private $modified = false;
    private $selected = false;

    public function modified() { return $this->modified; }
    public function selected() { return $this->selected; }

    public function modify($modified = true)
    {
        $this->modified = $modified;
        return $this;
    }

    public function select($selected = true)
    {
        $this->selected = $selected;
        return $this;
    }

    protected function set(&$field, $value)
    {
        if ($field === $value) return $this;

        $field = $value;
        $this->modify();

        return $this;
    }
} 