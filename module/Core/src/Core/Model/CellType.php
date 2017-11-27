<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 18:27
 */

namespace Core\Model;


use Core\Data\CellTypeData;

class CellType extends Model implements CellTypeInterface {

    static public $tableDescriptor = array(
        'cell_types' => array(
            'alias' => 'ct',
            'keys' => array('id'),
            'auto_increment' => 'id',
        ),
    );

    static public function createDataArray()
    {
        return array(new CellTypeData());
    }

    public function validate($value)
    {
        return true;
    }
} 