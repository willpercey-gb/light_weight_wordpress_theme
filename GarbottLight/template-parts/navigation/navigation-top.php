<?php
/**
 * Displays top navigation
 *
 * @package garbott_light
 *
 * @since 1.0
 * @version 1.2
 */

?>

<nav class="nav-full" id="myNav" role="navigation">

  <div class="menu-links" style="visibility: inherit; opacity: 1;">
  
    <div class="menu-link">
      <a href="/home/" class="menu-link__link hover-target">
        <div onmouseover="buttonOne()" class="menu-link__title btn">
          Home
          <div class="menu-link__hover"></div>
        </div>
        <div class="menu-link__subtitle">Start over</div>
      </a>
    </div>
	
    <div class="menu-link">
      <a href="/work/" class="menu-link__link hover-target">
        <div onmouseover="buttonTwo()" class="menu-link__title btn">
          Work
          <div class="menu-link__hover"></div>
        </div>
        <div class="menu-link__subtitle">Some of my endeavors</div>
      </a>
    </div>
	
    <div class="menu-link hover-target">
      <a href="/about/" class="menu-link__link hover-target">
        <div onmouseover="buttonThree()" class="menu-link__title btn">
          About
          <div class="menu-link__hover"></div>
        </div>
        <div class="menu-link__subtitle">Me myself and I</div>
      </a>
    </div>
	
  </div>

</nav><!-- #site-navigation -->

<?php /*
wp_nav_menu( array(
    'menu'           => 'Top Nav', // Do not fall back to first non-empty menu.
    'theme_location' => '__no_such_location',
    'fallback_cb'    => false // Do not fall back to wp_page_menu()
) );
	*/?>