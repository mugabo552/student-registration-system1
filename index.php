<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="logo">
            <div class="logo-icon">SMS</div>
            <span>School Management</span>
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>

    <div class="hero">
        <h1>Mugabo Joseph</h1>
        <p>Full Stack Developer</p>
        
        <div class="skills">
            <div class="skill-tag">HTML</div>
            <div class="skill-tag">CSS</div>
            <div class="skill-tag">JavaScript</div>
            <div class="skill-tag">Vue.js</div>
            <div class="skill-tag">Node.js</div>
            <div class="skill-tag">PHP</div>
        </div>

        <div style="margin-top: 4rem;">
            <h2 style="margin-bottom: 2.5rem; font-size: 2rem; font-weight: 700; color: #000;">Projects</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto;">
                <div style="background: #fff; padding: 2.5rem; border: 1px solid #e0e0e0; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.borderColor='#000'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='#e0e0e0'; this.style.transform='translateY(0)'">
                    <h3 style="margin-bottom: 1rem; color: #000; font-weight: 600; font-size: 1.2rem;">School Management System</h3>
                    <p style="color: #666; line-height: 1.6;">Complete system for managing students and users with modern UI/UX.</p>
                </div>
                <div style="background: #fff; padding: 2.5rem; border: 1px solid #e0e0e0; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.borderColor='#000'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='#e0e0e0'; this.style.transform='translateY(0)'">
                    <h3 style="margin-bottom: 1rem; color: #000; font-weight: 600; font-size: 1.2rem;">E-Commerce Platform</h3>
                    <p style="color: #666; line-height: 1.6;">Full-stack solution built with Vue.js and Node.js.</p>
                </div>
                <div style="background: #fff; padding: 2.5rem; border: 1px solid #e0e0e0; transition: all 0.2s; cursor: pointer;" onmouseover="this.style.borderColor='#000'; this.style.transform='translateY(-4px)'" onmouseout="this.style.borderColor='#e0e0e0'; this.style.transform='translateY(0)'">
                    <h3 style="margin-bottom: 1rem; color: #000; font-weight: 600; font-size: 1.2rem;">Portfolio Website</h3>
                    <p style="color: #666; line-height: 1.6;">Responsive portfolio with modern animations and interactions.</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Skills</h4>
                <ul>
                    <li>HTML & CSS</li>
                    <li>JavaScript & Vue.js</li>
                    <li>PHP & Node.js</li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Contact</h4>
                <ul>
                    <li>Kigali, Rwanda</li>
                    <li>KK720 St</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Mugabo Joseph. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>