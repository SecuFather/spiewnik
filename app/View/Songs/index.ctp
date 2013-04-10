<ul>
<?php foreach($songs as $song): ?>

    <li>
        <?php echo $this->Html->link($song['Song']['title'],
                array('controller' => 'songs', 'action' => 'show', $song['Song']['id']))
        ?>
    </li>
    
<?php endforeach; ?>
</ul>