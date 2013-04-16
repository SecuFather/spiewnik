<?php

class Category extends AppModel{    
    public $recursive = -1;
    
    public $hasMany = array(
        'Song' => array(            
            'order' => array('Song.title' => 'asc'),
            'fields' => array('id', 'title'),            
        )
    );     
}

?>
