<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/usermanagement.css">
    <style>
        .navbar {
            background-color: #f8f9fa;
            padding: 10px 0;
        }
        .container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .status-msg {
            margin-top: 10px;
        }
        @media (max-width: 767.98px) {
            .table thead {
                display: none;
            }
            .table,
            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
                text-align: left;
            }
            .table td {
                text-align: right;
                padding-left: 45%;
                padding-top: 5px;
                padding-bottom: 5px;
                position: relative;
            }
            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 40%;
                padding-left: 15px;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
<div class="navbar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="<?php echo base_url('Auth/adminPage'); ?>" class="back-button">ADMİN SAYFASINA DÖN</a>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?php echo base_url('Auth/logout'); ?>" class="logout-button">ÇIKIŞ</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h3 class="text-center"> KULLANICI YÖNETİM PANELİ</h3>
    <?php if($this->session->flashdata('success')) { ?>
        <p class="status-msg text-success"><?php echo $this->session->flashdata('success'); ?></p>
    <?php } elseif($this->session->flashdata('error')) { ?>
        <p class="status-msg text-danger"><?php echo $this->session->flashdata('error'); ?></p>
    <?php } ?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>KULLANICI ADI</th>
                    <th>Email</th>
                    <th>EYLEM</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($users)) {
                    foreach($users as $user) { ?>
                        <tr>
                            <td data-label="ID"><?php echo isset($user['id']) ? $user['id'] : ''; ?></td>
                            <td data-label="KULLANICI ADI"><?php echo isset($user['name']) ? $user['name'] : 'No Username'; ?></td>
                            <td data-label="Email"><?php echo isset($user['email']) ? $user['email'] : 'No Email'; ?></td>
                            <td data-label="EYLEM">
                                <a href="<?php echo base_url('auth/editUser/'.$user['id']); ?>">GÜNCELLE</a> |
                                <a href="<?php echo base_url('auth/deleteUser/'.$user['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">SİL</a>
                            </td>
                        </tr>
                <?php } } else { ?>
                    <tr><td colspan="4" class="text-center">No users found...</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
