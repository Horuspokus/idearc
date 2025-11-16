<?php
/**
 * Lightweight bootstrap to serve the static IDEArc site.
 * WordPress files remain in the repository for reference,
 * but the public entry point now streams the static HTML version.
 */

$staticIndex = __DIR__ . '/index.html';

if (is_file($staticIndex)) {
    readfile($staticIndex);
    return;
}

http_response_code(500);
echo 'Static site not found.';
