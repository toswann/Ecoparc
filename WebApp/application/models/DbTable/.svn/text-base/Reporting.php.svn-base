<?php
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
require_once 'Computers.php';

class   Model_DbTable_Reporting extends Zend_Db_Table_Abstract
{
    protected   $_name = 'reporting';
    public      $id_ordi;
    public      $groupe;
    public      $date_debut;
    public      $date_fin;

    public  function getAllComputers()
    {
        $allComputerInfo = $this->fetchAll($where="ordinateur_id_ordinateur");
        return $allComputerInfo;
    }

    public  function getAllGroups()
    {
        $allGroupInfo = $this->fetchAll($where="groupe_ordinateur_id_groupe_ordinateur");
        return $allGroupInfo;
    }

    public function getReportingMinDate()
    {
        return $this->fetchRow('date_debut', 'date_debut ASC');
    }

    public function getReportingMaxDate()
    {
        return $this->fetchRow('date_fin', 'date_fin DESC');
    }


   public function getSelectedReporting($nom_ordi, $date_debut, $date_fin)
   {
       $query="ordinateur_nom = $nom_ordi";
       $getSelectedReporting = $this->fetchAll($where=$query);
   }

    public function getComputerName()
    {
        $computerName = $reporting->fetchAll();
        return $computerName;
        /*foreach ($computer as $com)
        {
           return $com;
        }*/
    }

    public function getPostData()
    {
        if (!empty($_POST))
        {


        }
    }
    
    public function addReportingData($id_ordinateur, $is_audit, $date, $last_received, $temps)
    {
        $data = array(
          'id_ordinateur' => $id_ordinateur,
          'is_audit' => $is_audit,
          'date' => $date,
          'last_received' => $last_received,
          'temps' => $temps
        );
        return $this->insert($data);
    }
    
    /* donnée pour un ordinateur en mode audit ou pas */
    public function getComputerConso($date_begin, $date_end, $id, $is_audit) {        
        $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from("ordinateur")
                        ->join("reporting", "ordinateur.id_ordinateur = reporting.id_ordinateur")
                        ->join("ordinateur_type", "ordinateur.id_ordinateur_type = ordinateur_type.id_ordinateur_type")
                        ->where('ordinateur.id_ordinateur = ? ', $id)
                        ->where('reporting.date >= ?', $date_begin)
                        ->where('reporting.date <= ?', $date_end)
                        ->where('reporting.is_audit = ?', $is_audit)
                        ->order('reporting.date ASC');
        
            $computerConsoSql  = $this->fetchAll($select);
            return $computerConsoSql;
    }

    public function getGroupConso($date_begin, $date_end, $id, $is_audit) {        
        $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from("ordinateur")
                        ->join("reporting", "ordinateur.id_ordinateur = reporting.id_ordinateur")
                        ->join("ordinateur_type", "ordinateur.id_ordinateur_type = ordinateur_type.id_ordinateur_type")
                        ->join("groupe_ordinateur", "ordinateur.groupe_ordinateur_id_groupe_ordinateur = groupe_ordinateur.id_groupe_ordinateur")
                        ->where('groupe_ordinateur.id_groupe_ordinateur = ? ', $id)
                        ->where('reporting.date >= ?', $date_begin)
                        ->where('reporting.date <= ?', $date_end)
                        ->where('reporting.is_audit = ?', $is_audit)
                        ->order('reporting.date ASC');
                           
                           
            $computerConsoSql  = $this->fetchAll($select);
            return $computerConsoSql;
    }
    
    public function getParcConso($date_begin, $date_end, $is_audit) {        
        $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from("ordinateur")
                        ->join("reporting", "ordinateur.id_ordinateur = reporting.id_ordinateur")
                        ->join("ordinateur_type", "ordinateur.id_ordinateur_type = ordinateur_type.id_ordinateur_type")
                        ->where('reporting.date >= ?', $date_begin)
                        ->where('reporting.date <= ?', $date_end)
                        ->where('reporting.is_audit = ?', $is_audit)
                        ->order('reporting.date ASC');
            $computerConsoSql  = $this->fetchAll($select);
            return $computerConsoSql;
    }
    
}

?>
