<?php

function printErrors()
{
    if (!empty($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo '<div class="error-container">';
            echo '<p><i class="fa-regular fa-circle-question"></i> ' . htmlspecialchars($error) . '</p>';
            echo '</div>';
        }
        $_SESSION['errors'] = array();
    }
}
