import lozad from 'lozad';

/**
 * Lazy loads assets into website.
 *
 * @access public
 * @returns {void} `void`
 * @package https://github.com/ApoorvSaxena/lozad.js
 */
function init() {
  lozad().observe();
}

export default init;
