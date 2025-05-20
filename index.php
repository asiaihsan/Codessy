<?php
require_once 'config.php';
require_once 'nav.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codessy - Your Coding Companion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1 class="mb-3">Your Path to Web Development Mastery</h1>
                <h2>Unlock the skills to build the future, one line of code at a time.</h2>
                <a href="#get-started" class=" hero-btn mt-5">Begin Your Adventure</a>
            </div>
            <div class="hero-illustration">
                <div class="container">
                    <div class="cube">
                        <div style="--x:-1; --y:0;">
                            <span style="--i:3;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:1;"></span>
                        </div>
                        <div style="--x:0; --y:0;">
                            <span style="--i:3;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:1;"></span>
                        </div>
                        <div style="--x:1; --y:0;">
                            <span style="--i:3;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:1;"></span>
                        </div>
                    </div>
                    <div class="cube">
                        <div style="--x:-1; --y:0;">
                            <span style="--i:3;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:1;"></span>
                        </div>
                        <div style="--x:0; --y:0;">
                            <span style="--i:3;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:1;"></span>
                        </div>
                        <div style="--x:1; --y:0;">
                            <span style="--i:3;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:1;"></span>
                        </div>
                    </div>
                    <div class="cube">
                        <div style="--x:-1; --y:0;">
                            <span style="--i:3;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:1;"></span>
                        </div>
                        <div style="--x:0; --y:0;">
                            <span style="--i:3;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:1;"></span>
                        </div>
                        <div style="--x:1; --y:0;">
                            <span style="--i:3;"></span>
                            <span style="--i:2;"></span>
                            <span style="--i:1;"></span>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        
        <section class="why-webdev">
            <h2>Why Web Development?</h2>
            <div id="carouselExampleDark" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="2000">
                  <div class="reasons-grid">
                <div class="reason-card">
                    <h3>It's creative</h3>
                    <p>Build interactive sites the way you want and bring your ideas to life. Coding isn't just logical—it's also artistic.</p>
                    <img src="assest/creative.png" alt="Creative" class="card-img" />
                </div>
                <div class="reason-card">
                    <h3>It's useful</h3>
                    <p>Learn how websites work, create your own, and understand the surface behind every page.</p>
                    <img src="assest/useful.png" alt="Useful" class="card-img" />
                </div>
                <div class="reason-card">
                    <h3>It's in demand</h3>
                    <p>Web development is a sought-after skill today. Companies around the world need developers for websites, apps, and more.</p>
                    <img src="assest/demand.png" alt="In demand" class="card-img" />
                </div>
            </div>
    
    </div>
    <div class="carousel-item">
        <div class="reasons-grid">
                <div class="reason-card">
                    <h3>It's accessible</h3>
                    <p>Learn to code from anywhere. Free resources and supportive communities make web development open to everyone, regardless of background.</p>
                    <img src="assest/accessible.png" alt="Accessible" class="card-img" />
                </div>
                <div class="reason-card">
                    <h3>It's empowering</h3>
                    <p>Master HTML, CSS, and JavaScript to bring your vision to life. Gain the confidence to solve problems and create original solutions that make an impact.</p>
                    <img src="assest/empower.png" alt="Empowering" class="card-img" />
                </div>
                <div class="reason-card">
                    <h3>It's a career</h3>
                    <p>Whether freelancing, joining a startup, or working in a tech giant, web development can open doors to great careers.</p>
                    <img src="assest/career.png" alt="Career" class="card-img" />
                </div>
            </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        </section>
        <section class="courses" id="courses">
            <h2>Explore Our Courses</h2>
            <div class="courses-grid">
                <div class="course-card">
                    <img src="assest/htmlbg.jpg" alt="HTML Course" />
                    <h3>HTML Essentials</h3>
                    <p>Start your coding journey here. Learn to structure web content with the internet's fundamental language. Build your first pages and establish core web concepts.</p>
                    <a href="#" class="btn-secondary-index">Start Learning</a>
                   
                </div>
                <div class="course-card">
                    <img src="assest/csssbg.jpg" alt="CSS Course" />
                    <h3>CSS Styling Secrets</h3>
                    <p>Style what you build. Transform basic pages into beautiful, modern websites with advanced styling techniques and responsive layouts.</p>
                    <a href="#" class="btn-secondary-index">Start Learning</a>
                   
                </div>
                <div class="course-card">
                    <img src="assest/jsbg.jpg" alt="JS Course" />
                    <h3>JavaScript Dynamics</h3>
                    <p>Add interaction and functionality. Elevate your sites from static to dynamic with programming basics that respond to user actions.</p>
                    <a href="#" class="btn-secondary-index">Start Learning</a>
                   
                </div>
            </div>
        </section>
        <section class="auth-section">
            <div class="auth-illustration">
                <img src="assest/Frame 2.png" alt="Sign in or Sign up" class="img-fluid rounded-3">
            </div>
            <div class="auth-content">
                <h2 class="mb-4">Join Our Community</h2>
                <p class="mb-4">Connect with fellow learners and experienced developers in our vibrant community. Share your progress, ask questions, and collaborate on projects.</p>
                <a href="sign_up.php" class="btn-secondary-index me-3">Sign Up</a>
                <p class="mb-0">Already have an account? <a href="login.php" class="text-decoration-none">Log in</a></p>
            </div>
        </section>

        <footer class="container-fluid bg-white rounded-4 py-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="mb-4">Codessy</h4>
                        <p>Learn web development with interactive courses and a supportive community of fellow learners.</p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="mb-4">Quick Links</h4>
                        <nav>
                            <a href="index.php" class="d-block mb-2 text-decoration-none">Home</a>
                            <a href="lectures.php" class="d-block mb-2 text-decoration-none">Lectures</a>
                            <a href="quiz.php" class="d-block mb-2 text-decoration-none">Quizzes</a>
                            <?php if (isset($_SESSION['userID'])): ?>
                                <a href="profile.php" class="d-block mb-2 text-decoration-none">Profile</a>
                            <?php endif; ?>
                        </nav>
                    </div>
                    <div class="col-md-4">
                        <h4 class="mb-4">Contact Us</h4>
                        <p>Email: support@codessy.com</p>
                        <p>Phone: +1 (555) 123-4567</p>
                    </div>
                </div>
                <hr class="mt-4 mb-4">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="mb-0">&copy; <?php echo date('Y'); ?> Codessy. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

    </main>
    <script src="js/main.js"></script>
</body>
</html>