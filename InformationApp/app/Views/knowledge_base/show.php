<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2><?= esc($entry['title']) ?></h2>
            <div>
                <a href="<?= site_url('knowledge-base') ?>" class="btn btn-secondary">Back to List</a>
                <a href="<?= site_url('knowledge-base/'.$entry['id'].'/edit') ?>" class="btn btn-warning">Edit</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Project Code:</div>
                <div class="col-md-9"><?= esc($entry['project_code']) ?></div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Status:</div>
                <div class="col-md-9">
                    <span class="badge bg-<?= $entry['status'] == 'Solved' ? 'success' : ($entry['status'] == 'Open' ? 'danger' : 'warning') ?>">
                        <?= esc($entry['status']) ?>
                    </span>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Rating:</div>
                <div class="col-md-9">
                    <?php for($i = 0; $i < $entry['rating']; $i++): ?>
                        <i class="fas fa-star text-warning"></i>
                    <?php endfor; ?>
                    <?php for($i = $entry['rating']; $i < 5; $i++): ?>
                        <i class="far fa-star"></i>
                    <?php endfor; ?>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Created:</div>
                <div class="col-md-9"><?= $entry['created_at'] ?> by <?= esc($entry['created_by']) ?></div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Last Modified:</div>
                <div class="col-md-9"><?= $entry['modified_at'] ?> by <?= esc($entry['modified_by']) ?></div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Solution:</div>
                <div class="col-md-9">
                    <div class="p-3 bg-light">
                        <?= nl2br(esc($entry['solution'])) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>