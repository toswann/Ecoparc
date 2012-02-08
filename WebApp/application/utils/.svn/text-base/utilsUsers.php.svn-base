<?php
/*
 * Copyright 2010, 2011 Denis FELICELLI for ecoparc
 * 
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
class utilsUser
{
    // retourne le type de l'user loguÃ©
    public function getUserType()
    {
        $identity = Zend_Auth::getInstance()->getIdentity();
        $id_type = (Array)$identity;
        return $id_type['type'];
    }

    // retourne le nom de l'user loguÃ©
    public function getUserName()
    {
        $identity = Zend_Auth::getInstance()->getIdentity();
        $id_type = (Array)$identity;
        return $id_type['username'];
    }

    public function checkIfAdmin($obj)
    {
        $identity = Zend_Auth::getInstance()->getIdentity();
        $id_type = (Array)$identity;
        if ($id_type['type'] != 2)
            $obj->redirector('index', 'index');
    }
}

class Form_AddUsers extends Zend_Form
{
    public function  __construct($action, $options)
    {
        parent::__construct($options);
        $translate = Zend_Registry::get('Zend_Translate');
        $this->setName("add_user");
        
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel($translate->_('username'))
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty')
                 ->addErrorMessage($translate->_('error_username'));

        $type = new Zend_Form_Element_Select('type');
        $type->setLabel('Type')
             ->addMultiOptions(array(
                '0' => 'simple',
                '1' => 'reporting',
                "2" => "admin",
             ));;


         // selement si appele pour la modif
        if ($action == 'mod')
        {
            $username->setValue($options['username']);
            $type->setValue($options['type']);
            $id_user = new Zend_Form_Element_Hidden('id_user');
            $id_user->setValue($options['id_user']);
        }

        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('id', 'Send');
        if ($action == 'mod')
            $this->addElements(array($id_user, $username, $type, $envoyer));
        else
            $this->addElements(array($username, $type, $envoyer));


    }
}

?>
