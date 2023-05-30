<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/4/en/views.html#the-app-view
 */
class AppView extends View
{
    public $diassemanaES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado","Domingo");
    public $diassemanaES_sub = array("Lun", "Mar", "Mié", "Jue", "Vie", "Sáb","Dom");
    public $diassemanaEN_sub = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
    public $nombres_mesesES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    public $cita;
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->loadHelper('Paginator',['templates' => 'BackTheme.paginator-templates']);
    }

    public function get_nombre_mes($numero_mes){

        $mes = date("F", mktime(0, 0, 0, $numero_mes, 10));
        return $mes;
    }
}
