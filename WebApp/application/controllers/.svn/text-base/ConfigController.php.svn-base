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
    require_once '../application/controllers/AdminIntController.php';
    require_once '../application/models/DbTable/Users.php';
    require_once '../application/utils/Config.php';

    class ConfigController extends AdminIntController
    {
        public function indexAction()
        {
            $translate = Zend_Registry::get('Zend_Translate');
            $path = "../config/config.ini";
            $config = new Zend_Config_Ini($path, 'general', array('skipExtends'=> true,'allowModifications' => true));
            $options['nextrequest'] = $config->srv->nextRequest;
            $form = new Form_Config('add', $options);
            $form->envoyer->setLabel($translate->_('save'));
            $this->view->form = $form;
            
            if ($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData))
                {
                    $nextrequest = $form->getValue('nextrequest');

                    $config->srv->nextRequest  = $nextrequest;
                    $writer = new Zend_Config_Writer_Ini(array('config'=> $config,'filename' => $path));
                    $writer->write();
                }
            else
                $form->populate($formData);
            }
            
            $this->view->auditMode = $config->auditMode;
            if ($this->view->auditMode == true)
            {
                $this->view->days = $config->endDate; // 
            }
            
        }
        
        public function startauditAction()
        {
            $path = "../config/config.ini";
            $config = new Zend_Config_Ini($path, 'general', array('skipExtends'=> true,'allowModifications' => true));
            $config->auditMode  = TRUE;
            $config->startDate = strftime("%d/%m/%Y", mktime(0, 0, 0, date('m'), date('d'), date('y')));
            $config->endDate = strftime("%d/%m/%Y", mktime(0, 0, 0, date('m'), date('d')+31, date('y')));
            
            $writer = new Zend_Config_Writer_Ini(array('config'=> $config,'filename' => $path));
            $writer->write();
            
            $this->view->return = 1;
            $this->_helper->redirector('index','config');
        }
        public function stopauditAction()
        {
            $path = "../config/config.ini";
            $config = new Zend_Config_Ini($path, 'general', array('skipExtends'=> true,'allowModifications' => true));
            $config->auditMode  = FALSE;
            $config->startDate = "";
            $config->endDate = "";
            
            $writer = new Zend_Config_Writer_Ini(array('config'=> $config,'filename' => $path));
            $writer->write();
            
            $this->view->return = 1;  
            $this->_helper->redirector('index','config');
        }
    }
    
?>