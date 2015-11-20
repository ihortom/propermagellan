<?php
/**
 * Topbar + Magellan
 */
?>
<div data-magellan-expedition="fixed">
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
              <h1><a href="#"><?php bloginfo('name'); ?></a></h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"><i class="fa fa-bars fa-2x"></i></a></li>
        </ul>
        <section class="top-bar-section">            
        <?php 
            if (has_nav_menu('primary')) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'depth'          => '1', 
                    'link_before'    => '', 
                    'link_after'     => '',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'         => new Magelan_Walker()
                ) );
            }
        ?>            
        </section>
    </nav>
</div>

