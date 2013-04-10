<h2>Kategorie</h2>
<ul>
<?php foreach($cats as $cat): ?>

    <li>
        <?php echo $this->Html->link($cat['Category']['name'],
                array('controller' => 'categories', 'action' => 'show', $cat['Category']['id']))
        ?>
    </li>
    
<?php endforeach; ?>
</ul>