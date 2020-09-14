<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

  <header>
    <?php
      wp_nav_menu(array(
        'container' => 'nav',
        'theme_location' => 'main-menu',
      ));
    ?>
  </header>
