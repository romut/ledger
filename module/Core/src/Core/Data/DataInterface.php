<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.01.2017
 * Time: 10:22
 */

namespace Core\Data;


interface DataInterface {

    /**
     * @return bool
     */
    public function modified();

    /**
     * @return bool
     */
    public function selected();

    /**
     * @param bool $modified
     * @return DataInterface
     */
    public function modify($modified = true);

    /**
     * @param bool $selected
     * @return DataInterface
     */
    public function select($selected = true);
}