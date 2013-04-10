<h2>
    <?php echo $song['Song']['title']; ?> - 
    <?php echo $this->Html->link($song['Category']['name'], 
        array('controller' => 'categories', 'action' => 'show', $song['Song']['category_id']));
    ?>
</h2>

<table>
    <tr>
        <td class="lyrics">
            <?php echo  nl2br($song['Song']['lyrics']); ?>
        </td>
        <td class="chords">
            <?php echo  nl2br($song['Song']['chords']); ?>
        </td>
    </tr>
</table>