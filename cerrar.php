<?php
require("../library/reusedFunctions.php");
destroySession();
// Redirige al login
header("Location: index.php");
exit;