<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustLearn | Articles</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />
</head>
<body>
    <?php include "components/header.php" ?>

    <main id="articles" class="container">
        <section class="articles">
            <section class="articles-header">
                <h1>Articles</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat ipsa id alias aliquid dolores esse nesciunt earum fugit natus porro iure aliquam enim quis quisquam, minima in dignissimos rem illo?</p>
            </section>

            <section class="search-input">
                <input type="text" placeholder="Place keyword to search some articles">
            </section>

            <section class="categories">
                <p class="category active">All Category</p>
                <p class="category">Technology</p>
                <p class="category">Business</p>
                <p class="category">Artificial Intelligence</p>
                <p class="category">Web Development</p>
                <p class="category">Robotic</p>
                <p class="category">Augmented Reality</p>
                <p class="category">Blockchain</p>
                <p class="category">Decentralization Finance</p>
                <p class="category">Game Development</p>
            </section>

            <section class="article-cards">           
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
                    <a href="about.php">About Us</a>
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
                    <a href="about.php">About Us</a>
                    <a href="programs.php">Programs</a>
                    <a href="#articles">Articles</a>
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
        .articles {
            padding-top: 150px;
            padding-bottom: 100px;
            min-height: 900px;
            display: flex;
            flex-direction: column;
            row-gap: 30px;
            column-gap: 30px;
        }
        .articles .articles-header {
            display: flex;
            flex-direction: column;
            row-gap: 15px;
        }
        .articles .articles-header h1 {
            font-size: 40px;
            color: var(--secondary);
        }
        .articles .articles-header p {
            color: gray;
            width: 600px;
        }


        .articles .search-input input {
            width: 100%;
            border: 1px solid #ccc;
            outline: none;
            padding: 14px 20px;
            border-radius: 6px;
            color: gray;
            font-size: 16px;
        }

        .articles .categories {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        .articles .categories .category {
            background-color: #F5F5F5;
            color: gray;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 20px;
            margin-bottom: 15px;
        }

        .article-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            row-gap: 50px;
            column-gap: 30px;
        }
        .article-card {
            width: 370px;
            min-height: 400px;
            border-radius: 6px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
        .article-card .img-container {
            width: 100%;
            height: 200px;
        } 
        .article-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }
        .articles .text-container {
            padding: 12px;
            display: flex;
            flex-direction: column;
            row-gap: 5px;
        }
        .articles .text-container h3 {
            font-size: 22px;
            color: var(--secondary);
            text-overflow: ellipsis;
            display: -webkit-box;           
            -webkit-box-orient: vertical;   
            overflow: hidden;               
            text-overflow: ellipsis;        
            line-clamp: 3;
            -webkit-line-clamp: 3;   
        }
        .articles .text-container p {
            color: gray;
            text-overflow: ellipsis;
            display: -webkit-box;           
            -webkit-box-orient: vertical;   
            overflow: hidden;               
            text-overflow: ellipsis;        
            line-clamp: 3;
            -webkit-line-clamp: 3;   
        }


        .articles .category.active {
            border: 1px solid gray;
        }
    </style>


    <script src="scripts/script-main.js"></script>
</body>
</html>