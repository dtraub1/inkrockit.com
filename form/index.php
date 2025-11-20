<?php
// Set no-cache headers to prevent browser caching
header("Cache-Control: no-cache, no-store, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// Serve the HTML content
readfile(__DIR__ . '/index.html');
