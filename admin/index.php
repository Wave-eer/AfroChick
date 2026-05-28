<?php
$adminPage = 'dashboard';
$adminTitle = 'Admin';
$adminHeading = 'Dashboard';
$adminSubheading = 'Overview and analytics';
require_once __DIR__ . '/includes/layout-start.php';
?>

<div class="stats-grid" id="stats-grid"></div>

<div class="admin-grid-2">
    <section class="glass-card admin-panel">
        <h2 class="panel-title">Analysis breakdown</h2>
        <div class="chart-bars" id="analysis-chart"></div>
    </section>
    <section class="glass-card admin-panel">
        <h2 class="panel-title">Product status</h2>
        <div class="chart-bars" id="product-chart"></div>
    </section>
</div>

<section class="glass-card admin-panel">
    <div class="panel-header">
        <h2 class="panel-title">Users</h2>
        <a href="/admin/users.php" class="form-link">View all users →</a>
    </div>
    <div class="table-wrap">
        <table class="admin-table" id="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<section class="glass-card admin-panel">
    <div class="panel-header">
        <h2 class="panel-title">Recent analyses</h2>
        <a href="/admin/products.php" class="form-link">Manage products →</a>
    </div>
    <div class="table-wrap">
        <table class="admin-table" id="analyses-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>User</th>
                    <th>Profile</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<section class="glass-card admin-panel">
    <div class="panel-header">
        <h2 class="panel-title">Pending submissions</h2>
    </div>
    <div class="table-wrap">
        <table class="admin-table" id="submissions-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Contact</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</section>

<?php
$adminJs = ['admin-dashboard.js'];
require_once __DIR__ . '/includes/layout-end.php';
?>
