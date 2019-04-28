<?php
session_start();
session_destroy();
echo "session ending, variables being purged";
?>