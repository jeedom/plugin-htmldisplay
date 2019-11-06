<?php

/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

try {
  require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';
  include_file('core', 'authentification', 'php');
  
  if (!isConnect('admin')) {
    throw new Exception(__('401 - Accès non autorisé', __FILE__));
  }
  
  if (init('action') == 'saveHtmlDisplay') {
    $eqLogic = htmldisplay::byId(init('id'));
    if(!is_object($eqLogic)){
      throw new \Exception(__('Impossible de trouver l\'équipement : ',__FILE__).init('id'));
    }
    $path = __DIR__.'/../../data';
    if(!file_exists($path)){
      mkdir($path);
    }
    $path .= '/'.$eqLogic->getId();
    if(!file_exists($path)){
      mkdir($path);
    }
    if (!file_exists($path)) {
      throw new Exception(__('Impossible de créer le dossier : ', __FILE__) . $path);
    }
    if (!is_writable($path)) {
      throw new Exception(__('Impossible d\'écrire dans : ', __FILE__) . $path);
    }
    if(init('mobile') != ''){
      file_put_contents($path.'/mobile.html', init('mobile'));
      chmod($path, 0770);
    }
    if(init('dashboard') != ''){
      file_put_contents($path.'/dashboard.html', init('dashboard'));
      chmod($path, 0770);
    }
    ajax::success();
  }
  
  if (init('action') == 'getHtmlDisplay') {
    $eqLogic = htmldisplay::byId(init('id'));
    if(!is_object($eqLogic)){
      throw new \Exception(__('Impossible de trouver l\'équipement : ',__FILE__).init('id'));
    }
    $return = array(
      'mobile' => $eqLogic->getHtmlContent('mobile'),
      'dashboard' => $eqLogic->getHtmlContent('dashboard')
    );
    ajax::success($return);
  }
  
  
  
  throw new Exception(__('Aucune méthode correspondante à : ', __FILE__) . init('action'));
} catch (Exception $e) {
  ajax::error(displayExeption($e), $e->getCode());
}
?>
