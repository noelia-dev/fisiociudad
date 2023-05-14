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
    /**
     * Creación de usuario inicalmente si no está creado (PTE)
     */
    public function index()
    {
        $this->fetchTable('Users'); //$this->loadModel('Users');
        $users = $this->getTableLocator()->get('Users');
        $result_datos = $users->find()->where(['es_admin =' => 1]);
     //   if ($result_datos) {
            //No hay admin, creamos un usuario por defecto
            date_default_timezone_set("Europe/Madrid");
            $data = [
                'es_admin' => 1,
                'correo' => 'noeliacortijo@gmail.com',
                'password'  => 'admin',
                'nombre' => 'Noelia',
                'apellidos' => 'Cortijo Durán',
                'telefono' => '679663692',
                'alta' => null,
                'modificado' => null,
                'eliminado' => null
            ];
            $users = $this->getTableLocator()->get('Users');
            $entity = $users->newEntity($data);
            $users->save($entity);
      //  } else {
            // YA EXISTE EL ADMIN dd($result_datos);
        //}
    }
}
