<h2>Dodaj Kategorie</h2>

<?php
echo $this->Form->create('Category');
echo $this->Form->input('name');
echo $this->Form->input('about', array('rows' => '3'));
echo $this->Form->end('Dodaj');
?>