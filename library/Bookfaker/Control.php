<?php
/**
 * Methodes de controle des acces (admin, connecté ?, etc)
 *
 * @author Cam
 */
class Bookfaker_Control {
    //put your code here
    static function isLogged(){
        
        $auth = Zend_Auth::getInstance();
        
        return $auth->hasIdentity();
    }
    
    static function isAdmin(){
        
        $auth = Zend_Auth::getInstance();
        $session = new Zend_Session_Namespace('auth');
        
        return $auth->hasIdentity() && isset($session) && $session->user->isAdmin;
    }
    
    static function userInfos(){
        
        $auth = Zend_Auth::getInstance();
        $session = new Zend_Session_Namespace('auth');
        
        if(!$auth->hasIdentity())
            return null;
        
        return $session->user;
    }
    
    static function setUserInfos($user){
        
        $auth = Zend_Auth::getInstance();
        $session = new Zend_Session_Namespace('auth');
        
        if(!$auth->hasIdentity())
            return null;
        
        $session->user = $user;
    }
}

?>
