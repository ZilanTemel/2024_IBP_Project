<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/user.css">
    <style>
        .navbar {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
        }

        .search-box {
            flex-grow: 1;
            text-align: left;
        }

        .search-box input[type="text"] {
            width: 100%;
            max-width: 300px;
        }

        .gallery {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            padding: 10px;
            scroll-snap-type: x mandatory;
        }

        .item {
            flex: 0 0 auto;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            scroll-snap-align: start;
        }

        .item img {
            width: 100%;
            height: auto;
            display: block;
        }

        .item p {
            margin: 10px;
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
                width: auto;
                scroll-snap-align: start;
            }
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="search-box">
        <form method="post" action="<?php echo base_url('Auth/search'); ?>" class="form-inline">
            <input type="text" name="search" class="form-control" placeholder="Search...">
            <button type="submit" class="btn btn-light">ARAMA</button>
        </form>
    </div>
    <div class="nav-links">
        <a href="<?php echo base_url('Auth/logout'); ?>" class="logout-button">ÇIKIŞ</a>
    </div>
</div>
<div class="container mt-4">
    <h2 class="mb-4">ADMİNE MESAJ GÖNDER</h2>
    <form method="post" action="<?php echo base_url('Auth/sendMessage'); ?>">
        <div class="form-group">
            <label for="message">MESAJ</label>
            <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
        </div>
        <input type="hidden" name="receiver_id" value="1"> <!-- Admin ID -->
        <button type="submit" class="btn btn-primary">GÖNDER</button>
    </form>
</div>
<div class="container mt-4">
    <h3>YAYINLANAN DUYURULAR</h3>
    <div class="slider-container">
        <button class="prev" onclick="scrollGallery(-1)"><i class="fas fa-chevron-left"></i></button>
        <div class="gallery">
            <?php if(!empty($files)) { 
                foreach($files as $file) { ?>
                    <div class="item">
                        <img src="<?php echo base_url('uploads/files/'.$file['file_name']); ?>" alt="<?php echo $file['title']; ?>" class="img-fluid">
                        <p><?php echo !empty($file['title']) ? $file['title'] : 'No Title'; ?></p>
                        <p> ŞU TARİHTE YÜKLENDİ <?php echo date("j M Y", strtotime($file['uploaded_on'])); ?></p>
                    </div>
            <?php } 
            } else { ?>
                <p>File(s) not found...</p>
            <?php } ?>
        </div>
        <button class="next" onclick="scrollGallery(1)"><i class="fas fa-chevron-right"></i></button>
    </div>
</div>

<script src="https
