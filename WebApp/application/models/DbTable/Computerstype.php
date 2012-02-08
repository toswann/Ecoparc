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
class   Model_DbTable_Computerstype extends Zend_Db_Table_Abstract
{
    protected   $_name = 'ordinateur_type';

    public  function getAllComputerstype()
    {
        $row = $this->fetchAll();
        return $row;
    }
     public function getTitlesGroups()
    {
        return $this->fetchAll('id_ordinateur_type', 'nom_type')->toArray();
    }
    
    public function addComputertype($nom, $conso)
    {
        $data = array(
          'nom_type' => $nom,
          'conso' => $conso,
        );
        return $this->insert($data);
    }

    public function modifyComputertypeNom($id_ordinateur_type, $nom)
    {
        $data = array(
          'nom_type' => $nom
        );
        return ($this->update($data, 'id_ordinateur_type = '.intval($id_ordinateur_type)));
    }
    public function modifyComputertypeConso($id_ordinateur_type, $conso)
    {
        $data = array(
          'conso' => $conso
        );
        return ($this->update($data, 'id_ordinateur_type = '.intval($id_ordinateur_type)));
    }
    public function delComputertype($id_ordinateur_type)
    {
        return $this->delete('id_ordinateur_type = '.intval($id_ordinateur_type));
    }

}

?>
