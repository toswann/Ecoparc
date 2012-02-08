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
class Model_Form_User_Login extends Zend_Form  {

	public function init(){
		$this->setName('add_user');
                $translate = Zend_Registry::get('Zend_Translate');

                $email = new Zend_Form_Element_Text('email');
                $email->setLabel($translate->_('email_add'))
                         ->setRequired(true)
                         ->addFilter('StripTags')
                         ->addFilter('StringTrim')
                         ->addValidator('NotEmpty')
                         ->addErrorMessage("Email is required and can't be empty");


		$password = new Zend_Form_Element_Password('password');
		$password->setLabel($translate->_('pass_'))
			->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
                        ->addValidator('NotEmpty')
                        ->addErrorMessage("Email is required and can't be empty");

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton')
			->setLabel($translate->_('se_co'));

		$elements = array($email,$password, $submit);
		$this->addElements($elements);
	}

}

?>
