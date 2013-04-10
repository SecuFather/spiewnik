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
}

?>
