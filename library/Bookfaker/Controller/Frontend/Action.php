<?php

class Bookfaker_Controller_Frontend_Action extends Bookfaker_Controller_Action{
    public function init() {
        
        parent::init();
        
        $json = file_get_contents($this->view->serverUrl() .$this->view->url(array("module" => "backend", "controller" => "api", "action" => "get-sports")));
        
        $this->view->sports = json_decode($json);
        
//        foreach($this->view->sports  as $sport){
//            foreach($sport->championships as $champ){
//                echo '<a href="#">'.$champ .'</a><br/>';
//            }
//            
//            echo "<br/>------------------<br/>";
//        }
//        exit;
        
        
    }   
}
?>
