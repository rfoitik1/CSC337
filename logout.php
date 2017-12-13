<?php
session_start();
session_destroy();
echo 'You have been logged out. Redirecting to home screen...';
$url='intro.php';
echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '.$url.'">';

?>
