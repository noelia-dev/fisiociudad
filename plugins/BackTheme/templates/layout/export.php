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
        'BackTheme./css/fontawesome.min',
    ]); ?>
</head>

<body id="bg-gradient-primary">
    <!--?= $this->Html->image('BackTheme./img/favicon.ico', [
        'class' => 'sidebar-brand d-flex align-items-center justify-content-center'
    ]) ?-->

        <!-- Contenido página -->
        <div class="container" style="text-align: center; position: fixed; top: 100px; width: 100%;">
            <?= $this->fetch('content'); ?>
        </div>
        <!-- Pie de página -->
        <div  style="text-align: center; position: fixed; bottom: 20px; width: 100%;">
            <?= $this->Element('BackTheme.layout/footer'); ?>
        </div>
       
        <!-- Carga de scripts -->
        <?= $this->Html->script([
            'BackTheme./js/jquery.min',
            'BackTheme./js/bootstrap.bundle.min',
            'BackTheme./js/jquery.easing.min',
            'BackTheme./js/sb-admin-2.min',
            'BackTheme./js/custom',
        ]); ?>

</body>

</html>