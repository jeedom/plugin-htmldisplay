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

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class htmldisplay extends eqLogic {
  /*     * *************************Attributs****************************** */
  
  
  
  /*     * ***********************Methode static*************************** */
  
  
  /*     * *********************Méthodes d'instance************************* */
  
  public function postSave(){
    $this->refreshWidget();
  }
  
  
  public function preRemove() {
    if(file_exists(__DIR__.'/../../data/'.$this->getId())){
      rrmdir(__DIR__.'/../../data/'.$this->getId());
    }
  }
  
  public function toHtml($_version = 'dashboard'){
    $replace = $this->preToHtml($_version);
    $html = '';
    if($_version == 'dashboard'){
      $html .= '<div class="eqLogic eqLogic-widget allowResize #eqLogic_class#" data-eqType="#eqType#" data-eqLogic_id="#id#" data-eqLogic_uid="#uid#" data-version="#version#" data-translate-category="#translate_category#" data-category="#category#" data-tags="#tags#" style="width: #width#;height: #height#;#style#">';
    }else if($_version == 'mobile'){
      $html .= '<div class="eqLogic eqLogic-widget" data-eqLogic_id="#id#" data-eqType="#eqType#" data-version="#version#" data-eqLogic_uid="#uid#" data-translate-category="#translate_category#" data-category="#category#" data-tags="#tags#" style="#style#">';
    }
    $html .= '<div>';
    $html .= $this->getHtmlContent($_version);
    $html .= '</div></div>';
    return str_replace(array_keys($replace),$replace,$html);
  }
  
  public function getHtmlContent($_version = 'dashboard'){
    $path = __DIR__.'/../../data/'.$this->getId();
    if(file_exists($path.'/'.$_version.'.html')){
      return file_get_contents($path.'/'.$_version.'.html');;
    }
    return '';
  }
  
  /*     * **********************Getteur Setteur*************************** */
}

class htmldisplayCmd extends cmd {
  /*     * *************************Attributs****************************** */
  
  
  /*     * ***********************Methode static*************************** */
  
  
  /*     * *********************Methode d'instance************************* */
  
  public function execute($_options = array()) {
    
  }
  
  /*     * **********************Getteur Setteur*************************** */
}
