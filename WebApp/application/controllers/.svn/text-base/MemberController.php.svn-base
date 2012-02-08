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
    require_once '../application/controllers/IntController.php';
    require_once '../application/models/DbTable/Computers.php';

    class MemberController extends IntController
    {
        public function indexAction()
        {
            // mettre le nombre de machine en attente.
            $computers = new Model_DbTable_Computers();
            $this->view->waitingComputers = count($computers->waitingComputers());
        }

        public function logoutAction()
        {
            Zend_Auth::getInstance()->clearIdentity();
            $this->_helper->redirector('index','index');
        }
    }
    
?>