<h2>Witaj <?php echo $user['username']; ?>!</h2>
<h3>Ustawienia:</h3>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('new_password', array('type' => 'password')); ?>
<?php echo $this->Form->input('email'); ?>
<?php echo $this->Form->input('first_name'); ?>
<?php echo $this->Form->input('last_name'); ?>
<?php echo $this->Form->input('city'); ?>
<?php echo $this->Form->input('about', array('rows' => '3')); ?>
<?php echo $this->Form->end('Modyfikuj'); ?>