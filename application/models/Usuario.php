<?php

/**
 * Description of Usuario
 *
 * @author Jarddel Antunes
 */
class Usuario extends Zend_Db_Table_Abstract {

    protected $_name = 'usuarios';
    protected $_primary = 'id';

    public function findBy($column='id', $value='') {
        $select = $this->select()->where($column . ' = ?', $value);
        return $this->fetchRow($select);
    }

    public function updateById($data) {
        $where = $this->getAdapter()->quoteInto('id = ?', $data->id);
        return $this->update($data->toArray(), $where);
    }

}

