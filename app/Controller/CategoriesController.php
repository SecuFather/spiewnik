<?php

class CategoriesController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow(array('index', 'show'));
    }
    
    public function index() {
        $cats = $this->Category->find('all');
        
        $this->set('cats', $cats);
    }
    
    public function show($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Nie znaleziono kategorii'));
        }
        $cat = $this->Category->findById($id);
        
        if (!$cat){
            throw new NotFoundException(__('Nie znaleziono kategorii'));
        }        
        $songs = $this->Category->Song->find('all');
                
        $this->set(compact('songs', 'cat'));
    }
}

?>
