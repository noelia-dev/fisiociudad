<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administración de las citas</title>

    <!-- Custom fonts for this template
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/sb-admin-2.min.css" rel="stylesheet">-->

    <?= $this->Html->meta(
        'favicon.ico',
        'BackTheme./img/favicon.ico',
        ['type' => 'icon']
    );
    ?>
    <?= $this->Html->css([
        'BackTheme./css/sb-admin-2.min',
        'BackTheme./css/fontawesome.min'
    ]); ?>
</head>

<body id="page-top">
    <!-- Contenido página -->
    <div id="wrapper">
        <!-- Menu lateral -->
        <?= $this->Element('BackTheme.layout/menu'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Menu -->
                <?= $this->Element('BackTheme.layout/topbar'); ?>
                <!-- Contenido de la página  -->
                <div class="container-fluid">
                    <?= $this->fetch('content'); ?>
                </div>
            </div>
            <!-- Pie de página -->
            <?= $this->Element('BackTheme.layout/footer'); ?>
        </div>
    </div>

    <!-- Carga de scripts -->
    <?= $this->Html->script([
        'BackTheme./js/jquery.min',
        'BackTheme./js/bootstrap.bundle.min',
        'BackTheme./js/jquery.easing.min',
        'BackTheme./js/sb-admin-2.min',
        'BackTheme./js/custom',
    ]); ?>

    <!-- Bootstrap core JavaScript
     <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
-->
    <!-- Core plugin JavaScript
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
-->
    <!-- Custom scripts for all pages
    <script src="js/sb-admin-2.min.js"></script>
-->
    <!-- Page level plugins 
    <script src="vendor/chart.js/Chart.min.js"></script>-->

    <!-- Page level custom scripts
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
 -->

</body>

</html>