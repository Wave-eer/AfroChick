<?php
$adminPage = 'settings';
$adminTitle = 'Admin';
$adminHeading = 'Settings';
$adminSubheading = 'Profile, security, and preferences';
require_once __DIR__ . '/includes/layout-start.php';
?>

<div class="settings-layout">
    <nav class="settings-tabs" role="tablist">
        <button type="button" class="settings-tab active" data-tab="profile" role="tab">Profile</button>
        <button type="button" class="settings-tab" data-tab="password" role="tab">Password</button>
        <button type="button" class="settings-tab" data-tab="general" role="tab">General</button>
    </nav>

    <div class="settings-panels">
        <section class="glass-card admin-panel settings-panel active" id="panel-profile" role="tabpanel">
            <h2 class="panel-title">Profile</h2>
            <form id="profile-form" class="submit-form" novalidate>
                <div class="form-group">
                    <label for="profile-name">Full name</label>
                    <input type="text" id="profile-name" required>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="profile-email">Email</label>
                    <input type="email" id="profile-email" required>
                    <span class="field-error" hidden></span>
                </div>
                <button type="submit" class="btn btn-primary">Save profile</button>
                <p class="form-message" id="profile-message" hidden></p>
            </form>
        </section>

        <section class="glass-card admin-panel settings-panel hidden" id="panel-password" role="tabpanel">
            <h2 class="panel-title">Change password</h2>
            <form id="password-form" class="submit-form" novalidate>
                <div class="form-group">
                    <label for="current-password">Current password</label>
                    <input type="password" id="current-password" required autocomplete="current-password">
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="new-password">New password</label>
                    <input type="password" id="new-password" required autocomplete="new-password">
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm new password</label>
                    <input type="password" id="confirm-password" required autocomplete="new-password">
                    <span class="field-error" hidden></span>
                </div>
                <button type="submit" class="btn btn-primary">Update password</button>
                <p class="form-message" id="password-message" hidden></p>
            </form>
        </section>

        <section class="glass-card admin-panel settings-panel hidden" id="panel-general" role="tabpanel">
            <h2 class="panel-title">General preferences</h2>
            <form id="general-form" class="submit-form">
                <label class="toggle-row">
                    <span>
                        <strong>Email notifications</strong>
                        <small>Receive alerts for new product submissions</small>
                    </span>
                    <input type="checkbox" id="pref-notifications" class="toggle-input">
                    <span class="toggle-switch"></span>
                </label>
                <label class="toggle-row">
                    <span>
                        <strong>Auto-approve trusted brands</strong>
                        <small>Skip manual review for verified partners (demo)</small>
                    </span>
                    <input type="checkbox" id="pref-auto-approve" class="toggle-input">
                    <span class="toggle-switch"></span>
                </label>
                <div class="form-group">
                    <label for="pref-timezone">Timezone</label>
                    <select id="pref-timezone" class="admin-select full-width">
                        <option value="UTC">UTC</option>
                        <option value="Africa/Lagos">Africa/Lagos</option>
                        <option value="Europe/Stockholm">Europe/Stockholm</option>
                        <option value="America/New_York">America/New_York</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save preferences</button>
                <p class="form-message" id="general-message" hidden></p>
            </form>
        </section>
    </div>
</div>

<?php
$adminJs = ['admin-settings.js'];
require_once __DIR__ . '/includes/layout-end.php';
?>
