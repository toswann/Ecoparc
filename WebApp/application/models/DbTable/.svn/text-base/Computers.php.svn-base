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
class   Model_DbTable_Computers extends Zend_Db_Table_Abstract
{
    protected   $_name = 'ordinateur';

    public  function getAllComputers()
    {
        $row = $this->fetchAll();
        return $row;
    }
    
    public function getGroupComputer($id_group) {
        $res = $this->select()
                    ->from(array('o' => 'ordinateur'), "id_ordinateur")
                    ->where('groupe_ordinateur_id_groupe_ordinateur = ?', $id_group);
        return $res;
    }

        //@todo: new verion ! Denis
    public function modifyComputerNom($id_ordinateur, $nom)
    {
        $data = array(
          'nom' => $nom
        );
        return ($this->update($data, 'id_ordinateur = '.intval($id_ordinateur)));
    }
    public function modifyComputerDescription($id_ordinateur, $description)
    {
        $data = array(
          'description' => $description
        );
        return $this->update($data, 'id_ordinateur = '.intval($id_ordinateur));
    }
    public function modifyComputerGroup($id_ordinateur, $groupe_ordinateur_id_groupe_ordinateur)
    {
        $data = array(
          'groupe_ordinateur_id_groupe_ordinateur' => $groupe_ordinateur_id_groupe_ordinateur 
        );
        return $this->update($data, 'id_ordinateur = '.intval($id_ordinateur));
    }
    public function modifyComputerStatus($id_ordinateur, $status)
    {
        $data = array(
          'statut' => $status
        );
        return $this->update($data, 'id_ordinateur = '.intval($id_ordinateur));
    }
    public function modifyComputertype($id_ordinateur, $type)
    {
        $data = array(
          'id_ordinateur_type' => $type
        );
        return $this->update($data, 'id_ordinateur = '.intval($id_ordinateur));
    }
    public function delComputer($id_ordinateur)
    {
        return $this->delete('id_ordinateur = '.intval($id_ordinateur));
    }
    public function waitingComputers()
    {
        $where = "statut = '0'";
        $res = $this->fetchAll($where);
        return $res;
    }
}

?>
