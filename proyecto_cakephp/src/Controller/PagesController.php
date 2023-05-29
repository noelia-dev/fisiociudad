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

use App\Model\Entity\Calendario;
use Cake\Chronos\Chronos;

use Cake\ORM\TableRegistry;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public $nombres_mesesES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    protected $Calendarios;


    public function initialize(): void
    {
        parent::initialize();
        $this->Calendarios = TableRegistry::getTableLocator()->get('Calendarios');        
    }

    /**
     * Creación de usuario inicalmente si no está creado
     */
    public function index()
    {
        $this->fetchTable('Usuarios');
        $usuarios = $this->getTableLocator()->get('Usuarios');
        $result_datos = $usuarios->find()->where(['es_admin' => '1']);
        //Detectamos si es la primera vez que se accede al apartado administrador
        if ($result_datos->count() == 0) {
            //No hay admin, creamos un usuario por defecto
            date_default_timezone_set("Europe/Madrid");
            $data = [
                'es_admin' => '1',
                'correo' => 'noeliacortijo@gmail.com',
                'password'  => 'admin',
                'nombre' => 'Noelia',
                'apellidos' => 'Cortijo Durán',
                'telefono' => '679663692'
            ];
            $usuarios = $this->getTableLocator()->get('Usuarios');
            $entity = $usuarios->newEntity($data);
            $usuarios->save($entity);
            $this->crear_calendario_completo();
        } else {// Exite admin
            $this->fetchTable('Usuarios');
            $usuarios = $this->getTableLocator()->get('Usuarios');
            $result_datos = $usuarios->find()->where(['es_admin' => '1']);
        }
    }

    /**
     * Creación de todas fechas en las que NO se puede tomar cita.
     */
    public function crear_calendario_completo()
    {
        //Tomamos la fecha actual como punto de partida
        $fechaActual = Chronos::now();

        $dia = $fechaActual->day;
        $mes = $fechaActual->month;
        $anio = $fechaActual->year;
        
        $inicio = Chronos::createFromDate($anio, $mes, $dia);
        $fin = Chronos::createFromDate($anio, 12, 31);

        $dias_del_anio = [];
        $datos_alta2 = [];
        //Creación del calendario completo
        for ($fecha = $inicio; $fecha->lte($fin); $fecha = $fecha->addDay()) {
            if ($fecha->isSaturday() || $fecha->isSunday()) {
                $dias_del_anio[] = $fecha->format('Y-m-d');
                $datos_alta = new Calendario();
                $datos_alta->descripcion = 'inicio';
                $datos_alta->fecha = $fecha->format('Y-m-d');
                $datos_alta2[] = $datos_alta;
            }
        }

       // dd($datos_alta2);

        $this->Calendarios->saveMany($datos_alta2);
    }
}
