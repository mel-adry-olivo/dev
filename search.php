<?php
header("Location: " . ($_SERVER['HTTP_REFERER'] ?? './index.php'));
exit();
?>