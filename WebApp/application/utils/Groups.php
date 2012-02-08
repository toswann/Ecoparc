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
require_once '../application/models/DbTable/Planning.php';

class utilsGroups
{
    public function formatPlanningJson($rows)
    {
        $result = " {";
        foreach($rows as $row)
        {
            $result .= "'".$row['id_planning']."':'".$row['nom']."', ";
        }
        return $result;
    }
    public function formatPlannings($rows)
    {
        $result = array();
        foreach($rows as $row)
        {
            $result[$row['id_planning']] = $row['nom'];
        }
        return $result;
    }
}

class Form_AddGroups extends Zend_Form
{
    public function  __construct($options, $planningSelect)
    {
        parent::__construct($options);
        $translate = Zend_Registry::get('Zend_Translate');
        $this->setName("add_group");

        $nom = new Zend_Form_Element_Text('nom');
        $nom->setLabel('nom')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty')
                 ->addErrorMessage($translate->_('error_name'));
        //-> a truduire!

        $description = new Zend_Form_Element_Text('description');
        $description->setLabel('description')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty')
                 ->addErrorMessage($translate->_('error_description'));

        $planning = new Zend_Form_Element_Select('planning');
        $planning->setLabel('planning')
             ->addMultiOptions($planningSelect);;

        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('id', 'Send');
        $this->addElements(array($nom, $description, $planning, $envoyer));
    }
}

?>
