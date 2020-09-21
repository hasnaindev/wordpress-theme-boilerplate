<?php

  namespace Boilerplate;

  if (class_exists('Enqueuer')) return;

  /**
   * Enqueuer class will aggregate styles and scripts
   * and other such assets and then enqueue them, must
   * be called inside the `wp_enqueue_script` action hook.
   * 
   * @access public
   */
  class Enqueuer {
    private array $styles;
    private array $scripts;
    private string $theme_version;

    /**
     * Constructor deregusters jQuery and requires
     * a theme version so, pass it along.
     * 
     * @param string $theme_version Theme version, defaults to `microtime` to bust cache.
     * 
     * @access public
     * @return void
     */
    function __construct(string $theme_version)
    {
      $this->styles = array();
      $this->scripts = array();
      $this->theme_version = $theme_version;
    }

    /**
     * Add style asset to the enqueuer.
     * 
     * @param string $handle Slug for the style asset.
     * @param string $src Source or destination of the style asset, will be relative to `get_template_directory_uri` if starts with '/'.
     * @param array $deps Dependencies of the respective style asset.
     * @param string $media
     * 
     * @return Enqueuer Returns itself for method chaining
     * @access public
     */
    function add_style(
      string $handle = '',
      string $src = '',
      array $deps = array(),
      string $version = '',
      string $media = 'all'
    ): Enqueuer
    {
      if (empty($version))
        $version = $this->theme_version;

      if ($src['0'] == '/')
        $src = get_template_directory_uri() . $src;

      $this->styles[] = array(
        $handle,
        $src,
        $deps,
        $version,
        $media,
      );

      return $this;
    }

    /**
     * Add script asset to the enqueuer.
     * 
     * @param string $handle Slug for the script asset.
     * @param string $src Source or destination of the script asset, will be relative to `get_template_directory_uri` if starts with '/'.
     * @param array $deps Dependencies of the respective script asset.
     * @param string $in_footer If script should be loaded in footer.
     * 
     * @return Enqueuer Returns itself for method chaining
     * @access public
     */
    function add_script(
      string $handle = '',
      string $src = '',
      array $deps = array(),
      string $version = '',
      bool $in_footer = true
    ): Enqueuer
    {
      if (empty($version))
        $version = $this->theme_version;

      if ($src['0'] == '/')
        $src = get_template_directory_uri() . $src;

      $this->scripts[] = array(
        $handle,
        $src,
        $deps,
        $version,
        $in_footer,
      );

      return $this;
    }

    /**
     * Enqueues all the added style and script assets,
     * call inside the `wp_enqueue_scripts` action hook.
     * 
     * @return Enqueuer Returns itself for method chaining
     * @access public
     */
    function enqueue(): void
    {
      foreach ($this->styles as $style)
        wp_enqueue_style($style[0], $style[1], $style[2], $style[3], $style[4]);

      foreach ($this->scripts as $script)
        wp_enqueue_script($script[0], $script[1], $script[2], $script[3], $script[4]);
    }

    /**
     * Deregisters the defined scripts.
     * 
     * @param array $scripts Names of the scripts that needs to be deregistered.
     * 
     * @access public
     */
    function deregister_scripts(array $scripts): void
    {
      foreach ($scripts as $script)
       wp_deregister_script($script);
    }
  }
