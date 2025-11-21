<?php
/**
 * InkRockit Homepage - PHP Wrapper
 *
 * This file sets aggressive cache-control headers to ensure
 * users always get the fresh version of the homepage.
 *
 * Created: 2025-01-21
 */

// Set cache-control headers to prevent browser caching
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Add timestamp for cache busting
$version = time();

// Set Content-Type header to ensure HTML is served correctly
header("Content-Type: text/html; charset=UTF-8");

// Read and output the HTML file directly (not as PHP code)
readfile(__DIR__ . '/index.html');
?>
