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
    require_once '../application/models/DbTable/Reporting.php';
    require_once '../application/models/DbTable/Computers.php';
    require_once '../application/models/DbTable/Groups.php';
    require_once '../application/utils/Reporting.php';

    class ReportingController extends IntController
    {
        public function bycomputerAction() {
            $translate = Zend_Registry::get('Zend_Translate');
            $groups = new Model_DbTable_Groups();
            $computers = new Model_DbTable_Computers();
            $this->view->audit = utilsReporting::isCompleted();
            
            $this->view->date_begin = $this->getRequest()->getParam('date_begin', strftime("%d-%m-%Y", mktime(0, 0, 0, date('m')-1, date('d'), date('y'))));
            $this->view->date_end = $this->getRequest()->getParam('date_end', strftime("%d-%m-%Y", mktime(0, 0, 0, date('m'), date('d'), date('y'))));
            $this->view->data = explode("-", $this->getRequest()->getParam('data', ''));
//            $this->view->maxDate = $reporting->getReportingMaxDate();
//            $this->view->minDate = $reporting->getReportingMinDate();
            
//            utilsReporting::returnComputersAuditValue("1-3-5");
            
            $this->view->computerNames = $computers->getAllComputers();
            $this->view->groupNames = $groups->getAllGroups();
            $this->view->toDate = utilsReporting::toDate();
            $this->view->fromDate = utilsReporting::fromDate();

            
            if ($this->getRequest()->getParam('data')) {                
                $this->view->timeYTitle = $translate->_("act_min");
                $this->view->timeXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->timeGraphTitle = $translate->_("temps_act_ordi");//"Temps d'activité des groupes en minutes";
                $this->view->wYTitle = $translate->_("conso_w");//"Consomation en Watt";
                $this->view->wXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->wGraphTitle = $translate->_("conso_ordi");//"Consomation des groupes en Watt";
                $this->view->kwYTitle = $translate->_("conso_kw");//"Consomation en Kilowatt";
                $this->view->kwXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->kwGraphTitle = $translate->_("conso_ordi_k");//"Consomation des groupes en Kilo Watt";
                $this->view->co2YTitle = $translate->_("em_kg");//"Emission en Kilogramme de CO2";
                $this->view->co2XTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->co2GraphTitle = $translate->_("em_kg");//"Emission en Kilogramme de CO2";
                $this->view->computerDataFormated = utilsReporting::generateComputersdata();
            }
        }
        
        public function bygroupAction() {
            $translate = Zend_Registry::get('Zend_Translate');
            $this->view->audit = utilsReporting::isCompleted();
            $groups = new Model_DbTable_Groups();
            $this->view->groupNames = $groups->getAllGroups();
            
//            utilsReporting::returnAuditValue();
//            utilsReporting::returnGroupsAuditValue("2-3");
            
            $this->view->date_begin = $this->getRequest()->getParam('date_begin', strftime("%d-%m-%Y", mktime(0, 0, 0, date('m')-1, date('d'), date('y'))));
            $this->view->date_end = $this->getRequest()->getParam('date_end', strftime("%d-%m-%Y", mktime(0, 0, 0, date('m'), date('d'), date('y'))));
            $this->view->data = explode("-", $this->getRequest()->getParam('data', ''));
            $this->view->toDate = utilsReporting::toDate();
            $this->view->fromDate = utilsReporting::fromDate();
           
            if ($this->getRequest()->getParam('data')) {
                $this->view->timeYTitle = $translate->_("act_min");
                $this->view->timeXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->timeGraphTitle = $translate->_("temps_act");//"Temps d'activité des groupes en minutes";
                $this->view->wYTitle = $translate->_("conso_w");//"Consomation en Watt";
                $this->view->wXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->wGraphTitle = $translate->_("conso_grp");//"Consomation des groupes en Watt";
                $this->view->kwYTitle = $translate->_("conso_kw");//"Consomation en Kilowatt";
                $this->view->kwXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->kwGraphTitle = $translate->_("conso_grp_k");//"Consomation des groupes en Kilo Watt";
                $this->view->co2YTitle = $translate->_("em_kg");//"Emission en Kilogramme de CO2";
                $this->view->co2XTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->co2GraphTitle = $translate->_("em_kg");//"Emission en Kilogramme de CO2";
                $this->view->groupDataFormated = utilsReporting::generateGroupsdata();
            }
        }

        public function byparcAction()
        {
            $translate = Zend_Registry::get('Zend_Translate');
            $this->view->audit = utilsReporting::isCompleted();
            $this->view->date_begin = $this->getRequest()->getParam('date_begin', strftime("%d-%m-%Y", mktime(0, 0, 0, date('m')-1, date('d'), date('y'))));
            $this->view->date_end = $this->getRequest()->getParam('date_end', strftime("%d-%m-%Y", mktime(0, 0, 0, date('m'), date('d'), date('y'))));
            $this->view->toDate = utilsReporting::toDate();
            $this->view->fromDate = utilsReporting::fromDate();
            
             if ($this->getRequest()->getParam('date_begin')) {
                $this->view->timeXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->timeYTitle = $translate->_("act_min");
                $this->view->timeXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->timeGraphTitle = $translate->_("temps_act_parc");//"Temps d'activité des groupes en minutes";
                $this->view->wYTitle = $translate->_("conso_w");//"Consomation en Watt";
                $this->view->wXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->wGraphTitle = $translate->_("conso_prc");//"Consomation des groupes en Watt";
                $this->view->kwYTitle = $translate->_("conso_kw");//"Consomation en Kilowatt";
                $this->view->kwXTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->kwGraphTitle = $translate->_("conso_prc_k");//"Consomation des groupes en Kilo Watt";
                $this->view->co2YTitle = $translate->_("em_kg");//"Emission en Kilogramme de CO2";
                $this->view->co2XTitle = $translate->_("jour_ut");//"Jour d'utilisation";
                $this->view->co2GraphTitle = $translate->_("em_kg");//"Emission en Kilogramme de CO2";
                $this->view->parcDataFormated = utilsReporting::generateParcdata();
            }
        }

        public function indexAction()
        {
            
        }
        
        
        // addReportingData($id_ordinateur, $is_audit, $date, $last_received, $temps)
        public function generateauditAction()
        {
            $reporting = new Model_DbTable_Reporting();
            $date_begin = "2011-11-01";
            $date_end = "2011-12-01";
            $computer = "1-2-3-4-5";
            $is_audit = "1";
            $min = 360;
            $max = 520;
            
            
            $computers = explode("-", $computer);
            $date = $date_begin;
            while ($date != $date_end) {
                foreach ($computers as $c) {
                    
                    $insert = "id:".$c." date:".$date." t:";
                    $d = new DateTime($date);
                    if (($c%2 == 0) && ($d->format("N") == 1 || $d->format("N") == 7)) {
                      $t = 0;
                    }
                    else {
                        $t = rand($min, $max);
                    }
                    echo $insert.$t. "<br />";
                  
                    //$reporting->addReportingData($c, $is_audit, $date, $date, $t);
                }
                $dateTime = new DateTime($date);
                $date = $dateTime->modify('+1 day')->format('Y-m-d');
            }
            
        }
        
        public function generateAction()
        {
            $reporting = new Model_DbTable_Reporting();
            $date_begin = "2011-12-01";
            $date_end = "2012-02-09";
            $computer = "1-2-3-4-5";
            $is_audit = "0";
            $min = 340;
            $max = 480;
            
            
            $computers = explode("-", $computer);
            $date = $date_begin;
            while ($date != $date_end) {
                foreach ($computers as $c) {
                    
                    $insert = "id:".$c." date:".$date." t:";
                    $d = new DateTime($date);
                    if (($d->format("N") == 1 || $d->format("N") == 7)) {
                      $t = 0;
                    }
                    else {
                        $t = rand($min, $max);
                    }
                    echo $insert.$t. "<br />";
                  
                    //$reporting->addReportingData($c, $is_audit, $date, $date, $t);
                }
                $dateTime = new DateTime($date);
                $date = $dateTime->modify('+1 day')->format('Y-m-d');
            }
            
        }
        
    }


?>