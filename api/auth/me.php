<?php
require_once dirname(__DIR__, 2) . '/includes/api_helpers.php';
apiBootstrap();

$user = currentUser();
if (!$user) {
    jsonResponse(['success' => false, 'user' => null], 401);
}
jsonResponse(['success' => true, 'user' => $user]);
