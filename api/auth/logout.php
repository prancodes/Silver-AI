<?php
// api/auth/logout.php
session_unset();
session_destroy();
header("Location: /");
exit();
?>
