<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        // $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Authentication.Authentication');
        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
        $this->Authentication->allowUnauthenticated(['view', 'index','pages','obtenerHorarios','diasSinCita']);
        if(isset($this->nombres_mesesES)){
            $meses = $this->obtener_meses();
            $this->set(compact('meses'));
        }
        
    }

    public function beforeRender(EventInterface $event)
    {
        //Establecemos el tema que utilizará el prefijo Admin
        $this->viewBuilder()->setTheme('FrontTheme');
    }
    //Obtiene los meses siguiente, no se muestra pasado
    public function obtener_meses($month_format = "M")
    {
        date_default_timezone_set('Europe/Madrid');
        setlocale(LC_ALL, 'es_ES');
        $mes_actual = (int)date('m');
        if(date('t')== date('d')){
            $mes_mostrar = $mes_actual +1;
            $this->set(compact('mes_mostrar'));
        }else{
            $mes_mostrar = $mes_actual;
            $this->set(compact('mes_mostrar'));
        }       
        $months =  [];
        //Sólo devolvemos los meses siguiente al mes actual
        for ($i = 1; $i <= 12; $i++) {
            $months[] = strtoupper(substr($this->nombres_mesesES[$i - 1], 0, 3));
        }
        return $months;
    }

    public function get_nombre_semana($nombre_semana)
    {
        $diassemanaES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $diassemanaEN = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");

        $indice = array_search($nombre_semana, $diassemanaEN);

        return $diassemanaES[$indice];
    }
    

    public function obtenerHorarios(){
        return true;
    }
}
