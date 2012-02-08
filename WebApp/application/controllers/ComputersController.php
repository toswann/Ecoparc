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
    require_once '../application/models/DbTable/Computers.php';
    require_once '../application/models/DbTable/Computerstype.php';
    require_once '../application/models/DbTable/Groups.php';
    require_once '../application/utils/Computers.php';
    require_once '../application/utils/Computerstype.php';

    class ComputersController extends AdminIntController
    {
        public function indexAction()
        {
            // get la liste de tous les ordi
            $computers = new Model_DbTable_Computers();
            $this->view->allComputers = $computers->getAllComputers();
            $this->view->waitingComputers = count($computers->waitingComputers());
            
            $groups = new Model_DbTable_Groups();
            $this->view->listgroups = utilsComputers::formatGroupsJson($groups->getTitlesGroups());
            $this->view->groupsArray = utilsComputers::formatGroups($groups->getTitlesGroups());
            
            $types = new Model_DbTable_Computerstype();
            $this->view->listtypes = utilsComputerstype::formatComputerstypeJson($types->getTitlesGroups());
            $this->view->typesArray = utilsComputerstype::formatComputerstype($types->getTitlesGroups());
        }

        public function modAction()
        {
            $action = $this->getRequest()->getParam('a');
            $id_ordinateur = $this->getRequest()->getParam('id_ordinateur');
            $computers = new Model_DbTable_Computers();
            if ($action == 'nom')
            {
                $nom =                  $this->getRequest()->getParam('nom');
                $this->view->return = $computers->modifyComputerNom($id_ordinateur, $nom);
            }
            else if ($action == 'description')
            {
                $description =          $this->getRequest()->getParam('description');
                $this->view->return = $computers->modifyComputerDescription($id_ordinateur, $description);
            }
            else if ($action == 'group')
            {
                $group =          $this->getRequest()->getParam('group');
                $this->view->return = $computers->modifyComputerGroup($id_ordinateur, $group);
            }
            else if ($action == 'status')
            {
                $status =          $this->getRequest()->getParam('status');
                $this->view->return = $computers->modifyComputerStatus($id_ordinateur, $status);
            }
            else if ($action == 'status')
            {
                $status =          $this->getRequest()->getParam('status');
                $this->view->return = $computers->modifyComputerStatus($id_ordinateur, $status);
            }
            else if ($action == 'type')
            {
                $type =          $this->getRequest()->getParam('type');
                $this->view->return = $computers->modifyComputerType($id_ordinateur, $type);
            }
        }
        public function delAction()
        {
            $id_ordinateur = $this->getRequest()->getParam('id_ordinateur');
            $computers = new Model_DbTable_Computers();
            $this->view->return = $computers->delComputer($id_ordinateur);
        }
    }
    
?>