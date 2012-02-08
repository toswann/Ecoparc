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
    require_once '../application/models/DbTable/Planning.php';
    require_once '../application/models/DbTable/Planning_taches.php';
    require_once '../application/utils/Plannings.php';
    require_once '../application/utils/utilsUsers.php';

    class PlanningController extends AdminIntController
    {
        public function indexAction()
        {
            $plannings = new Model_DbTable_Planning();
            $this->view->allPlannings = $plannings->getAllPlannings();

            $form = new Form_AddPlannings('');
            $this->view->form = $form;

            if ($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData))
                {
                    $nom = $form->getValue('nom');
                    $description = $form->getValue('description');

                    $plannings = new Model_DbTable_Planning();
                    $plannings->addPlanning($nom, $description);
                    $this->_helper->redirector('index', 'planning');
                }
            else
                $form->populate($formData);
            }
        }
        public function viewAction()
        {
            $id_planning = $this->getRequest()->getParam('id_planning');
            $plannings = new Model_DbTable_Planning();
            $this->view->planning = $plannings->getOnePlanning($id_planning);
            if (!$this->view->planning)
            {
                $this->_helper->redirector('index', 'planning');
            }
            // get les taches du planning
            $planning_taches = new Model_DbTable_Planning_Taches();
            $this->view->taches = $planning_taches->getTaches($id_planning);

            $this->view->id_planning = $id_planning;
        }

        // ajout d'une tache
        // comment faire pour la modification? utiliser le meme code?
        public function addTacheAction()
        {
            $planning_id_planning = $this->getRequest()->getParam('planning_id_planning');
            $jour = $this->getRequest()->getParam('jour');
            $heure_debut = $this->getRequest()->getParam('heure_debut');
            $heure_fin = $this->getRequest()->getParam('heure_fin');
            $a = $this->getRequest()->getParam('a');
            $nom = $this->getRequest()->getParam('nom');
            $plannings_taches = new Model_DbTable_Planning_Taches();
            $this->view->return = $plannings_taches->addTache($planning_id_planning, $jour, $heure_debut, $heure_fin, $a, $nom);
        }
        public function dropTacheAction()
        {
            $id_planning_tache = $this->getRequest()->getParam('id_planning_tache');
            $planning_id_planning = $this->getRequest()->getParam('planning_id_planning');
            $jour = $this->getRequest()->getParam('jour');
            $heure_debut = $this->getRequest()->getParam('heure_debut');
            $heure_fin = $this->getRequest()->getParam('heure_fin');
            $plannings_taches = new Model_DbTable_Planning_Taches();
            $this->view->return = $plannings_taches->dropTache($planning_id_planning, $id_planning_tache, $jour, $heure_debut, $heure_fin);
        }
        public function delTacheAction()
        {
            $id_planning_tache = $this->getRequest()->getParam('id_planning_tache');
            $plannings_taches = new Model_DbTable_Planning_Taches();
            $this->view->return = $plannings_taches->delTache($id_planning_tache);
        }

        public function resizeTacheAction()
        {
            $id_planning_tache = $this->getRequest()->getParam('id_planning_tache');
            $planning_id_planning = $this->getRequest()->getParam('planning_id_planning');
            $heure_fin = $this->getRequest()->getParam('heure_fin');

            $plannings_taches = new Model_DbTable_Planning_Taches();
            $this->view->return = $plannings_taches->resizeTache($planning_id_planning, $id_planning_tache, $heure_fin);
        }
        
        public function modTacheAction()
        {
            $id_planning_tache = $this->getRequest()->getParam('id_planning_tache');
            $planning_id_planning = $this->getRequest()->getParam('planning_id_planning');
            $jour = $this->getRequest()->getParam('jour');
            $heure_debut = $this->getRequest()->getParam('heure_debut');
            $heure_fin = $this->getRequest()->getParam('heure_fin');
            $a = $this->getRequest()->getParam('a');
            $nom = $this->getRequest()->getParam('nom');

            $plannings_taches = new Model_DbTable_Planning_Taches();
            $this->view->return = $plannings_taches->modTache($planning_id_planning, $id_planning_tache, $jour, $heure_debut, $heure_fin, $a, $nom);
        }

        /* nod nom et descritpion */
        public function modAction()
        {
            $action = $this->getRequest()->getParam('a');
            $id_planning = $this->getRequest()->getParam('id_planning');
            $plannings = new Model_DbTable_Planning();
            if ($action == 'nom')
            {
                $nom =                  $this->getRequest()->getParam('nom');
                $this->view->return = $plannings->modifyPlanNom($id_planning, $nom);
            }
            else if ($action == 'description')
            {
                $description =          $this->getRequest()->getParam('description');
                $this->view->return = $plannings->modifyPlanDesc($id_planning, $description);
            }
        }
        public function delAction()
        {
            $id_planning = $this->getRequest()->getParam('id_planning');
            
            $taches = new Model_DbTable_Planning_Taches();
            $taches->delAllTaches($id_planning);
            
            $plannings = new Model_DbTable_Planning();
            $this->view->return = $plannings->delPlan($id_planning);
        }
    }
    
?>