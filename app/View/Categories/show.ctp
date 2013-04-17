<?php echo $this->Html->link('edytuj', 
        array('action' => 'edit', $cat['Category']['id']));
?>

<?php echo $this->Form->postLink('usuń', 
        array('action' => 'delete', $cat['Category']['id']),
        array('confirm' => 'Na pewno?'));
?>


<h2><?php echo $cat['Category']['name']; ?></h2>
<h3>Opis:</h3>
<p><?php echo $cat['Category']['about']; ?></p>

<h3>Piosenki:</h3>
<ul>
<?php foreach($songs as $song): ?>

    <li>
        <?php echo $this->Html->link($song['Song']['title'],
                array('controller' => 'songs', 'action' => 'show', $song['Song']['id']))
        ?>
    </li>
    
<?php endforeach; ?>    
    
</ul>

<?php if (empty($songs)): ?>
    <p><?php echo 'Nie znaleziono żadnych piosenek'; ?></p>
<?php endif; ?>