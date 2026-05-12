<?php
/**
 * Zero-Day Stealth Index
 * Purpose: Hide the API directory from public view.
 */

header('HTTP/1.1 403 Forbidden');
?>
<!DOCTYPE html>
<html>
<head>
    <title>403 Forbidden</title>
    <style>
        body { margin: 0; padding: 0; font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif; }
        div { width: 600px; margin: 5em auto; padding: 2em; background-color: #fdfdff; border-radius: 0.5em; box-shadow: 2px 3px 7px 2px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
<div>
    <h1>403 Forbidden</h1>
    <p>Access to this resource is denied.</p>
</div>
</body>
</html>
