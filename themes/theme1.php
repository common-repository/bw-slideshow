<?php
if(!empty($list)):

$arr_status = array(0=>'false', 1=>'true');
$timeout = $instance['timeout'];
$visible = $instance['visible'];
$effect = $instance['effect']; //fade, fadeout, none, carousel, and scrollHorz.
$starting_slide = $instance['starting_slide'];
$pause_on_hover = $arr_status[$instance['pause_on_hover']];
$responsive = $arr_status[$instance['responsive']];
$swipe = $arr_status[$instance['swipe']];
$random = $arr_status[$instance['random']];
$theme = $instance['theme'];
$image_size = $instance['image_size'];
$slide_active_class = "bm_cycle_slider_active";
$slide_class = "bm_cycle_slider";
$pager_active_class = "bm_slider_cycle_pager_active";
$show_readmore = $instance['show_readmore'];
$readmore_label = $instance['readmore_label'];
$show_paging = $instance['show_paging'];
$show_desc = $instance['show_desc'];

?>
<div class="bm_over bm_over_<?php echo $theme;?>">
    <div id="bm_slider_<?php echo $widget_id;?>" class="bm_slider bm_slider_<?php echo $theme;?>" 
        data-cycle-fx="<?php echo $effect;?>"
        data-cycle-timeout="<?php echo $timeout;?>"
        data-cycle-carousel-visible=<?php echo $visible;?>
        data-cycle-next="#bm_slider_next_<?php echo $widget_id;?>"
        data-cycle-prev="#bm_slider_prev_<?php echo $widget_id;?>"
        data-cycle-pager="#bm_slider_pager_<?php echo $widget_id;?>"
        data-cycle-starting-slide=<?php echo $starting_slide;?>
        data-cycle-pause-on-hover=<?php echo $pause_on_hover;?>
        data-cycle-slides="> div"
        data-cycle-swipe=false
        data-cycle-carousel-fluid=<?php echo $responsive;?>
        data-cycle-random=<?php echo $random;?>
        data-cycle-slide-active-class=<?php echo $slide_active_class;?>
        data-cycle-slide-class=<?php echo $slide_class;?>
        data-cycle-pager-active-class=<?php echo $pager_active_class;?>
        >
        <?php foreach ( $list as $i => $post ) : ?> 
            <div class="bm_slider_item">
                <a href="<?php echo get_permalink( $post->ID ); ?>" >
                    <?php echo get_the_post_thumbnail ($post->ID, $image_size); ?>
                </a>
                           
                <div class="bm_slider_title">
                    <a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
                </div>
				<?php if($show_desc):?>
					<div class="bm_slider_desc">
						<div class="bm_desc_inside">
							<?php
								if ( preg_match('/<!--more(.*?)?-->/', $post->post_content, $matches) ) {
									$content = explode($matches[0], $post->post_content, 2);
									$content = $content[0];
								} else {
									$text = strip_shortcodes( $post->post_content );
									$text = apply_filters('the_content', $text);
									$text = str_replace(']]>', ']]&gt;', $text);
									$content = wp_trim_words($text, $length);
								}
								echo $content;
							?>
							<?php if($show_readmore):?>
								<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $readmore_label; ?></a>
							<?php endif;?>
						</div>
					</div>
				<?php endif;?>
            </div>
        <?php endforeach; ?> 
    
    </div>
    
    <div class="bm_slider_button">
        <div id="bm_slider_prev_<?php echo $widget_id;?>" class="bm_slider_prev"> prev </div>
        <div id="bm_slider_next_<?php echo $widget_id;?>" class="bm_slider_next"> next </div>
    </div>
    
</div>
<?php if($show_paging): ?>
	<div class="bm_slider_cycle_pager" id="bm_slider_pager_<?php echo $widget_id;?>"></div>
<?php endif; ?>

<script type="text/javascript" language="javascript">

	jQuery(document).ready(function() {
		jQuery('#bm_slider_<?php echo $widget_id;?>').cycle();
	});

</script> 

<?php else: ?>
	<div class="bm-nodata"><?php echo 'Found no item!';?></div>
<?php endif;?>