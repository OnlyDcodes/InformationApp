<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 style="color: white !important; margin-bottom: 0;">Knowledge Base Entries</h4>
                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addEntryModal">
                        <i class="fas fa-plus"></i> Add New Entry
                    </button>
                </div>
                <div class="card-body">
                    <!-- Search Bar -->
                    <form action="<?= site_url('knowledge-base') ?>" method="get" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by title, project code or solution..." value="<?= esc($search ?? '') ?>">
                            <button class="btn btn-light" type="submit">
                                <i class="fas fa-search"></i> Search
                            </button>
                            <?php if (isset($search) && !empty($search)): ?>
                                <a href="<?= site_url('knowledge-base') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                    
                    <?php if(session()->getFlashdata('message')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('message') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Search Bar -->
                    <div class="mb-4">
                        <form action="<?= site_url('knowledge-base') ?>" method="get">
                            <div class="search-box">
                                <input type="text" class="form-control search-input" placeholder="Search entries..." name="search" value="<?= isset($search) ? esc($search) : '' ?>">
                                <button class="btn search-button" type="submit">
                                    <i class="fas fa-search"></i> Search
                                </button>
                                <?php if(isset($search) && $search): ?>
                                    <a href="<?= site_url('knowledge-base') ?>" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i> Clear
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>

                    <?php if (empty($knowledge_base)): ?>
                        <div class="text-center py-5">
                            <p style="color: white !important;">No entries found. Click the button above to add your first entry.</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="title-col">TITLE</th>
                                        <th class="project-col">PROJECT CODE</th>
                                        <th class="status-col">
                                            STATUS
                                            <a href="<?= site_url('knowledge-base?sort=status&order=' . ($sort == 'status' && $order == 'asc' ? 'desc' : 'asc') . (isset($search) ? "&search=$search" : '')) ?>" class="sort-icon">
                                                <i class="fas fa-sort"></i>
                                            </a>
                                        </th>
                                        <th class="rating-col">
                                            RATING
                                            <a href="<?= site_url('knowledge-base?sort=rating&order=' . ($sort == 'rating' && $order == 'asc' ? 'desc' : 'asc') . (isset($search) ? "&search=$search" : '')) ?>" class="sort-icon">
                                                <i class="fas fa-sort"></i>
                                            </a>
                                        </th>
                                        <th class="created-col">CREATED BY</th>
                                        <th class="modified-col">MODIFIED BY</th>
                                        <th class="actions-col">ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($knowledge_base as $entry): ?>
                                        <tr>
                                            <td><?= esc($entry['title']) ?></td>
                                            <td><?= esc($entry['project_code']) ?></td>
                                            <td>
                                                <?php if($entry['status'] == 'Active' || $entry['status'] == 'Open'): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php elseif($entry['status'] == 'Pending' || $entry['status'] == 'In Progress'): ?>
                                                    <span class="badge bg-warning text-dark">In Progress</span>
                                                <?php elseif($entry['status'] == 'Solved'): ?>
                                                    <span class="badge bg-info">Solved</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?= esc($entry['status']) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="rating-stars">
                                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                                        <?php if($i <= $entry['rating']): ?>
                                                            <i class="fas fa-star" style="color: #FFD700;"></i>
                                                        <?php else: ?>
                                                            <i class="far fa-star" style="color: #ccc;"></i>
                                                        <?php endif; ?>
                                                    <?php endfor; ?>
                                                </div>
                                            </td>
                                            <td><?= esc($entry['created_by']) ?></td>
                                            <td><?= esc($entry['modified_by']) ?></td>
                                            <td class="td-actions">
                                                <a href="<?= site_url('knowledge-base/'.$entry['id']) ?>" class="btn btn-sm btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= site_url('knowledge-base/'.$entry['id'].'/edit') ?>" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="<?= site_url('knowledge-base/'.$entry['id']) ?>" method="post" class="d-inline">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this entry?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-4 d-flex justify-content-center pagination-wrapper">
                            <?= $pager->links() ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <a href="<?= site_url('/') ?>" class="btn btn-outline-light">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Add Entry Modal -->
<div class="modal fade" id="addEntryModal" tabindex="-1" aria-labelledby="addEntryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(45deg, #0A6397, #084e79); color: white;">
                <h5 class="modal-title" id="addEntryModalLabel">Add New Knowledge Base Entry</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body compact-modal-body">
                <form action="<?= site_url('knowledge-base') ?>" method="post" id="addEntryForm">
                    <div class="mb-2">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    
                    <div class="mb-2">
                        <label for="project_code" class="form-label">Project Code</label>
                        <input type="text" class="form-control" id="project_code" name="project_code" required>
                    </div>
                    
                    <div class="mb-2">
                        <label for="solution" class="form-label">Solution</label>
                        <textarea class="form-control" id="solution" name="solution" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-2">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="Open">Open</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Solved">Solved</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div>
                    
                    <div class="mb-2">
                        <label class="form-label">Rating</label>
                        <div class="star-rating-container">
                            <input type="hidden" name="rating" id="selected-rating" value="1">
                            <div class="star-rating-clickable">
                                <i class="fas fa-star star-rated" data-rating="1"></i>
                                <i class="far fa-star" data-rating="2"></i>
                                <i class="far fa-star" data-rating="3"></i>
                                <i class="far fa-star" data-rating="4"></i>
                                <i class="far fa-star" data-rating="5"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveEntryBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission
    document.getElementById('saveEntryBtn').addEventListener('click', function() {
        const form = document.getElementById('addEntryForm');
        
        // Basic validation
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }
        
        // Submit the form
        form.submit();
    });
    
    // Handle star rating
    const stars = document.querySelectorAll('.star-rating-clickable i');
    const ratingInput = document.getElementById('selected-rating');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            
            // Update visual state of stars
            stars.forEach(s => {
                const starRating = s.getAttribute('data-rating');
                if (starRating <= rating) {
                    s.className = 'fas fa-star star-rated';
                } else {
                    s.className = 'far fa-star';
                }
            });
        });
        
        // Add hover effects
        star.addEventListener('mouseenter', function() {
            const hoverRating = this.getAttribute('data-rating');
            
            stars.forEach(s => {
                const starRating = s.getAttribute('data-rating');
                if (starRating <= hoverRating) {
                    s.className = 'fas fa-star star-hover';
                } else {
                    s.className = 'far fa-star';
                }
            });
        });
    });
    
    // Reset to selected rating when moving mouse away
    const starContainer = document.querySelector('.star-rating-clickable');
    starContainer.addEventListener('mouseleave', function() {
        const rating = ratingInput.value;
        
        stars.forEach(s => {
            const starRating = s.getAttribute('data-rating');
            if (starRating <= rating) {
                s.className = 'fas fa-star star-rated';
            } else {
                s.className = 'far fa-star';
            }
        });
    });
});
</script>
<?= $this->endSection() ?>