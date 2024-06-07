<!-- application/views/Auth/inbox.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <h2>Inbox</h2>
    <?php if (!empty($messages)) { ?>
        <ul class="list-group">
            <?php foreach ($messages as $message) { ?>
                <li class="list-group-item <?php echo $message['is_read'] ? '' : 'list-group-item-info'; ?>">
                    <p><?php echo $message['message']; ?></p>
                    <small>Sent on <?php echo date("j M Y, g:i a", strtotime($message['created_at'])); ?></small>
                    <?php if (!$message['is_read']) { ?>
                        <a href="<?php echo base_url('Messages/markAsRead/'.$message['id']); ?>" class="btn btn-sm btn-primary">Mark as Read</a>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No messages found...</p>
    <?php } ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
