<?php
/**
 * Plugin Name:       X3P0 - Comment Parent Link
 * Plugin URI:        https://github.com/x3p0-dev/x3p0-comment-parent-link
 * Description:       A block for displaying a comment parent link (e.g., "In reply to {comment author}").
 * Version:           1.0.0-alpha
 * Requires at least: 5.9
 * Requires PHP:      8.0
 * Author:            Justin Tadlock
 * Author URI:        https://x3p0.com
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       x3p0-comment-parent-link
 */

namespace X3P0\CommentParentLink;

// Autoload classes and files.
require_once 'src/Block.php';
require_once 'src/functions-helpers.php';

// Bootstrap the plugin.
plugin();
