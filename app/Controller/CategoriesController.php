<?php

class CategoriesController extends AppController {               
    
    public $paginate = array(
        'Category' => array(
            'order' => array('Category.name' => 'asc'),
            'limit' => 10,
            'fields' => array('id', 'name')
        ),
        'Song' => array(
            'order' => array('Song.title' => 'asc'),
            'limit' => 3,
            'fields' => array('id', 'title')
        )
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow(array('index', 'show'));
    }
    
    public function index() {                
        $this->set('cats', $this->paginate('Category'));
    }
    
    public function show($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Nie znaleziono kategorii'));
        }
        $cat = $this->Category->findById($id);
        
        if (!$cat){
            throw new NotFoundException(__('Nie znaleziono kategorii'));
        }        
        
        $songs = $this->paginate('Song', array('Song.category_id' => $id));
                
        $this->set(compact('songs', 'cat'));
    }
}

?>
