<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - MegMetal</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container mt-5">
        <h1 class="my-4">Contact Us</h1>
        
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-6 mb-4">
                <h4>Our Address</h4>
                <p>Str Taberei, Popești-Leordeni 077160, ILFOV, Romania</p>
                
                <h4>Contact Numbers</h4>
                <p>(+40) 0727041329</p>
                <p>(+40) 0792330633</p>
                <p>(+40) 0722420450</p>
                
                <h4>Email</h4>
                <p><a href="mailto:info@mega-metal-international.com">info@mega-metal-international.com</a></p>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6 mb-4">
                <h4>Send Us a Message</h4>
                <form action="send_contact.php" method="post">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
