<?php
function is_admin() {
    return isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1;
}

function sanitize_input($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>
