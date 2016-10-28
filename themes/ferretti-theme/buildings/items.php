<?php 
$locali = wp_get_post_terms($post->ID, 'tipologie');
$camere = wp_get_post_terms($post->ID, 'camere');
$bagni = wp_get_post_terms($post->ID, 'bagni');
$mq = get_field('mq');
if(get_field('tipologia') == 1) : 
if($locali || $camere || $bagni || $mq != '') : ?>
<ul class="frt_columns container_details">
    <?php if($bagni) : ?>
    <li class="details">
        <i class="frt_icon-bath"></i>
        <span class="label_details"><?php echo $bagni[0]->name; ?> <?php echo ((int)$bagni[0]->name > 1 )? __('Bagni', 'frt') : __('Bagno', 'frt'); ?></span>
    </li>
    <?php endif; ?>
    <?php if($camere) : ?>
    
    <li class="details">
        <i class="frt_icon-bed"></i>
        <span class="label_details"><?php echo $camere[0]->name; ?> <?php echo ((int)$camere[0]->name > 1) ? __('Camere', 'frt') : __('Camera', 'frt'); ?></span>
    </li>
    <?php endif; ?>
    <?php if($mq != '') : ?>
    <li class="details">
        <i class="frt_icon-size"></i>
        <span class="label_details"><?php the_field('mq'); ?></span>
    </li>
    <?php endif; ?>
    <?php if($locali) : ?>
    <li class="details">
        <i class="frt_icon-rooms"></i>
        <span class="label_details"><?php the_field('locali', 'tipologie_'.$locali[0]->term_id); ?> <?php echo (get_field('locali', 'tipologie_'.$locali[0]->term_id) > 1 ) ? __('Locali', 'frt') : __('Locale', 'frt'); ?></span>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?>
<?php endif; ?>