<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/admin.css">
</head>
<body>
<div class="navbar">
    <div class="nav-links">
        <a href="<?php echo base_url('Auth/logout'); ?>" class="logout-button">ÇIKIŞ</a>
        <a href="<?php echo base_url('Auth/userManagement'); ?>" class="user-management-button">KULLANICI YÖNETİM PANELİ</a>
    </div>
    <div class="search-box">
        <form method="post" action="<?php echo base_url('Auth/searchAdmin'); ?>">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">ARAMA</button>
        </form>
    </div>
</div>
<div class="container">
    <div class="upload-div">
        <h3>ADMİN DUYURU YÜKLEME ALANI</h3>
        <!-- display status text -->
        <?php echo !empty($statusMsg) ? '<p class="status-msg">' . $statusMsg . '</p>' : ''; ?>
        <!-- file upload form  -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Choose Files"></label>
                <input type="file" class="form-control" name="files[]" id="files" multiple>
            </div>
            <div class="form-group">
                <label for="File Titles">Duyuru başlığı</label>
                <input type="text" class="form-control" name="titles" id="titles" placeholder="Title1, Title2, ...">
            </div>
            <div class="form-group">
                <input class="form-control" type="submit" name="fileSubmit" value="UPLOAD">
            </div>
        </form>
        <div class="row">
            <h3>DUYURU YÜKLE</h3>
            <ul class="gallery">
                <?php if(!empty($files)) {
                    foreach($files as $file) { ?>
                        <li class="item">
                            <img src="<?php echo base_url('uploads/files/'.$file['file_name']); ?>" alt="">
                            <p><?php echo !empty($file['title']) ? $file['title'] : 'No Title'; ?></p>
                            <p>Şu tarihte yüklendi <?php echo date("j M Y", strtotime($file['uploaded_on'])); ?></p>
                            <!-- Her bir duyurunun silme bağlantısını sadece o duyuruyu silmek için özelleştiriyoruz -->
                            <a class="delete-button" href="<?php echo base_url('auth/deleteFile/'.$file['id']); ?>" onclick="return confirm('Bu dosyayı silmek istediğinizden emin misiniz?');">SİL</a>
                        </li>
                <?php } } else { ?>
                    <p>File(s) not found...</p>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="inbox-div">
    <h3>Mesaj kutusu</h3>
    <?php if (!empty($messages)) { ?>
        <ul class="list-group">
            <?php foreach ($messages as $message) { ?>
                <li class="list-group-item <?php echo $message['is_read'] ? '' : 'list-group-item-info'; ?>">
                    <p><strong><?php echo $message['sender_name']; ?>:</strong> <?php echo $message['message']; ?></p>
                    <small>GÖNDERİLDİ </small>
                   
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No messages found...</p>
    <?php } ?>
</div>
</body>
</html>
