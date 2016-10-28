<?php if(get_field('garage') || get_field('garden')) : ?>
<p class="dotations">
    <?php echo __('In dotazione', 'frt'); ?><br/>
    <strong><?php echo get_field('garage') ? __('Garage', 'frt') : ''; ?>
    <?php if(get_field('garden')) {
        if(!get_field('garage')) {
            echo __('Giardino', 'frt');
        } else {
            _e(' e giardino', 'frt');
        }
    } ?></strong>
</p>
<?php endif; ?>