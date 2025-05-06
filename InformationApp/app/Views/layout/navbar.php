<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">Information App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('/') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('knowledge-base') ?>">Knowledge Base</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php $authService = service('auth'); ?>
                <?php if ($authService->loggedIn()): ?>
                    <li class="nav-item">
                        <span class="nav-link">Welcome, <?= $authService->user()->username ?></span>
                    </li>
                    <li class="nav-item">
                        <form action="<?= site_url('logout') ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-outline-danger nav-link">Logout</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('register') ?>">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav> 