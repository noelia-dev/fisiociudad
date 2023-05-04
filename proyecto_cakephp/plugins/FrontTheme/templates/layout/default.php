<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SB Admin 2 - Dashboard</title>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
   
    <?= $this->Html->css([
        'BackTheme./css/sb-admin-2.min',
        'BackTheme./css/fontawesome.min'
    ]); ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Menu -->
        <?= $this->Element('BackTheme.layout/menu'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <?= $this->Element('BackTheme.layout/topbar'); ?>
                <div class="container-fluid">
                    <!-- Content -->
                    <?= $this->fetch('content'); ?>
                </div>
            </div>
            <!-- Footer -->
            <?= $this->Element('BackTheme.layout/footer'); ?>
        </div>
    </div>

    <!-- Script-->
    <?= $this->Html->script([
 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js',        'BackTheme./js/jquery.min',
        'BackTheme./js/bootstrap.bundle.min',
        'BackTheme./js/jquery.easing.min',
        'BackTheme./js/sb-admin-2.min',
    ]); ?>
</body>

</html>