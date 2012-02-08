<?php
/*
 * Copyright 2010, 2011 Denis FELICELLI for ecoparc
 * http://s-jdm.developpez.com/tutoriels/php/traductions/debuter-avec-zend-framework/#LIX
 */
//
//This file is part of Ecoparc.
//
//Ecoparc is free software: you can redistribute it and/or modify
//it under the terms of the GNU General Public License as published by
//the Free Software Foundation, either version 3 of the License, or
//(at your option) any later version.
//
//Ecoparc is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.
//
//You should have received a copy of the GNU General Public License
//along with Ecoparc.  If not, see <http://www.gnu.org/licenses/>.
//
class   Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected   $_name = 'users';

    public  function getAllUsers()
    {
        $row = $this->fetchAll();
        return $row;
    }

    public function checkIfExist($username)
    {
        $where = 'username = "'.$username.'"';
        $row = $this->fetchRow($where);
        if ($row != null)
            return true;
        return false;
    }

    public function addUser($username, $type, $password)
    {
        $data = array(
          'username' => $username,
          'type' => $type,
          'password' => md5($password),
        );
        return $this->insert($data);
    }
    public function initPass($id, $password)
    {
        $data = array('password' => md5($password));
        $this->update($data, 'id_user = '.(int)$id);
    }

    public function getUserInfo($id)
    {
        return ($this->fetchRow('id_user = '.$id));
    }
    public function modifyUser($id, $username, $type)
    {
        $data = array(
            'username' => $username,
            'type' => $type,
            );
        $this->update($data, 'id_user = '.(int)$id);
    }


    //@todo: new verion ! Denis
    public function modifyUserNom($id_user, $nom)
    {
        $data = array(
          'username' => $nom
        );
        return ($this->update($data, 'id_user = '.intval($id_user)));
    }
    public function modifyUserType($id_user, $type)
    {
        $data = array(
          'type' => $type
        );
        return $this->update($data, 'id_user = '.intval($id_user));
    }
    public function delUser($id_user)
    {
        return $this->delete('id_user = '.intval($id_user));
    }
}

?>
