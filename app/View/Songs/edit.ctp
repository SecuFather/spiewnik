<h2>Edytuj Piosenkę</h2>

<?php
echo $this->Form->create('Song');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('category_id',
        array(
            'empty' => 'Wybierz kategorię...',
            'options' => $cat,            
        ));
echo $this->Form->input('title', array('rows' => '10'));
echo $this->Form->input('chords', array('rows' => '10'));
echo $this->Form->end('Edytuj');
?>