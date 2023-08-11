<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F0F0F0;
        }



        .main-content {
            margin: 20px;
        }

        .main-content h1 {
            color: #007BFF;
        }

        .main-content p {
            color: #333;
        }

        .cta-button {
            display: inline-block;
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            margin-top: 20px;
            border-radius: 5px;
        }

        .cta-button:hover {
            background-color: #0056b3;
        }

        .features {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .feature-item {
            text-align: center;
            width: 30%;
        }

        .feature-item img {
            width: 50%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div style="text-align:center;">
            <h1 id="welcome-msg"></h1>
            <p>Your one-stop solution for all academic resources. Here, you can search, browse, and download numerous academic resources to aid your research and learning process.</p>
        </div>
        <div style="display: flex; justify-content: center; margin:4rem 0;">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/a7_WFUlFS94" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
        <div class="features">
            <div class="feature-item">
                <img src="../assets/img/acad1.png" alt="academic images">
                <h2>Academics enhancement</h2>
                <p>Provide a comprehensive selection of academic resources, including papers, articles, books, and more.</p>
            </div>
            <div class="feature-item">
                <img src="../assets/img/acad2.png" alt="academic images">
                <h2>Academics Planning</h2>
                <p>Enhanced search capabilities help you quickly find the resources you need.</p>
            </div>
            <div class="feature-item">
                <img src="../assets/img/acad3.jpg" alt="academic images">
                <h2>Academics Insights</h2>
                <p>Easy-to-use interface enables efficient browsing and downloading.</p>
            </div>
        </div>
    </div>
  

    <script>
        const welcomeMessage = 'Welcome to Our Academics Database';
        let i = 0;
        
        function typeWriter() {
            if (i < welcomeMessage.length) {
                document.getElementById('welcome-msg').innerHTML += welcomeMessage.charAt(i);
                i++;
                setTimeout(typeWriter, 300); // change the delay here
            }
        }

        typeWriter();
    </script>
</body>
</html>
