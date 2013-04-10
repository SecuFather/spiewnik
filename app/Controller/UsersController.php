<?php

class UsersController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'register');
    }                
    
    public function index() {          
    }
    
    public function isAuthorized($user) {                        
        if ($user['role'] == 'user'){
            if ($this->action == 'profile' && $user['id'] != $this->request->params['pass'][0]){
                return false;
            }
            return true;
        }
        return parent::isAuthorized($user);
    }
    
    public function login() {        
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Logowanie przebiegło pomyślnie'));
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Nieprawidłowa nazwa użytkownika lub hasło'));
            }
        }
    }
    
    public function logout() {        
        $this->Session->setFlash(__('Wylogowywanie przebiegło pomyślnie'));
        $this->redirect($this->Auth->logout());
    }        
    
    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Konto zostało utworzone'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Konto nie zostało utworzone'));
            }
        }
    }
    
    public function profile() {
        
    }
}

?>
