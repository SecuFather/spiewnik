<?php

class Song extends AppModel {
    public $belongsTo = array(
        'Category' => array(            
            'fields' => array('id', 'name')
        )
    );
}

?>
