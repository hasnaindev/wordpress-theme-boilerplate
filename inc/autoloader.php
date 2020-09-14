<?php

  /**
   * Autoload will include files that exist within Boilerplate
   * namespace inside `inc` folder.
   */
  spl_autoload_register(
    fn (string $class_name)
      => strpos($class_name, 'Boilerplate') !== false
        && require_once($class_name . '.php'),
  );
