<?php
/*
 * @todo : mettre la longueur dupass dans un fichier de conf
 *
 * ajout, suppression, modification de droits
 *
 * un admin cree un user, le password est affiche et il lui donne
 * reinitialisation du password par l'administrateur
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
    require_once '../application/controllers/AdminIntController.php';
    require_once '../application/models/DbTable/Users.php';
    require_once '../application/utils/utilsUsers.php';
    require_once '../application/utils/Fast_Pass_Mnemo.php';

    class UsersController extends AdminIntController
    {
        public function indexAction()
        {
            // get la liste de tous les users
            $users = new Model_DbTable_Users();
            $this->view->allUsers = $users->getAllUsers();

            
            // ici form pour ajouter un user
            $form = new Form_AddUsers('add', '');
            $form->envoyer->setLabel('add');
            $this->view->typeview = 0;
            $this->view->form = $form;

            if ($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData))
                {
                    $username = $form->getValue('username');
                    $type = $form->getValue('type');

                    // verifie que l'utilisateur n'existe pas deja !
                    $users = new Model_DbTable_Users();
                    $exist = $users->checkIfExist($username);
                    if ($exist == true)
                    {
                        // afficher un message d'erreur
                        $this->view->typeview = 1;
                    }
                    else
                    {
                        // generer password @todo !
                        $password = Fast_Pass_Mnemo::getOne(4);
                        // ajouter en database
                        $users->addUser($username, $type, $password);
                        $this->view->typeview = 2;
                        $this->view->Password = $password;
                    }
                }
            else
                $form->populate($formData);
            }
        }

        // pour reinitialiser un pass
        public function initpassAction()
        {
            $id = intval($this->_getParam('id', 0));
            $password = Fast_Pass_Mnemo::getOne(4);
            $users = new Model_DbTable_Users();
            $users->initPass($id, $password);

            $this->view->Password = $password;
        }
        public function modifyAction()
        {
            $id = intval($this->_getParam('id', 0));

            // get le username et pass du type !
            $users = new Model_DbTable_Users();
            $user = $users->getUserInfo($id);
            $form = new Form_AddUsers('mod', $user);
            $form->envoyer->setLabel('Modify');
            $this->view->typeview = 0;
            $this->view->form = $form;
            if ($this->getRequest()->isPost())
            {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData))
                {
                    $username = $form->getValue('username');
                    $type = $form->getValue('type');
                    $id_user = $form->getValue('id_user');
                    
                    // seulement si le user a été modifié
                    // verifie que l'utilisateur n'existe pas deja !
                    $users = new Model_DbTable_Users();
                    $exist = $users->checkIfExist($username);
                    $user = $users->getUserInfo($id_user);
                    if (($exist == true) && ($user['username'] != $username))
                        $this->view->typeview = 1;
                    else
                    {
                        // ajouter en database
                        $users->modifyUser($id, $username, $type);
                        $this->view->typeview = 2;
                    }
                }
            else
                $form->populate($formData);
            }
        }
    
        //@todo: new version Denis
        public function modAction()
        {
            $action = $this->getRequest()->getParam('a');
            $id_user = $this->getRequest()->getParam('id_user');
            $users = new Model_DbTable_Users();
            //echo $id_user;exit;
            if ($action == 'username')
            {
                $nom =                  $this->getRequest()->getParam('username');
                $this->view->return = $users->modifyUserNom($id_user, $nom);
            }
            else if ($action == 'type')
            {
                $type =          $this->getRequest()->getParam('type');
                $this->view->return = $users->modifyUserType($id_user, $type);
            }
        }
        public function delAction()
        {
            $id_user = $this->getRequest()->getParam('id_user');
            $users = new Model_DbTable_Users();
            $this->view->return = $users->delUser($id_user);
        }
    }
    
?>