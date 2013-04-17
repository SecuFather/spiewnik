<h2>Edytuj Kategorię</h2>

<?php
echo $this->Form->create('Category');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('name');
echo $this->Form->input('about', array('rows' => '3'));
echo $this->Form->end('Edytuj');
?>