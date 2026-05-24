        </div>
    </div>
</div>

<div class="toast-container" id="toast-container"></div>

<script src="<?= ASSETS_URL ?>/js/auth.js"></script>
<script src="<?= ASSETS_URL ?>/js/mockData.js"></script>
<script src="<?= ASSETS_URL ?>/js/admin-store.js"></script>
<script src="<?= ASSETS_URL ?>/js/admin-common.js"></script>
<?php if (!empty($adminJs)): ?>
    <?php foreach ((array)$adminJs as $js): ?>
<script src="<?= ASSETS_URL ?>/js/<?= htmlspecialchars($js) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
