<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>

<head>
    <title><?= $this->fetch('title') ?></title>
</head>

<body>
    Hola <?= $paciente ?>,
    <br>Gracias por utilizar el sistema de registro de nuestra plataforma.
    <br> su cita con los siguientes datos.
    <ul>
        <li>Fecha: <?= $fecha ?></li>
        <li>Hora: <?= $hora ?></li>
    </ul>
    PD: en caso de no poder asistir, rogamos anulen la cita.
    <br>
    Un saludo,
    <br>FISIOCIUDAD
    <br>Teléfono de contacto: 679663692
</body>

</html>