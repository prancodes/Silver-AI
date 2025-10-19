<?php
// api/index.php - Main routing file for Silver AI
session_start();

// Get the request URI and clean it
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$uri = parse_url($request_uri, PHP_URL_PATH);

// Remove query parameters for routing
$uri = strtok($uri, '?');

// Check if user is logged in
$isLoggedIn = isset($_SESSION['email']) && !empty($_SESSION['email']);
$username = $_SESSION['username'] ?? '';

// Route handling
switch (true) {
    // Home page
    case ($uri === '/' || $uri === '/index.php'):
        renderHomePage($isLoggedIn, $username);
        break;

    // Authentication routes
    case ($uri === '/auth/login.php'):
        require_once __DIR__ . '/auth/login.php';
        break;

    case ($uri === '/auth/signup.php'):
        require_once __DIR__ . '/auth/signup.php';
        break;

    case ($uri === '/auth/logout.php'):
        require_once __DIR__ . '/auth/logout.php';
        break;

    // Views routes (protected)
    case ($uri === '/views/silver.php'):
        require_once __DIR__ . '/views/silver.php';
        break;

    case ($uri === '/views/vision.php'):
        require_once __DIR__ . '/views/vision.php';
        break;

    // Services routes (for AJAX calls)
    case ($uri === '/services/register.php'):
        require_once __DIR__ . '/services/register.php';
        break;

    // Default 404
    default:
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        break;
}

