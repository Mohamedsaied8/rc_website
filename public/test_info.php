<?php
echo "Opcache: " . (extension_loaded('Zend Opcache') ? 'ON' : 'OFF') . "<br>";
echo "JIT: " . (ini_get('opcache.jit') ?: 'Disabled') . "<br>";
phpinfo();
?>