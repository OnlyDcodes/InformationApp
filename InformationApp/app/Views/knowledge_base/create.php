<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Add New Knowledge Base Entry</h1>
    
    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form action="<?= site_url('knowledge-base') ?>" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="project_code" class="form-label">Project Code</label>
            <input type="text" class="form-control" id="project_code" name="project_code" value="<?= old('project_code') ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="solution" class="form-label">Solution</label>
            <textarea class="form-control" id="solution" name="solution" rows="5" required><?= old('solution') ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="Open" <?= old('status') == 'Open' ? 'selected' : '' ?>>Open</option>
                <option value="In Progress" <?= old('status') == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="Solved" <?= old('status') == 'Solved' ? 'selected' : '' ?>>Solved</option>
                <option value="Closed" <?= old('status') == 'Closed' ? 'selected' : '' ?>>Closed</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="d-flex">
                <?php for($i = 0; $i <= 5; $i++): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rating" id="rating<?= $i ?>" value="<?= $i ?>" <?= old('rating') == $i ? 'checked' : ($i == 0 ? 'checked' : '') ?>>
                    <label class="form-check-label" for="rating<?= $i ?>"><?= $i ?></label>
                </div>
                <?php endfor; ?>
            </div>
        </div>
        
        <div class="mb-3">
            <a href="<?= site_url('knowledge-base') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>