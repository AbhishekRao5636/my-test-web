<?php
// Define the .htaccess file path
$htaccess_file = __DIR__ . '/.htaccess';

// Read current .htaccess content
$current_htaccess = file_get_contents($htaccess_file);

// Define two modes
$mode1 = <<<HTACCESS
# Enable mod_rewrite
RewriteEngine On

# Allow access to wingo.php
RewriteCond %{REQUEST_URI} !^/wingo.php$

# Ensure the requested URL is not an existing directory or file
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

# Rewrite rule to serve .php files without requiring .php in URL
RewriteRule ^([^/.]+)$ $1.php [L]
HTACCESS;

$mode2 = <<<HTACCESS
# Force all requests to show 404, except wingo.php
ErrorDocument 404 /404.php
RewriteEngine On

# Allow access to wingo.php
RewriteCond %{REQUEST_URI} !^/wingo.php$
RewriteRule .* - [R=404,L]
HTACCESS;

// Determine which mode to switch to
if (trim($current_htaccess) === trim($mode1)) {
    file_put_contents($htaccess_file, $mode2);
    echo "<h1>Switched to: Force 404 Mode</h1>";
} else {
    file_put_contents($htaccess_file, $mode1);
    echo "<h1>Switched to: PHP Rewrite Mode</h1>";
}

// Ensure changes take effect
sleep(1); // Small delay to let Apache recognize changes
clearstatcache();
?>
