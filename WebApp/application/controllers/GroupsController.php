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
    require_once '../application/models/DbTable/Groups.php';
    require_once '../application/models/DbTable/Planning.php';
    require_once '../application/utils/Groups.php';

    class GroupsController extends AdminIntController
    {
        public function indexAction()
        {
            $groups = new Model_DbTable_Groups();
            $this->view->allGroups = $groups->getAllGroups();

            $planning = new Model_DbTable_Planning();
            $this->view->listplanning = utilsGroups::formatPlanningJson($planning->getTitlesPlannings());
            $planningArray = $this->view->planningArray = utilsGroups::formatPlannings($planning->getTitlesPlannings());

            $form = new Form_AddGroups('', $planningArray);
            $this->view->form = $form;

            if ($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData))
                {
                    $nom = $form->getValue('nom');
                    $description = $form->getValue('description');
                    $planning = $form->getValue('planning');
                    $groups = new Model_DbTable_Groups();
                    $groups->addGroup($nom, $description, $planning);
                    $this->_helper->redirector('index', 'groups');
                }
            else
                $form->populate($formData);
            }
        }

        public function modAction()
        {
            $action = $this->getRequest()->getParam('a');
            $id_groupe_ordinateur = $this->getRequest()->getParam('id_groupe_ordinateur');
            $groups = new Model_DbTable_Groups();
            if ($action == 'planning')
            {
                $planning_id_planning = $this->getRequest()->getParam('planning_id_planning');
                $this->view->return = $groups->modifyGroupPlanning($id_groupe_ordinateur, $planning_id_planning);
            }
            else if ($action == 'nom')
            {
                $nom =                  $this->getRequest()->getParam('nom');
                $this->view->return = $groups->modifyGroupNom($id_groupe_ordinateur, $nom);
            }
            else if ($action == 'description')
            {
                $description =          $this->getRequest()->getParam('description');
                $this->view->return = $groups->modifyGroupDesc($id_groupe_ordinateur, $description);
            }
        }
        public function delAction()
        {
            $id_groupe_ordinateur = $this->getRequest()->getParam('id_groupe_ordinateur');
            $groups = new Model_DbTable_Groups();
            $this->view->return = $groups->delGroup($id_groupe_ordinateur);
        }
    }
    
?>