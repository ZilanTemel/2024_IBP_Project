<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mesaj Gönder</title>
</head>
<body>
    <h1>Mesaj Gönder</h1>
    <?php if ($this->session->flashdata('message')): ?>
        <p><?php echo $this->session->flashdata('message'); ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo base_url('messages/send'); ?>">
        <div>
            <label for="receiver_id">Alıcı ID:</label>
            <input type="text" name="receiver_id" id="receiver_id">
        </div>
        <div>
            <label for="subject">Konu:</label>
            <input type="text" name="subject" id="subject">
        </div>
        <div>
            <label for="message">Mesaj:</label>
            <textarea name="message" id="message"></textarea>
        </div>
        <div>
            <input type="submit" value="Gönder">
        </div>
    </form>
</body>
</html>
