<?php if (!empty($user['username'])): ?>
<?php echo $this->Html->link($user['username'],
        array('controller' => 'users', 'action' => 'profile', $user['id']),
        array('class' => 'button')); 
?>

<?php echo $this->Html->link('Logout', 
        array('controller' => 'users', 'action' => 'logout'),
        array('class' => 'button')); 
?>
<?php endif; ?>

<?php if (empty($user['username'])): ?>
<?php echo $this->Html->link('Login',
        array('controller' => 'users', 'action' => 'login'),
        array('class' => 'button')); 
?>

<?php echo $this->Html->link('Register', 
        array('controller' => 'users', 'action' => 'register'),
        array('class' => 'button')); 
?>
<?php endif; ?>

<?php echo $this->Html->link('Songs', 
        array('controller' => 'songs', 'action' => 'index'),
        array('class' => 'button')); 
?>
<br/><br/>
<hr/>