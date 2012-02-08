<?php
/*
 * Copyright 2010, 2011 Swann FRANCESCHI for ecoparc
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

class utilsReporting
{
    
    public function dateDiff($dt1, $dt2, $timeZone = 'GMT') {
        $tZone = new DateTimeZone($timeZone);
        $dt1 = new DateTime($dt1, $tZone);
        $dt2 = new DateTime($dt2, $tZone);
        $ts1 = $dt1->format('Y-m-d');
        $ts2 = $dt2->format('Y-m-d');
        $diff = abs(strtotime($ts1)-strtotime($ts2));
        $diff/= 3600*24;
        return $diff;
    }
    
    public function isCompleted()
    {
        $path = "../config/config.ini";
        $config = new Zend_Config_Ini($path, 'general', array('skipExtends'=> true,'allowModifications' => true));

        if ($config->auditMode  == "completed")
            return TRUE;
        else
            return FALSE;
    }

    public function toDate() {
        return date("d-m-Y");
    }

    public function fromDate() {
        return date("d-m-Y", mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
    }


    /*
     * genere toutes les donnée des courbe pour les ordinateurs selectionnés
     * @todo : audit ou pas ?
     */
    public function generateComputersdata() {
        $audit = $this->getRequest()->getParam('audit');
        $reporting = new Model_DbTable_Reporting();

        $computerParam = $this->getRequest()->getParam('data');
        $date_begin = $this->getRequest()->getParam('date_begin');//'2011-12-05';       
        $date_end = $this->getRequest()->getParam('date_end');//'2011-12-12';

        $date_begin_convert = new DateTime($date_begin);
        $date_end_convert = new DateTime($date_end);            
        $date_begin = $date_begin_convert->format('Y-m-d');
        $date_end = $date_end_convert->format('Y-m-d');

        $days = self::dateDiff($date_begin, $date_end);
        
        $computers = explode("-", $computerParam);
        $data = array();
        $i = 0;
        
        foreach ($computers as $id) { 

            $computerConsoSql = $reporting->getComputerConso($date_begin, $date_end, $id, $is_audit = '0');
            $fullData = self::parseComputerData($computerConsoSql, $date_begin, $date_end, $id);
            $data[$i] = self::formatComputerData($fullData);
            $i++;
        }
        if ($audit == '1') {
            $auditData = self::returnComputersAuditValue($computerParam);
            $data[$i] = self::formatAudit($date_begin, $date_end, $days, $auditData);
        }
        
        return $data;
    }
    
         /*
         * Formate et comble les jours manquant.
         */
        public function parseComputerData($computerConsoSql, $date_begin, $date_end, $id) {
            $days = self::dateDiff($date_begin, $date_end);
            
            $date_begin = new DateTime($date_begin);
            $date = $date_begin->format('Y-m-d');
            $row = $computerConsoSql->toArray();
            $computerName;            
            $computerConso;
            $computerId = $id;
            
            for ($i = 0,$j = 0; $i <= $days; $i++) { // 6 tours

                $data[$i]["date"] = $date;

                if (isset($row[$j]) && $date == $row[$j]["date"]) {
                   $data[$i]["temps"] = intval($row[$j]["temps"]);
                   $computerName = $row[$j]["nom"];
                   $computerConso = $row[$j]["conso"];
                   $j++;
                }
                else {
                   $data[$i]["temps"] = 0;
                }
                $datetime = new DateTime($date);
                $date = $datetime->modify('+1 day')->format('Y-m-d');
            }
            $fullData = array($data, $computerConso, $computerName, $computerId);
//            echo "<pre>";
//            var_dump($fullData);
//            echo "</pre>";
            return $fullData;
        }
         /*
          * formate en json et calcul consomation W, KW et heure
          * 
          * fullData[0] = $data 
          * fullData[1] = $computerConso 
          * fullData[2] = $computerName
          * fullData[3] = $computerId
          * 
          */
        
        
        // http://www.greenit.fr/article/energie/combien-de-co2-degage-un-1-kwh-electrique
        // 'un kWh électrique produit 0,09 kg CO2'
        
        public function formatComputerData($fullData) {
            $data = $fullData[0];
            $computerConso = $fullData[1];
            $computerName = $fullData[2];
            $computerId = $fullData[3];
            $res = array();
            $categorie = array();
            $temps = array();
            $kw = array();
            $w = array();
            $co2 = array();

            foreach ($data as $v) {
                array_push($categorie, $v["date"]);
                array_push($temps, $v["temps"]);
                array_push($w, $computerConso * $v['temps'] / 60);
                array_push($kw, round((($computerConso * $v['temps'] / 60) / 100), 1));
                array_push($co2, round(($v['temps'] / 60) * 0.09, 1));
            }
            
            $res["cat"] = json_encode($categorie);
            $res["value_time"] = json_encode($temps);            
            $res["value_kw"] = json_encode($kw);
            $res["value_w"] = json_encode($w);
            $res["value_co2"] = json_encode($co2);
            $res["id"] = $computerId;
            $res["name"] = $computerName;
            $res["conso"] = $computerConso;
            return $res;
        }

        
        public function generateGroupsdata() {
            $audit = $this->getRequest()->getParam('audit');
            $groupParam = $this->getRequest()->getParam('data');
            $date_begin = $this->getRequest()->getParam('date_begin');//'2011-12-05';       
            $date_end = $this->getRequest()->getParam('date_end');//'2011-12-12';

            $date_begin_convert = new DateTime($date_begin);
            $date_end_convert = new DateTime($date_end);            
            $date_begin = $date_begin_convert->format('Y-m-d');
            $date_end = $date_end_convert->format('Y-m-d');
            
            $days = self::dateDiff($date_begin, $date_end);
            $groups = explode("-", $groupParam);
            $data = array();
            $i = 0;
            
            
            $date_tmp = $date_begin;
            $day = 0;
            while ($day <= $days)
            {
                $dates[$day]['day'] = $date_tmp;
                $dateTime = new DateTime($date_tmp);
                $date_tmp = $dateTime->modify('+1 day')->format('Y-m-d');
                $day++;
            }
            
            $j = 0;
            foreach ($groups as $id) { 
                $infos = self::returnDataGroup($date_begin, $date_end, $id, $is_audit = '0', $dates);
                $fullData[$j] = self::formatGroupData($infos);
                $j++;
            }
            
            if ($audit == '1') {
                $auditData = self::returnGroupsAuditValue($groupParam);
                $fullData[$j] = self::formatAudit($date_begin, $date_end, $days, $auditData);
            }
            
            //echo "<pre>";
            //var_dump($fullData);
            //echo "</pre>";
            return $fullData;
        }


        public function returnDataGroup($date_begin, $date_end, $id, $is_audit = '0', $dates)
        {
            $reporting = new Model_DbTable_Reporting();
            $groupConsoSql = $reporting->getGroupConso($date_begin, $date_end, $id, $is_audit = '0');
                
            for ($i = 0; isset($dates[$i]); $i++)
            {
                $dates[$i]['temps'] = 0;
                $dates[$i]['watt'] = 0;
                $dates[$i]['kw'] = 0;
                $dates[$i]['co2'] = 0;
                $dates[$i]['nom_groupe'] = 0;
                foreach ($groupConsoSql as $result)
                {
                    if ($result->date == $dates[$i]['day'])
                    {
                        $dates[$i]['temps'] += $result->temps;
                        $dates[$i]['watt'] += ($result->temps * $result->conso / 60);
                        $dates[$i]['kw'] += round((($result->temps * $result->conso / 60)) / 100, 1);
                        $dates[$i]['co2'] += round(($result->temps / 60) * 0.09, 1);
                        $dates[$i]['nom_groupe'] = $result->nom_groupe;
                    }
                }                    
            }
            return ($dates);
        }
        
        
        public function returnGroupsAuditValue($groupsParam)
        {
            $reporting = new Model_DbTable_Reporting();
            $path = "../config/config.ini";
            $config = new Zend_Config_Ini($path, 'general', array('skipExtends'=> true,'allowModifications' => true));

            $ids = explode("-", $groupsParam); 
            
             // calcul de nombre de jours
            $date_begin_convert = DateTime::createFromFormat('d/m/Y', $config->startDate);
            $date_end_convert = DateTime::createFromFormat('d/m/Y', $config->endDate);
            $date_begin_2 = $date_begin_convert->format('Y-m-d');
            $date_end_2 = $date_end_convert->format('Y-m-d');
            $days = self::dateDiff($date_begin_2, $date_end_2);

            $temps = $watt = $kw = $co2 = 0;
            foreach ($ids as $id)
            {
                $groupConsoSql = $reporting->getGroupConso($date_begin_2, $date_end_2, $id, $is_audit = '1');
                foreach ($groupConsoSql as $result)
                {
                    $temps += $result->temps;
                    $watt += ($result->temps * $result->conso / 60);
                    $kw += round((($result->temps * $result->conso / 60)) / 100, 1);
                    $co2 += round(($result->temps / 60) * 0.09, 1);
                }
            }

            $indice = sizeof($ids) * $days;
            
            // diviser par l'indice
            $temps = $temps / $indice;
            $watt = $watt / $indice;
            $kw = $kw / $indice;
            $co2 = $co2 / $indice;
//            echo 't:'.$temps.' w'. $watt .' kw:'.$kw.' co2:'. $co2;
            $res['value_time'] = round($temps,1);
            $res['value_w'] = round($watt,1);
            $res['value_kw'] = round($kw,1);
            $res['value_co2'] = round($co2,1);
            return($res);
        }
        
        public function returnComputersAuditValue($groupsParam)
        {
            $reporting = new Model_DbTable_Reporting();
            $path = "../config/config.ini";
            $config = new Zend_Config_Ini($path, 'general', array('skipExtends'=> true,'allowModifications' => true));

            $ids = explode("-", $groupsParam); 
            
             // calcul de nombre de jours
            $date_begin_convert = DateTime::createFromFormat('d/m/Y', $config->startDate);
            $date_end_convert = DateTime::createFromFormat('d/m/Y', $config->endDate);
            $date_begin_2 = $date_begin_convert->format('Y-m-d');
            $date_end_2 = $date_end_convert->format('Y-m-d');
            $days = self::dateDiff($date_begin_2, $date_end_2);

            $temps = $watt = $kw = $co2 = 0;
            foreach ($ids as $id)
            {
                $groupConsoSql = $reporting->getComputerConso($date_begin_2, $date_end_2, $id, $is_audit = '1');
                foreach ($groupConsoSql as $result)
                {
                    $temps += $result->temps;
                    $watt += ($result->temps * $result->conso / 60);
                    $kw += round((($result->temps * $result->conso / 60)) / 100, 1);
                    $co2 += round(($result->temps / 60) * 0.09, 1);
                }
            }

            $indice = sizeof($ids) * $days;
            
            // diviser par l'indice
            $temps = $temps / $indice;
            $watt = $watt / $indice;
            $kw = $kw / $indice;
            $co2 = $co2 / $indice;
//            echo 't:'.$temps.' w'. $watt .' kw:'.$kw.' co2:'. $co2;
            $res['value_time'] = round($temps,1);
            $res['value_w'] = round($watt,1);
            $res['value_kw'] = round($kw,1);
            $res['value_co2'] = round($co2,1);
            return($res);
        }
        
        public function formatGroupData($data) {
            $categorie = array();
            $temps = array();
            $kw = array();
            $w = array();
            $co2 = array();

            foreach ($data as $v) {
                array_push($categorie, $v["day"]);
                array_push($temps, $v["temps"]);
                array_push($w, $v["watt"]);
                array_push($kw, $v["kw"]);
                array_push($co2, $v["co2"]);
            }
            
            $res["cat"] = json_encode($categorie);
            $res["value_time"] = json_encode($temps);            
            $res["value_kw"] = json_encode($kw);
            $res["value_w"] = json_encode($w);
            $res["value_co2"] = json_encode($co2);
            $res["name"] = $v["nom_groupe"];
            return $res;
        }
                
        public function generateParcData() {
            $audit = $this->getRequest()->getParam('audit');
            $groupParam = $this->getRequest()->getParam('data');
            $date_begin = $this->getRequest()->getParam('date_begin');//'2011-12-05';       
            $date_end = $this->getRequest()->getParam('date_end');//'2011-12-12';

            $date_begin_convert = new DateTime($date_begin);
            $date_end_convert = new DateTime($date_end);            
            $date_begin = $date_begin_convert->format('Y-m-d');
            $date_end = $date_end_convert->format('Y-m-d');
            
//            $groups = explode("-", $groupParam);
//            $data = array();
//            $i = 0;
            
            $days = self::dateDiff($date_begin, $date_end);
            
            $date_tmp = $date_begin;
            $day = 0;
            while ($day <= $days)
            {
                $dates[$day]['day'] = $date_tmp;
                $dateTime = new DateTime($date_tmp);
                $date_tmp = $dateTime->modify('+1 day')->format('Y-m-d');
                $day++;
            }
           
            $infos = self::returnDataParc($date_begin, $date_end, $is_audit = '0', $dates);
            $fullData[0] = self::formatParcData($infos);
            
            
            // mettre audit dans fulldata[1]
            if ($audit == '1') {
                $auditData = self::returnParcAuditValue();
                $fullData[1] = self::formatAudit($date_begin, $date_end, $days, $auditData);
            }
            //return $fullData;
//            echo "<pre>";
//            var_dump($fullData);
//            echo "</pre>";
            return $fullData;
        }
        
        public function returnDataParc($date_begin, $date_end, $is_audit = '0', $dates){
            $reporting = new Model_DbTable_Reporting();
            $groupConsoSql = $reporting->getParcConso($date_begin, $date_end, $is_audit = '0');
                
            for ($i = 0; isset($dates[$i]); $i++)
            {
                $dates[$i]['temps'] = 0;
                $dates[$i]['watt'] = 0;
                $dates[$i]['kw'] = 0;
                $dates[$i]['co2'] = 0;
                $dates[$i]['nom_groupe'] = 0;
                foreach ($groupConsoSql as $result)
                {
                    if ($result->date == $dates[$i]['day'])
                    {
                        $dates[$i]['temps'] += $result->temps;
                        $dates[$i]['watt'] += ($result->temps * $result->conso / 60);
                        $dates[$i]['kw'] += round((($result->temps * $result->conso / 60)) / 100, 1);
                        $dates[$i]['co2'] += round(($result->temps / 60) * 0.09, 1);
                    }
                }                    
            }
            return ($dates);
        }
        
        public function formatParcData($data) {
            $categorie = array();
            $temps = array();
            $kw = array();
            $w = array();
            $co2 = array();

            foreach ($data as $v) {
                array_push($categorie, $v["day"]);
                array_push($temps, $v["temps"]);
                array_push($w, $v["watt"]);
                array_push($kw, $v["kw"]);
                array_push($co2, $v["co2"]);
            }
            
            $res["cat"] = json_encode($categorie);
            $res["value_time"] = json_encode($temps);            
            $res["value_kw"] = json_encode($kw);
            $res["value_w"] = json_encode($w);
            $res["value_co2"] = json_encode($co2);
            $res["name"] = "Total";
            return $res;
        }
        
        public function formatAudit($date_begin, $date_end, $days, $auditData) {
            $data;
            $date_tmp = $date_begin;
            $day = 0;
            $data["cat"] = array();
            $data["value_time"] = array();
            $data["value_kw"] = array();
            $data["value_w"] = array();
            $data["value_co2"] = array();
            while ($day <= $days) {
                array_push($data["cat"], $date_tmp);
                array_push($data["value_time"], $auditData["value_time"]);
                array_push($data["value_kw"], $auditData["value_kw"]);
                array_push($data["value_w"], $auditData["value_w"]);
                array_push($data["value_co2"], $auditData["value_co2"]);
                $dateTime = new DateTime($date_tmp);
                $date_tmp = $dateTime->modify('+1 day')->format('Y-m-d');
                $day++;
            }
            
            $res["cat"] = json_encode($data["cat"]);
            $res["value_time"] = json_encode($data["value_time"]);            
            $res["value_kw"] = json_encode($data["value_kw"]);
            $res["value_w"] = json_encode($data["value_w"]);
            $res["value_co2"] = json_encode($data["value_co2"]);
            $res["name"] = "Audit";
            return $res;
        }
        
        public function returnParcAuditValue(){
            $reporting = new Model_DbTable_Reporting();
            $path = "../config/config.ini";
            $config = new Zend_Config_Ini($path, 'general', array('skipExtends'=> true,'allowModifications' => true));

             // calcul de nombre de jours
            $date_begin_convert = DateTime::createFromFormat('d/m/Y', $config->startDate);
            $date_end_convert = DateTime::createFromFormat('d/m/Y', $config->endDate);
            $date_begin_2 = $date_begin_convert->format('Y-m-d');
            $date_end_2 = $date_end_convert->format('Y-m-d');
            $days = self::dateDiff($date_begin_2, $date_end_2);

            $temps = $watt = $kw = $co2 = 0;
            $groupConsoSql = $reporting->getParcConso($date_begin_2, $date_end_2, $is_audit = '1');
            foreach ($groupConsoSql as $result)
            {
                $temps += $result->temps;
                $watt += ($result->temps * $result->conso / 60);
                $kw += round((($result->temps * $result->conso / 60)) / 100, 1);
                $co2 += round(($result->temps / 60) * 0.09, 1);
            }

            // diviser par le nb de jours
            $temps = $temps / $days;
            $watt = $watt / $days;
            $kw = $kw / $days;
            $co2 = $co2 / $days;
//            echo 't:'.$temps.' w'. $watt .' kw:'.$kw.' co2:'. $co2;
            $res['value_time'] = round($temps,1);
            $res['value_w'] = round($watt,1);
            $res['value_kw'] = round($kw,1);
            $res['value_co2'] = round($co2,1);
            return $res;

        }
        

}

?>
