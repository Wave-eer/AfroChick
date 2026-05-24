<?php
$adminPage = 'users';
$adminTitle = 'Admin';
$adminHeading = 'Users';
$adminSubheading = 'All registered accounts from the database';
require_once __DIR__ . '/includes/layout-start.php';
?>

<div class="panel-header panel-header-flush">
    <p class="panel-desc">Users stored in the <code>users</code> MySQL table. New signups are saved here automatically.</p>
    <button type="button" class="btn btn-secondary btn-sm" id="refresh-users">
        <i data-lucide="refresh-cw"></i> Refresh
    </button>
</div>

<div class="admin-toolbar">
    <div class="search-wrap">
        <i data-lucide="search"></i>
        <input type="search" id="user-search" placeholder="Search by name or email…" aria-label="Search users">
    </div>
    <select id="user-role-filter" class="admin-select" aria-label="Filter by role">
        <option value="all">All roles</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
    </select>
</div>

<div class="table-wrap glass-card">
    <table class="admin-table" id="users-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="users-tbody"></tbody>
    </table>
    <p class="empty-state hidden" id="users-empty">No users found.</p>
</div>

<?php
$adminJs = ['admin-users.js'];
require_once __DIR__ . '/includes/layout-end.php';
?>
