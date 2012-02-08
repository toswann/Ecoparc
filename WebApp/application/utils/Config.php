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
class Form_Config extends Zend_Form
{
    public function  __construct($action, $options)
    {
        parent::__construct($options);
        $translate = Zend_Registry::get('Zend_Translate');
        $this->setName("config");
        
        $nextrequest = new Zend_Form_Element_Text('nextrequest');
        $nextrequest->setLabel($translate->_('nextrequest_min'))
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty')
                 ->setValue($options["nextrequest"])
                 ->addErrorMessage($translate->_('error_nextrequest'))
                 ->addValidator(new Zend_Validate_Int())
                ->addValidator(new Zend_Validate_Between(1, 120));
        // entre 1 et 120 and it's an int

        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('id', 'Send');
        $this->addElements(array($nextrequest, $envoyer));
    }
}

?>
