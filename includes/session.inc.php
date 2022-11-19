<?php
function isConnected()
{
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
}
?>