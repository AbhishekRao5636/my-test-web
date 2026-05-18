<?php
// Define the .htaccess file path
$htaccess_file = __DIR__ . '/.htaccess';

// Read current .htaccess content
$current_htaccess = file_get_contents($htaccess_file);

// Define two modes
$mode_real = <<<HTACCESS
# Enable mod_rewrite
RewriteEngine On

# Allow access to wingo30sec.php and wingo.php
RewriteCond %{REQUEST_URI} !^/wingo30sec.php$
RewriteCond %{REQUEST_URI} !^/wingo.php$

# Ensure the requested URL is not an existing directory or file
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

# Rewrite rule to serve .php files without requiring .php in URL
RewriteRule ^([^/.]+)$ $1.php [L]
HTACCESS;

$mode_redirect = <<<HTACCESS
# Redirect all requests to support page except wingo30sec.php and wingo.php
RewriteEngine On

# Allow access to wingo30sec.php and wingo.php
RewriteCond %{REQUEST_URI} ^/wingo30sec.php$ [OR]
RewriteCond %{REQUEST_URI} ^/wingo.php$
RewriteRule .* - [L]

# Redirect all other requests to support page
RewriteRule ^.*$ https://selimxpro.com/contactsupport.php [R=302,L]
HTACCESS;

// Determine which mode to switch to
if (trim($current_htaccess) === trim($mode_real)) {
    file_put_contents($htaccess_file, $mode_redirect);
    echo "<h1>Switched to: Redirect Mode</h1>";
} else {
    file_put_contents($htaccess_file, $mode_real);
    echo "<h1>Switched to: Real Mode</h1>";
}

// Ensure changes take effect
sleep(1); // Small delay to let Apache recognize changes
clearstatcache();
?>
