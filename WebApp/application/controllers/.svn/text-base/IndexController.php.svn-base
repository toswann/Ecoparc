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
    require_once '../application/controllers/AbstractController.php';
    require_once '../application/models/Form/User_Login.php';

    //http://blog.lyrixx.info/zend/gerer-lauthentification-avec-zend_auth-du-zend-framework/

    class IndexController extends AbstractController
    {
        public function indexAction()
        {
            // si deja logué !
            if (Zend_Auth::getInstance ()->hasIdentity ()) {
                $this->_helper->redirector('index', 'computers');
            }

            $form = new Model_Form_User_Login();
            $this->view->form = $form;
            $this->view->title = "Ecoparc Webapp";
            if ($this->_request->isPost())
            {
                $formData = $this->_request->getPost ();
                if ($form->isValid($formData))
                {
                    $email = $form->getValue ( 'email' );
                    $password = $form->getValue( 'password' );
                    $authAdapter = new Zend_Auth_Adapter_DbTable ( Zend_Db_Table::getDefaultAdapter () );
                    $authAdapter->setTableName('users')
                        ->setIdentityColumn('username')
                        ->setCredentialColumn('password')
                        //->setCredentialTreatment ( 'MD5(?)' )
                        ->setIdentity ( $email )
                        ->setCredential ( md5($password) );
                    $authAuthenticate = $authAdapter->authenticate ();
                    if ($authAuthenticate->isValid ())
                    {
                        $storage = Zend_Auth::getInstance ()->getStorage ();
                        $storage->write ( $authAdapter->getResultRowObject ( null, 'password' ) );

                        $this->_helper->redirector('index', 'computers');
                        } else {
                            $form->addError ( 'Il n\'existe pas d\'utilisateur avec ce mot de passe' );
                        }
                }
            }
            
        }

        public function logoutAction()
        {
            Zend_Auth::getInstance()->clearIdentity();
            $this->_helper->redirector('index','index');
        }
    }
    
?>