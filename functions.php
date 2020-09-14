<?php

  /**
   * This file will serve as a configuration file for the theme,
   * all the functions and classes needed for the theme
   * will be defined inside the `inc` folder and only
   * includes or called here for initialization.
   */

  /**
   * Requiring theme functions.
   */
  require_once('inc' . DIRECTORY_SEPARATOR . 'theme-functions.php');

  /**
   * Autoload will include files that exist within Boilerplate
   * namespace inside `inc` folder.
   */
  spl_autoload_register(
    fn (string $class_name)
      => strpos($class_name, 'Boilerplate') !== false
        && require_once('inc' . DIRECTORY_SEPARATOR . $class_name . '.php'),
  );

  /**
   * Add theme supports and nav menus.
   */
  add_action('after_setup_theme', 'Boilerplate\theme_setup');

  /**
   * Add theme widgets.
   */
  add_action('widgets_init', 'Boilerplate\widgets_init');

  /**
   * Enqueue theme assets.
   */
  add_action('wp_enqueue_scripts', 'Boilerplate\enqueue_assets');

  /**
   * Removes WordPress theme bloat, this doesn't seem to have
   * significant impact on the load time of the website.
   */
  add_action('init', 'Boilerplate\remove_bloat');
