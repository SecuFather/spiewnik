<?php if (!empty($user['username'])): ?>
<?php echo $this->Html->link($user['username'],
        array('controller' => 'users', 'action' => 'profile'),
        array('class' => 'button')); 
?>

<?php echo $this->Html->link('Wyloguj', 
        array('controller' => 'users', 'action' => 'logout'),
        array('class' => 'button')); 
?>
<?php endif; ?>

<?php if (empty($user['username'])): ?>
<?php echo $this->Html->link('Zaloguj',
        array('controller' => 'users', 'action' => 'login'),
        array('class' => 'button')); 
?>

<?php echo $this->Html->link('Zarejestruj', 
        array('controller' => 'users', 'action' => 'register'),
        array('class' => 'button')); 
?>
<?php endif; ?>

<?php echo $this->Html->link('Piosenki', 
        array('controller' => 'songs', 'action' => 'index'),
        array('class' => 'button')); 
?>

<?php echo $this->Html->link('Dodaj Piosenkę', 
        array('controller' => 'songs', 'action' => 'add'),
        array('class' => 'button')); 
?>

<?php echo $this->Html->link('Kategorie', 
        array('controller' => 'categories', 'action' => 'index'),
        array('class' => 'button')); 
?>

<?php echo $this->Html->link('Dodaj Kategorie', 
        array('controller' => 'categories', 'action' => 'add'),
        array('class' => 'button')); 
?>
<br/><br/>
<hr/>