<?php

  namespace Boilerplate;

  if (class_exists('Sidebar')) return;

  /**
   * Sidebar class creates instances of sidebars
   * and localizes the required parameters.
   * 
   * @access public
   */
  class Sidebar {
    private string $name;
    private string $id;
    private string $description;
    private string $class;
    private string $before_widget;
    private string $after_widget;
    private string $before_title;
    private string $after_title;

    /**
     * Constructs sidebar
     * 
     * @param string $name The name or title of the sidebar displayed in the Widgets interface.
     * @param string $id The unique identifier by which the sidebar will be called.
     * @param string $description Description of the sidebar, displayed in the Widgets interface.
     * @param string $class Extra CSS class to assign to the sidebar in the Widgets interface.
     * @param string $before_widget HTML content to prepend to each widget's HTML output when assigned to this sidebar, default is an opening list item element.
     * @param string $after_widget HTML content to append to each widget's HTML output when assigned to this sidebar, default is a closing list item element.
     * @param string $before_title HTML content to prepend to the sidebar title when displayed, default is an opening h2 element.
     * @param string $after_title HTML content to append to the sidebar title when displayed, default is a closing h2 element.
     * 
     * @return void
     * @access public
     */
    function __construct(
      string $name = '',
      string $id = '',
      string $description = '',
      string $class = '',
      string $before_widget = '<li id="%1$s" class="widget %2$s">',
      string $after_widget = '</li>',
      string $before_title = '<h2 class="widgettitle">',
      string $after_title = '</h2>'
    )
    {
      $this->name = $name;
      $this->id = $id;
      $this->description = $description;
      $this->class = $class;
      $this->before_widget = $before_widget;
      $this->after_widget = $after_widget;
      $this->before_title = $before_title;
      $this->after_title = $after_title;
    }

    /**
     * Registers the sidebar with `register_sidebar` function,
     * call this inside the `widgets_init` hook.
     * 
     * @return void
     * @access public
     */
    function register(): void
    {
      register_sidebar($this->to_array());
    }

    /**
     * Checks whether sidebar is active or not.
     * 
     * @param string $sidebar_id Id of the sidebar.
     * 
     * @return bool True or falce depending if sidebar was found.
     * @access public
     */
    static function is_active(string $sidebar_id): bool
    {
      return is_active_sidebar($sidebar_id);
    }

    /**
     * Loads a sidebar, prefered to be used after the
     * `is_active` static method.
     * 
     * @param string $sidebar_id Id of the sidebar.
     * 
     * @return void
     * @access public
     */
    static function get_sidebar(string $sidebar_id): void
    {
      dynamic_sidebar($sidebar_id);
    }

    /**
     * Returns all the instance properties as an array.
     * 
     * @return array
     * @access private
     */
    private function to_array(): array
    {
      return array(
        'name' => __($this->name, 'boilerplate'),
        'id' => $this->id,
        'description' => __($this->description, 'boilerplate'),
        'class' => $this->class,
        'before_widget' => $this->before_widget,
        'after_widget' => $this->after_widget,
        'before_title' => $this->before_title,
        'after_title' => $this->after_title,
      );
    }
  }
