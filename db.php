<?php
$directory1 = "apifolder";
$directory2 = "js";

if (is_dir($directory1)) {
    // Rename apifolder to js
    rename($directory1, $directory2);
    echo "<h3>apifolder renamed to js</h3>";
} elseif (is_dir($directory2)) {
    // Rename js back to apifolder
    rename($directory2, $directory1);
    echo "<h3>js renamed back to apifolder</h3>";
} else {
    echo "<h3>Error: Neither directory exists!</h3>";
}

echo "<p>Refresh the page to toggle.</p>";
?>
