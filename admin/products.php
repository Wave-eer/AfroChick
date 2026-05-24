<?php
$adminPage = 'products';
$adminTitle = 'Admin';
$adminHeading = 'Products';
$adminSubheading = 'Create, edit, view, and delete products';
require_once __DIR__ . '/includes/layout-start.php';
?>

<div class="panel-header panel-header-flush">
    <p class="panel-desc">Manage the Product Center catalog. Only approved products appear on the public site.</p>
    <button type="button" class="btn btn-primary" id="btn-create-product">
        <i data-lucide="plus"></i> Create product
    </button>
</div>

<div class="admin-toolbar">
    <div class="search-wrap">
        <i data-lucide="search"></i>
        <input type="search" id="admin-product-search" placeholder="Search products…" aria-label="Search products">
    </div>
    <select id="admin-status-filter" class="admin-select" aria-label="Filter by status">
        <option value="all">All statuses</option>
        <option value="approved">Approved</option>
        <option value="pending">Pending</option>
        <option value="rejected">Rejected</option>
    </select>
</div>

<div class="table-wrap glass-card">
    <table class="admin-table" id="products-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="products-tbody"></tbody>
    </table>
    <p class="empty-state hidden" id="products-empty">No products found.</p>
</div>

<!-- Product modal -->
<div class="modal-overlay hidden" id="product-modal" role="dialog" aria-modal="true">
    <div class="modal modal-lg glass-card">
        <button type="button" class="modal-close btn-icon" id="modal-close" aria-label="Close">
            <i data-lucide="x"></i>
        </button>
        <h2 class="modal-heading" id="modal-heading">Create product</h2>
        <form id="product-form" class="submit-form" novalidate>
            <input type="hidden" id="product-id" name="id">
            <div class="form-row-2">
                <div class="form-group">
                    <label for="product-name">Product name *</label>
                    <input type="text" id="product-name" required>
                    <span class="field-error" hidden></span>
                </div>
                <div class="form-group">
                    <label for="product-category">Category *</label>
                    <select id="product-category" required></select>
                    <span class="field-error" hidden></span>
                </div>
            </div>
            <div class="form-row-2">
                <div class="form-group">
                    <label for="product-price">Price</label>
                    <input type="text" id="product-price" placeholder="$42">
                </div>
                <div class="form-group">
                    <label for="product-image">Image (emoji)</label>
                    <input type="text" id="product-image" placeholder="🧴" maxlength="4">
                </div>
            </div>
            <div class="form-group">
                <label for="product-status">Status</label>
                <select id="product-status">
                    <option value="approved">Approved</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
            <div class="form-group">
                <label for="product-ingredients">Ingredients (comma-separated) *</label>
                <textarea id="product-ingredients" rows="2" required></textarea>
                <span class="field-error" hidden></span>
            </div>
            <div class="form-group">
                <label for="product-benefits">Benefits (comma-separated) *</label>
                <textarea id="product-benefits" rows="2" required></textarea>
                <span class="field-error" hidden></span>
            </div>
            <div class="form-group">
                <label for="product-description">Description *</label>
                <textarea id="product-description" rows="3" required></textarea>
                <span class="field-error" hidden></span>
            </div>
            <div class="modal-actions" id="modal-actions">
                <button type="button" class="btn btn-ghost" id="modal-cancel">Cancel</button>
                <button type="submit" class="btn btn-primary" id="modal-save">Save product</button>
            </div>
        </form>
        <div id="product-view" class="product-view hidden"></div>
    </div>
</div>

<!-- Delete confirm -->
<div class="modal-overlay hidden" id="delete-modal" role="dialog" aria-modal="true">
    <div class="modal glass-card modal-sm">
        <h2>Delete product?</h2>
        <p class="modal-desc">This cannot be undone. The product will be removed from the catalog.</p>
        <div class="modal-actions">
            <button type="button" class="btn btn-ghost" id="delete-cancel">Cancel</button>
            <button type="button" class="btn btn-danger" id="delete-confirm">Delete</button>
        </div>
    </div>
</div>

<?php
$adminJs = ['admin-products.js'];
require_once __DIR__ . '/includes/layout-end.php';
?>
