<?php

class User extends AppModel {
    public $validate = array(
        'username' => array(
            'rule' => array('notEmpty'),
            'message' => array('Nazwa użytkownika jest wymagana')
        ),
        'password' => array(
            'rule' => array('notEmpty'),
            'message' => array('Hasło jest wymagane')
        ),
        'email' => array(
            'rule' => array('notEmpty'),
            'message' => array('Adres email jest wymagany')
        )
    );        
    
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        
        $password = &$this->data['User']['password'];        
        
        if (!empty($password)) {
            $password = AuthComponent::password($password);
        }
        $this->data['User']['role'] = 'user';
    }        
}

?>
