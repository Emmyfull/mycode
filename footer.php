</main>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>Empowering learners worldwide with cutting-edge tech education.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-decoration-none">Home</a></li>
                        <li><a href="contact.php" class="text-decoration-none">Contact</a></li>
                        <?php if (!isset($_SESSION['username'])): ?>
                            <li><a href="signup.php" class="text-decoration-none">Sign Up</a></li>
                            <li><a href="login.php" class="text-decoration-none">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p><i class="fas fa-envelope"></i> info@techlearning.com</p>
                    <p><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2024 TechLearning Hub. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>