function renderHomePage($isLoggedIn, $username)
{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Silver AI</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="icon" type="image/png" href="/favicon/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="/favicon/favicon.svg" />
        <link rel="shortcut icon" href="/favicon/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="Silver AI" />
        <link rel="manifest" href="/favicon/site.webmanifest" />

        <style>
            /* Mobile menu styles */
            @media (max-width: 768px) {

                .nav-el,
                .nav-login-section {
                    position: fixed;
                    top: 70px;
                    right: -100%;
                    width: 250px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    padding: 20px;
                    border-radius: 10px 0 0 10px;
                    transition: right 0.3s ease;
                    z-index: 999;
                    box-shadow: -5px 5px 20px rgba(0, 0, 0, 0.3);
                }

                .nav-el.active,
                .nav-login-section.active {
                    right: 0;
                }

                .nav-el {
                    flex-direction: column;
                    gap: 15px;
                    top: 70px;
                }

                .nav-el a {
                    padding: 12px 15px;
                    border-radius: 8px;
                    transition: background 0.3s ease;
                    display: block;
                }

                .nav-el a:hover {
                    background: rgba(255, 255, 255, 0.1);
                }

                .nav-login-section {
                    flex-direction: column;
                    gap: 10px;
                    top: 280px;
                    align-items: stretch;
                }

                .nav-login-section span {
                    display: block;
                    text-align: center;
                    margin-bottom: 10px !important;
                }

                .nav-login-section a {
                    width: 100%;
                    text-align: center;
                }

                .sidebar {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    padding: 10px;
                    transition: transform 0.3s ease;
                }

                .sidebar:hover {
                    transform: scale(1.1);
                }

                .sidebar i {
                    font-size: 24px;
                    transition: transform 0.3s ease;
                }

                .sidebar i.fa-times {
                    transform: rotate(90deg);
                }
            }

            @media (min-width: 769px) {
                .sidebar {
                    display: none !important;
                }
            }
        </style>
    </head>

    <body>

        <div class="navbar">
            <a href="/" class="nav-logo-a">
                <h2 class="nav-logo"><i class="fa-duotone fa-solid fa-circle-nodes"
                        style="--fa-primary-color: #ffffff; --fa-secondary-color: #ffffff;"></i>Silver AI</h2>
            </a>

            <div class="nav-el">
                <a href="/">Home</a>
                <a href="#usecases">Use Cases</a>
                <a href="#features">Features</a>
                <a href="#pricing">Pricing</a>
            </div>
            <div class="nav-login-section">
                <?php if ($isLoggedIn): ?>
                    <span style="color: white; margin-right: 15px;">Welcome, <?php echo htmlspecialchars($username); ?></span>
                    <a href="/auth/logout.php" class="login nav-logo-a btn-primary">Logout</a>
                <?php else: ?>
                    <a href="/auth/login.php" class="login nav-logo-a btn-primary" id="login">Login</a>
                <?php endif; ?>
            </div>
            <div class="sidebar">
                <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
            </div>
        </div>

        <div class="welcome-tab animation">
            <div class="wc-text-section">
                <h5>WELCOME TO SILVER AI</h5>
                <h1 class="title">Create amazing <span class="text-gradient-primary">web content</span> posts10X faster with
                    AI.</h1>
                <p>Elegantly structured content with references in just a few clicks.</p>
                <div class="wc-btns">
                    <div class="btn-primary wc-signup">Sign up with email</div>
                    <a href="/auth/signup.php">
                        <div class="btn-primary wc-getStart">Get Started &ensp;&RightArrow;</div>
                    </a>
                </div>
                <p class="wc-creditMsg"><strong>*100% free</strong> to get started. No credit card required.</p>
            </div>
            <div class="wc-img">
                <img class="bg-gradient-primary" src="https://copygen.themenio.com/images/gfx/banner/g.jpg" alt="img">
            </div>
        </div>

        <div class="companies-tab animation" id="usecases">
            <div class="cp-imgs">
                <img src="https://copygen.themenio.com/images/brands/72-a-tone-white.png" alt="img1">
                <img src="https://copygen.themenio.com/images/brands/72-b-tone-white.png" alt="img2">
                <img src="https://copygen.themenio.com/images/brands/72-c-tone-white.png" alt="img3">
                <img src="https://copygen.themenio.com/images/brands/72-d-tone-white.png" alt="img4">
                <img src="https://copygen.themenio.com/images/brands/72-e-tone-white.png" alt="img5">
            </div>
            <p class="cp-joinMsg">Join hundreds of teams that rely on our AI Article Writer to create better content faster
            </p>
            <div class="btn-primary wc-signup cp-btn">Start Free Trail</div>
        </div>

        <div class="profit-tab animation">
            <div class="pf-text">
                <h2 class="pf-title">Increase profits and efficiency with our AI text generator</h2>
                <p>An AI text generator can help businesses increase profits by improving their content marketing strategy.
                    By leveraging the power of artificial intelligence a faster rate than ever before.</p>
            </div>
        </div>

        <div class="content-gen-tab animation" id="features">
            <img src="https://copygen.themenio.com/assets/images/shape/border-d.png" alt="bg-img">
            <div class="cont-text">
                <h2 class="cont-title">Content generation made easy</h2>
                <p>Give our AI a few descriptions and we'll automatically create blog articles, product descriptions and
                    more for you within just few second.</p>
            </div>
        </div>

        <div class="points-cards-tab">
            <div class="p-card animation-row">
                <div class="p-card-text">
                    <h4>Trustworthy Research</h4>
                    <p>Simply choose a template from available list to write content for blog posts, landing page, website
                        content etc. </p>
                </div>
                <img src="https://copygen.themenio.com/images/number/1-light.png" alt="one">
            </div>
            <div class="p-card animation-row">
                <div class="p-card-text">
                    <h4>Time Efficiency</h4>
                    <p>Provide our AI content writer with few sentences on what you want to write, and it will start writing
                        for you. </p>
                </div>
                <img src="https://copygen.themenio.com/images/number/2-light.png" alt="two">
            </div>
            <div class="p-card animation-row">
                <div class="p-card-text">
                    <h4>SEO Efficiency</h4>
                    <p>Our powerful AI tools will generate content in few second, then you can export it to wherever you
                        need. </p>
                </div>
                <img src="https://copygen.themenio.com/images/number/3-light.png" alt="three">
            </div>
        </div>

        <div class="wormhole-img animation">
            <img src="https://copygen.themenio.com/assets/images/wormhole-a.png" alt="wormhole-a">
        </div>

        <div class="pricing animation" id="pricing">
            <div class="pf-div">
                <h2 class="pf-title">Plans that best suit your business requirements</h2>
                <p>This is a straightforward and commonly used header that lets customers know they are looking at different
                    pricing options.</p>
            </div>
        </div>

        <div class="pricing-tab">
            <div class="pf-row">
                <div class="pf-tab animation-row">
                    <div class="pf-tab-label">
                        <div class="pf-tab-label-ctg">Basic</div>
                        <h5>Limited Words</h5>
                        <h3>Free</h3>
                        <a href="#pricing">
                            <div class="pf-tab-label-btn">Start free trial today &ensp;&RightArrow;</div>
                        </a>
                    </div>
                    <div class="pf-tab-lists">
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>&ensp; <strong>5,000</strong> Monthly Word Limit</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; <strong>5+</strong> Templates</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; 50+ Languages</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Advance Editor Tool</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Regular Technical Support</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Unlimited Logins</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Newest Features</li>
                        </ul>
                    </div>
                </div>
                <div class="pf-tab animation-row">
                    <div class="pf-tab-label">
                        <div class="pf-tab-label-ctg">Silver</div>
                        <h5>Unlimited Words</h5>
                        <h3>$139 <span class="caption-text text-muted"> / month</span></h3>
                        <a href="#pricing">
                            <div class="pf-tab-label-btn-blue">Start free trial today &ensp;&RightArrow;</div>
                        </a>
                    </div>
                    <div class="pf-tab-lists">
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>&ensp; <strong>20,000</strong> Monthly Word Limit</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; <strong>10+</strong> Templates</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; 50+ Languages</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Advance Editor Tool</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Regular Technical Support</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Unlimited Logins</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Newest Features</li>
                        </ul>
                    </div>
                </div>
                <div class="pf-tab animation-row">
                    <div class="pf-tab-label">
                        <div class="pf-tab-label-ctg">Diamond</div>
                        <h5>Customized Plans</h5>
                        <h3>$269 <span class="caption-text text-muted"> / month</span></h3>
                        <a href="#pricing">
                            <div class="pf-tab-label-btn">Start free trial today &ensp;&RightArrow;</div>
                        </a>
                    </div>
                    <div class="pf-tab-lists">
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>&ensp; <strong>50,000</strong> Monthly Word Limit</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; <strong>15+</strong> Templates</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; 50+ Languages</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Advance Editor Tool</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Regular Technical Support</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Unlimited Logins</li>
                            <li><i class="fa-solid fa-check"></i>&ensp; Newest Features</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="ft-div">
                <p>&copy; 2025 SilverAI. Designed by <a href="https://github.com/prancodes/Silver-AI" target="_blank"
                        class="ft-name">Silver AI Teams</a></p>
                <div class="ft-icons">
                    <a href="/"><i class="fa-brands fa-square-facebook"></i></a>
                    <a href="/"><i class="fa-brands fa-square-x-twitter"></i></a>
                    <a href="/"><i class="fa-brands fa-square-github"></i></a>
                </div>
            </div>
        </div>

        <script>
            // Mobile hamburger menu functionality
            document.addEventListener('DOMContentLoaded', function () {
                const hamburger = document.querySelector('.sidebar');
                const navEl = document.querySelector('.nav-el');
                const navLoginSection = document.querySelector('.nav-login-section');

                if (hamburger) {
                    hamburger.addEventListener('click', function () {
                        navEl.classList.toggle('active');
                        navLoginSection.classList.toggle('active');

                        const icon = hamburger.querySelector('i');
                        if (icon.classList.contains('fa-bars')) {
                            icon.classList.remove('fa-bars');
                            icon.classList.add('fa-times');
                        } else {
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    });

                    document.addEventListener('click', function (event) {
                        const isClickInside = hamburger.contains(event.target) ||
                            navEl.contains(event.target) ||
                            navLoginSection.contains(event.target);

                        if (!isClickInside && navEl.classList.contains('active')) {
                            navEl.classList.remove('active');
                            navLoginSection.classList.remove('active');
                            const icon = hamburger.querySelector('i');
                            icon.classList.remove('fa-times');
                            icon.classList.add('fa-bars');
                        }
                    });
                }
            });
        </script>
    </body>

    </html>
    <?php
}
?>