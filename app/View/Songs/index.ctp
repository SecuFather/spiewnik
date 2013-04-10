<h2>Piosenki</h2>
<ul>
<?php foreach($songs as $song): ?>

    <li>
        <?php echo $this->Html->link($song['Song']['title'],
                array('controller' => 'songs', 'action' => 'show', $song['Song']['id']))
        ?> - 
        <?php echo $this->Html->link($song['Category']['name'],
                array('controller' => 'categories', 'action' => 'show', $song['Category']['id']))
        ?>
    </li>
    
<?php endforeach; ?>
</ul>