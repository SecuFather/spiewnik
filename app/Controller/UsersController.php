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
                $this->Session->setFlash(__('You are logged in.'));
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
    }
    
    public function logout() {        
        $this->Session->setFlash(__('You are already logged out'));
        $this->redirect($this->Auth->logout());
    }        
    
    public function register() {
        if ($this->request->is('post')) {
            $this->User->create();
            
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Your account has been created.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to create account.'));
            }
        }
    }
    
    public function profile() {
        
    }
}

?>
