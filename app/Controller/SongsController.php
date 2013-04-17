<?php

class SongsController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow(array('index', 'show'));
    }    
    
    public function index() {
        $songs = $this->Song->find('all');        
        
        $this->set('songs', $songs);        
    }
    
    public function show($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Nie znaleziono piosenki'));
        }        
        $song = $this->Song->findById($id);
        
        if (!$song) {
            throw new NotFoundException(__('Nie znaleziono piosenki'));
        }        
        $this->set('song', $song);                
    }
    
    public function add() {                
        if ($this->request->is('post')) {
            $this->Song->create();
            
            if ($this->Song->save($this->request->data)) {
                $this->Session->setFlash(__('Piosenka została dodana'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Piosenka nie została dodana'));
            }
        }         
        $this->set('cat', $this->Song->Category->find('list'));        
    }
    
    public function edit($id = null) {
        if (!$id || !($song = $this->Song->findById($id))) {
            throw new NotFoundException(__('Nie znaleziono piosenki'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Song->save($this->request->data)) {
                $this->Session->setFlash(__('Zmiany zostały zapisane'));
                $this->redirect(array('action' => 'show', $song['Song']['id']));
            } else {
                $this->Session->setFlash(__('Zmiany nie zostały zapisane'));
            }
        }
        
        if (!$this->request->data) {
            $this->request->data = $song;
        }
        $this->set('song', $song);
        $this->set('cat', $this->Song->Category->find('list'));
    }
    
    public function delete($id = null) {
        if ($this->request->is('post')) {
            if (!$id) {
                throw new NotFoundException(__('Nie znaleziono piosenki'));
            }
            
            if ($this->Song->delete($id)) {
                $this->Session->setFlash(__('Piosenka została usunięta'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Piosenka nie została usunięta'));
                $this->redirect(array('action' => 'show', $id));
            }
            
        }                        
    }
}

?>
