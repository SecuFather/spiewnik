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