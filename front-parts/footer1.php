<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Add font awesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: 'Segoe UI';
            background-color: #f5f5f5;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Main content should grow to fill available space */
        .content {
            flex: 1;
        }

        /* Footer Section Styles */
        footer {
            background-color: #222;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            display: inline-block;
            margin: 0 10px;
            color: #fff;
            font-size: 12px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #ff8c00;
        }
    </style>
</head>

<body>
    <!-- Add a main content wrapper -->
    <div class="content">
        <!-- Your content goes here -->
    </div>

    <footer>
        <div class="social-icons">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>
</body>

</html>
