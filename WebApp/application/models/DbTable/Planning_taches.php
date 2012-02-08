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
class   Model_DbTable_Planning_Taches extends Zend_Db_Table_Abstract
{
    protected   $_name = 'planning_taches';

    public function resizeTache($planning_id_planning, $id_planning_tache, $heure_fin)
    {
        $data = array(
          'planning_id_planning' => $planning_id_planning,
          'heure_fin' => $heure_fin,
        );
        return ($this->update($data, 'id_planning_tache = '.intval($id_planning_tache)));
    }

    public function delTache($id_planning_tache)
    {
        return $this->delete('id_planning_tache = '.intval($id_planning_tache));
    }
    public function dropTache($planning_id_planning, $id_planning_tache, $jour, $heure_debut, $heure_fin)
    {
        $data = array(
          'planning_id_planning' => $planning_id_planning,
          'jour' => $jour,
          'heure_debut' => $heure_debut,
          'heure_fin' => $heure_fin,
        );
        $res = $this->update($data, 'id_planning_tache = '.intval($id_planning_tache));
        return $res;
    }

    public function modTache($planning_id_planning, $id_planning_tache, $jour, $heure_debut, $heure_fin, $action, $nom)
    {
        $data = array(
          'planning_id_planning' => $planning_id_planning,
          'nom' => $nom,
          'jour' => $jour,
          'heure_debut' => $heure_debut,
          'heure_fin' => $heure_fin,
          'action' => $action,
        );
        return ($this->update($data, 'id_planning_tache = '.intval($id_planning_tache)));
    }
    public function addTache($planning_id_planning, $jour, $heure_debut, $heure_fin, $action, $nom)
    {
        $data = array(
          'planning_id_planning' => $planning_id_planning,
          'nom' => $nom,
          'jour' => $jour,
          'heure_debut' => $heure_debut,
          'heure_fin' => $heure_fin,
          'action' => $action,
        );
        return $this->insert($data);
    }
    public function getTaches($planning_id_planning)
    {
        $where = 'planning_id_planning = "'.$planning_id_planning.'"';
        return ($this->fetchAll($where));
    }
    public function delAllTaches($planning_id_planning)
    {
        return $this->delete('planning_id_planning = '.intval($planning_id_planning));
    }
}

?>
