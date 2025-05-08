<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h1>Edit Knowledge Base Entry</h1>
    
    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form action="<?= site_url('knowledge-base/'.$entry['id']) ?>" method="post">
        <input type="hidden" name="_method" value="PUT">
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= old('title', $entry['title']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="project_code" class="form-label">Project Code</label>
            <input type="text" class="form-control" id="project_code" name="project_code" value="<?= old('project_code', $entry['project_code']) ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="solution" class="form-label">Solution</label>
            <textarea class="form-control" id="solution" name="solution" rows="5" required><?= old('solution', $entry['solution']) ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="">Select Status</option>
                <option value="Open" <?= old('status', $entry['status']) == 'Open' ? 'selected' : '' ?>>Open</option>
                <option value="In Progress" <?= old('status', $entry['status']) == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="Solved" <?= old('status', $entry['status']) == 'Solved' ? 'selected' : '' ?>>Solved</option>
                <option value="Closed" <?= old('status', $entry['status']) == 'Closed' ? 'selected' : '' ?>>Closed</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5" <?= old('rating', $entry['rating']) == 5 ? 'checked' : '' ?>>
                <label for="star5" id="star5-label"><i class="far fa-star"></i></label>
                
                <input type="radio" id="star4" name="rating" value="4" <?= old('rating', $entry['rating']) == 4 ? 'checked' : '' ?>>
                <label for="star4" id="star4-label"><i class="far fa-star"></i></label>
                
                <input type="radio" id="star3" name="rating" value="3" <?= old('rating', $entry['rating']) == 3 ? 'checked' : '' ?>>
                <label for="star3" id="star3-label"><i class="far fa-star"></i></label>
                
                <input type="radio" id="star2" name="rating" value="2" <?= old('rating', $entry['rating']) == 2 ? 'checked' : '' ?>>
                <label for="star2" id="star2-label"><i class="far fa-star"></i></label>
                
                <input type="radio" id="star1" name="rating" value="1" <?= old('rating', $entry['rating']) == 1 ? 'checked' : '' ?>>
                <label for="star1" id="star1-label"><i class="far fa-star"></i></label>
                
                <input type="radio" id="star0" name="rating" value="0" <?= old('rating', $entry['rating']) === null || old('rating', $entry['rating']) == 0 ? 'checked' : '' ?>>
            </div>
        </div>
        
        <div class="mb-3">
            <a href="<?= site_url('knowledge-base') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const starLabels = document.querySelectorAll('.star-rating label');
        const starInputs = document.querySelectorAll('.star-rating input[type="radio"]');
        
        // Initialize stars based on selected value
        function updateStars() {
            const checkedValue = document.querySelector('.star-rating input:checked')?.value || 0;
            starLabels.forEach((label, index) => {
                const starNumber = 5 - index;
                const iconElement = label.querySelector('i');
                
                if (starNumber <= checkedValue) {
                    iconElement.className = 'fas fa-star';
                    label.classList.add('selected');
                } else {
                    iconElement.className = 'far fa-star';
                    label.classList.remove('selected');
                }
            });
        }
        
        // Add hover effect
        starLabels.forEach((label, index) => {
            label.addEventListener('mouseenter', () => {
                const starNumber = 5 - index;
                
                starLabels.forEach((innerLabel, innerIndex) => {
                    const innerStarNumber = 5 - innerIndex;
                    const iconElement = innerLabel.querySelector('i');
                    
                    if (innerStarNumber <= starNumber) {
                        iconElement.className = 'fas fa-star';
                        innerLabel.classList.add('hover');
                    } else {
                        iconElement.className = 'far fa-star';
                        innerLabel.classList.remove('hover');
                    }
                });
            });
            
            label.addEventListener('mouseleave', () => {
                starLabels.forEach(innerLabel => {
                    innerLabel.classList.remove('hover');
                });
                updateStars();
            });
        });
        
        // Handle clicks
        starInputs.forEach(input => {
            input.addEventListener('change', updateStars);
        });
        
        // Initial update
        updateStars();
    });
    </script>
</div>
<?= $this->endSection() ?>