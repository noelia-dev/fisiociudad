<!DOCTYPE html>
<html lang="es">

<head>
    <title>Calendar 04</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FISIOCIUDAD - Pide cita según disponibilidad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="" rel="stylesheet">
    <?= $this->Html->meta(
        'favicon.ico',
        'BackTheme./img/favicon.ico',
        ['type' => 'icon']
    );?>
    <?= $this->Html->css([
        'FrontTheme./css/style',
        'FrontTheme./css/custom',
        'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min',
        'https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap'
    ]); ?>
</head>

<body>
    <?= $this->Element('FrontTheme.layout/topbar'); ?>
    <?= $this->Flash->render(); ?>
     <!-- Script-->
    <?= $this->Html->script([
        'FrontTheme./js/jquery.min',
        'FrontTheme./js/popper',
        'FrontTheme./js/bootstrap.min',
        'FrontTheme./js/main',
        'FrontTheme./js/custom'
    ]); ?>

    <!-- Content -->
    <?= $this->fetch('content'); ?>

    <?= $this->Element('BackTheme.layout/footer'); ?>

   
</body>

</html>