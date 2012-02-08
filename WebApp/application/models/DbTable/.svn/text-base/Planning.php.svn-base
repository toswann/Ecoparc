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
class   Model_DbTable_Planning extends Zend_Db_Table_Abstract
{
    protected   $_name = 'planning';

    public  function getAllPlannings()
    {
        return $this->fetchAll();
    }
    public function getOnePlanning($id_planning)
    {
        return $this->fetchRow('id_planning = '.$id_planning);
    }

    public function getTitlesPlannings()
    {
        return $this->fetchAll('id_planning', 'nom')->toArray();
    }

    public function addPlanning($nom, $description)
    {
        $data = array(
          'nom' => $nom,
          'description' => $description,
        );
        return $this->insert($data);
    }

    public function modifyPlanNom($id_planning, $nom)
    {
        $data = array(
          'nom' => $nom
        );
        return ($this->update($data, 'id_planning = '.intval($id_planning)));
    }
    public function modifyPlanDesc($id_planning, $description)
    {
        $data = array(
          'description' => $description
        );
        return $this->update($data, 'id_planning = '.intval($id_planning));
    }
    public function delPlan($id_planning)
    {
        return $this->delete('id_planning = '.intval($id_planning));
    }
}

?>
