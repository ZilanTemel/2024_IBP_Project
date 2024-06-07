<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
        }

        .search-box {
            flex: 0 1 300px;
            text-align: left;
        }

        .search-box input[type="text"] {
            width: 200px;
        }

        .nav-links {
            text-align: right;
        }

        .gallery {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
        }

        .item {
            flex: 0 0 auto;
            margin-right: 10px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
        }

        .item img {
            width: 100%;
            height: auto;
            display: block;
        }

        .item p {
            margin: 10px;
        }

        .gallery::-webkit-scrollbar {
            display: none;
        }

        .slider-container {
            position: relative;
            margin-top: 20px;
        }

        .slider-container .prev,
        .slider-container .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            z-index: 1;
        }

        .slider-container .prev {
            left: 0;
        }

        .slider-container .next {
            right: 0;
        }

        @media (max-width: 768px) {
            .gallery {
                flex-wrap: nowrap;
                overflow-x: auto;
            }

            .item {
                flex: 0 0 auto;
                margin-right: 10px;
                width: auto;
                box-sizing: border-box;
                scroll-snap-align: start;
            }
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="search-box">
        <form method="post" action="<?php echo base_url('Auth/search'); ?>">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="nav-links">
        <a href="<?php echo base_url('Auth/logout'); ?>" class="logout-button">Logout</a>
    </div>
</div>
<div class="container">
    <h2>Send Message to Admin</h2>
    <form method="post" action="<?php echo base_url('Auth/sendMessage'); ?>">
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="5" required></textarea>
        </div>
        <input type="hidden" name="receiver_id" value="1"> <!-- Admin ID -->
        <button type="submit">Send</button>
    </form>
</div>
<div class="container">
    <h3>Published Announcements</h3>
    <div class="slider-container">
        <button class="prev" onclick="scrollGallery(-1)"><i class="fas fa-chevron-left"></i></button>
        <div class="gallery">
            <?php if(!empty($files)) { 
                foreach($files as $file) { ?>
                    <div class="item">
                        <img src="<?php echo base_url('uploads/files/'.$file['file_name']); ?>" alt="<?php echo $file['title']; ?>">
                        <p><?php echo !empty($file['title']) ? $file['title'] : 'No Title'; ?></p>
                        <p>Uploaded On <?php echo date("j M Y", strtotime($file['uploaded_on'])); ?></p>
                    </div>
            <?php } 
            } else { ?>
                <p>File(s) not found...</p>
            <?php } ?>
        </div>
        <button class="next" onclick="scrollGallery(1)"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function scrollGallery(direction) {
        const gallery = document.querySelector('.gallery');
        const itemWidth = document.querySelector('.item').offsetWidth;
        gallery.scrollBy({
            top: 0,
            left: direction * itemWidth,
            behavior: 'smooth'
        });
    }
</script>
</body>
</html>
