<?php

class UsersController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'register');
    }                
    
    public function index() {          
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
        $u = $this->Auth->user();
        $user = $this->User->findById($u['id']);                         
                
        if ($this->request->is('post') || $this->request->is('put')) {            
            if (empty($this->request->data['User']['new_password'])) {                
                $this->request->data['User']['password'] = $user['User']['password'];                
            } else {                
                $this->request->data['User']['password'] = $this->request->data['User']['new_password'];
            }            
            $this->User->id = $u['id'];
            
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Dane zostały zmienione'));                
            } else {
                $this->Session->setFlash(__('Dane nie zostały zmienione'));                
            }
        }                
        
        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }
}

?>
