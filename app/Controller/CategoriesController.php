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
        if (!$id || !($cat = $this->Category->findById($id)) ) {
            throw new NotFoundException(__('Nie znaleziono kategorii'));
        }        
        
        $songs = $this->paginate('Song', array('Song.category_id' => $id));
                
        $this->set(compact('songs', 'cat'));
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->Category->create();
            
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Kategoria została dodana'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Kategoria nie została dodana'));
            }
        }
    }
    
    public function edit($id = null) {
        if (!$id || !($cat = $this->Category->findById($id))) {
            throw new NotFoundException(__('Nie znaleziono kategorii'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Zmiany zostały zapisane'));
                $this->redirect(array('action' => 'show', $cat['Category']['id']));
            } else {
                $this->Session->setFlash(__('Zmiany nie zostały zapisane'));
            }
        }
        
        if (!$this->request->data) {
            $this->request->data = $cat;
        }
    }
    
    public function delete($id = null) {
        if ($this->request->is('post')) {
            if (!$id) {
                throw new NotFoundException(__('Nie znaleziono kategorii'));
            }
            
            try {
            
                if ($this->Category->delete($id)) {
                    $this->Session->setFlash(__('Kategoria została usunięta'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('Kategoria nie została usunięta'));
                    $this->redirect(array('action' => 'show', $id));
                }
            } catch (Exception $e){
                $this->Session->setFlash(__('Kategoria posiada jeszcze piosenki'));
                $this->redirect(array('action' => 'show', $id));
            }
            
        }                        
    }
}

?>
