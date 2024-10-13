<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustLearn | Homepage</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
</head>
<body>
    <?php include "components/header.php" ?>

    <main class="container">
        <section id="about" class="about">
            <section class="about-header">
                <h1>About Us</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat ipsa id alias aliquid dolores esse nesciunt earum fugit natus porro iure aliquam enim quis quisquam, minima in dignissimos rem illo?</p>
            </section>
        </section>
    </main>

    <footer class="footer">
        <section class="container sub-footer">
            <section>
                <h1>JustLearn</h1>
                <section class="footer-subscribe">
                    <p>Subscribe your email to get latest information from JustLearn</p>
                    <input type="text" placeholder="Place your email">
                    <button class="btn btn-secondary">Send Mail</button>
    
                    <section class="footer-icons flexx">
                        <i class="devicon-facebook-plain footer-icon"></i>
                        <i class="devicon-twitter-original footer-icon"></i>
                        <i class="devicon-linkedin-plain footer-icon"></i>
                    </section>
                </section>
            </section>
    
            <section class="footer-services">
                <p class="footer-services-title">Company</p>
                <section class="footer-options">
                    <a href="#about">About Us</a>
                    <a href="#">Partnership</a>
                    <a href="#">Careers</a>
                    <a href="#">Mentors</a>
                    <a href="#">Blogs</a>
                </section>
            </section>

            <section class="footer-services">
                <p class="footer-services-title">Explore</p>
                <section class="footer-options">
                    <a href="index.php">Home</a>
                    <a href="#about">About Us</a>
                    <a href="programs.php">Programs</a>
                    <a href="articles.php">Articles</a>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                </section>
            </section>

            <section class="footer-services">
                <p class="footer-services-title">Support</p>
                <section class="footer-options">
                    <a href="contactus.php">Contact Us</a>
                    <a href="index.php/#faq">FAQ</a>
                    <a href="programs.php/#schedules">Schedules</a>
                    <a href="programs.php/#programs">Pricing</a>
                </section>
            </section>
            <section class="footer-services">
                <p class="footer-services-title">Programs</p>
                <section class="footer-options">
                    <a href="#">Javascript</a>
                    <a href="#">PHP</a>
                    <a href="#">ReactJS</a>
                    <a href="#">NextJS</a>
                    <a href="#">Javascript</a>
                </section>
            </section>
        </section>

        <section class="container flex-between footer-copyright">
            <p>Copyright &copy; 2024 All Right Reserved. Made with ❤️ by Hennndev</p>

        </section>
    </footer> 



    <style>
        .about {
            padding-top: 150px;
            min-height: 900px;
            display: flex;
            flex-direction: column;
            row-gap: 50px;
            column-gap: 30px;
        }

        .about .about-header {
            display: flex;
            flex-direction: column;
            row-gap: 15px;
        }
        .about .about-header h1 {
            font-size: 40px;
            color: var(--secondary) !important;
        }
        .about .about-header p {
            color: gray;
            width: 600px;
        }
        @media (max-width: 768px) {
            .about .about-header p {
                width: auto;
            }
        }
    </style>

    <script src="scripts/script-main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

