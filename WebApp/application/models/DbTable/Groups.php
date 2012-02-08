<?php
/*
 * Copyright 2010, 2011 Denis FELICELLI for ecoparc
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
class   Model_DbTable_Groups extends Zend_Db_Table_Abstract
{
    protected   $_name = 'groupe_ordinateur';

    public  function getAllGroups()
    {
        return $this->fetchAll();
    }
    public function getTitlesGroups()
    {
        return $this->fetchAll('id_groupe_ordinateur', 'nom_groupe')->toArray();
    }

    public function addGroup($nom, $description, $planning_id_planning)
    {
        $data = array(
          'planning_id_planning' => $planning_id_planning,
          'nom_groupe' => $nom,
          'description' => $description,
        );
        return $this->insert($data);
    }
    public function modifyGroupNom($id_groupe_ordinateur, $nom)
    {
        $data = array(
          'nom_groupe' => $nom
        );
        return ($this->update($data, 'id_groupe_ordinateur = '.intval($id_groupe_ordinateur)));
    }
    public function modifyGroupDesc($id_groupe_ordinateur, $description)
    {
        $data = array(
          'description' => $description
        );
        return $this->update($data, 'id_groupe_ordinateur = '.intval($id_groupe_ordinateur));
    }
    public function modifyGroupPlanning($id_groupe_ordinateur, $planning_id_planning)
    {
        $data = array(
          'planning_id_planning' => $planning_id_planning
        );
        return $this->update($data, 'id_groupe_ordinateur = '.intval($id_groupe_ordinateur));
    }
    public function delGroup($id_groupe_ordinateur)
    {
        return $this->delete('id_groupe_ordinateur = '.intval($id_groupe_ordinateur));
    }
}

?>
