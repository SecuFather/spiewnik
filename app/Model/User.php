<?php

class User extends AppModel {
    public $validate = array(
        'username' => array(
            'rule' => array('notEmpty'),
            'message' => array('Username is required')
        ),
        'password' => array(
            'rule' => array('notEmpty'),
            'message' => array('Password is required')
        )        
    );
    
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        
        $password = &$this->data['User']['password'];
        
        if (!empty($password)) {
            $password = AuthComponent::password($password);
        }
    }        
}

?>
