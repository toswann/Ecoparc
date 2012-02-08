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
    require_once '../application/models/DbTable/Computerstype.php';
    require_once '../application/models/DbTable/Groups.php';
    require_once '../application/utils/Computerstype.php';

    class ComputerstypeController extends AdminIntController
    {
        public function indexAction()
        {
            $computers = new Model_DbTable_Computerstype();
            $this->view->allComputerstype = $computers->getAllComputerstype();
            
            $form = new Form_AddComputerstype('');
            $this->view->form = $form;

            if ($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData))
                {
                    $nom = $form->getValue('nom');
                    $conso = $form->getValue('conso');
                    $computerstype = new Model_DbTable_Computerstype();
                    $computerstype->addComputertype($nom, $conso);
                    $this->_helper->redirector('index', 'computerstype');
                }
            else
                $form->populate($formData);
            }
        }

        public function modAction()
        {
            $action = $this->getRequest()->getParam('a');
            $id_ordinateur_type = $this->getRequest()->getParam('id_ordinateur_type');
            $computerstype = new Model_DbTable_Computerstype();
            if ($action == 'nom')
            {
                $nom =                  $this->getRequest()->getParam('nom');
                $this->view->return = $computerstype->modifyComputertypeNom($id_ordinateur_type, $nom);
            }
            else if ($action == 'conso')
            {
                $conso =          $this->getRequest()->getParam('conso');
                $this->view->return = $computerstype->modifyComputertypeConso($id_ordinateur_type, $conso);
            }
        }
        public function delAction()
        {
            $id_ordinateur_type = $this->getRequest()->getParam('id_ordinateur_type');
            $computerstype = new Model_DbTable_Computerstype();
            $this->view->return = $computerstype->delComputertype($id_ordinateur_type);
        }
    }
    
?>