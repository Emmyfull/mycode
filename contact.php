<?php session_start(); ?>
<?php include 'header.php'; ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Contact Us</h2>
            <p class="lead">Have questions? We'd love to hear from you.</p>
            
            <div class="mt-4">
                <div class="d-flex mb-3">
                    <div class="me-3">
                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5>Address</h5>
                        <p>123 Tech Street, Silicon Valley, CA 94025</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="me-3">
                        <i class="fas fa-phone fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5>Phone</h5>
                        <p>+1 (555) 123-4567</p>
                    </div>
                </div>
                
                <div class="d-flex mb-3">
                    <div class="me-3">
                        <i class="fas fa-envelope fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5>Email</h5>
                        <p>info@techlearning.com</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Send us a message</h4>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>