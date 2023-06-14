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

namespace App\Controller\Admin;

use App\Controller\AppController as ControllerPrincipal;
use Cake\Event\EventInterface;
use Cake\Http\ServerRequest;
use App\Model\Table\UsuariosTable;
use Cake\ORM\TableRegistry;

/*
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends ControllerPrincipal
{
    public $login_nombre;
    public $id_login;
    protected $Usuarios;
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
        $this->Usuarios = TableRegistry::getTableLocator()->get('Usuarios');        
    }
  

    public function beforeRender(EventInterface $event)
    {
        //Establecemos el tema que utilizará el prefijo Admin
        $this->viewBuilder()->setTheme('BackTheme');

        // URL actual desde la solicitud
        $currentUrl = (new ServerRequest())->getUri()->getPath();
        // Extraer los valores de controlador y acción de la URL
        $urlSegments = explode('/', $currentUrl);
        $menus_externos = ['editadmin','adminpass'];
        // El valor por defecto
        $menu_activo = !empty($urlSegments[2]) ? $urlSegments[2] : 'index';
        foreach ($menus_externos as $valor) {
            if (in_array($valor, $urlSegments)) {
                $menu_activo = $valor;
                continue;
            }
        }
        $this->set(compact('menu_activo'));
    }

    //Sistema de permisos de acceso a acciones.
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        //Permite al usuario no autenticado acceder al apartado login
        $this->Authentication->allowUnauthenticated(['login','passwordRecup']);
        $resultado = $this->Authentication->getResult();
        if ($resultado->isValid()) {
            $login_nombre = $resultado->getData()->nombre;
            $login_nombre .= ' ' . $resultado->getData()->apellidos;
            $id_login = $resultado->getData()->id;
            //dd($id_login);
            //Nostramos el nombre del usuario que está logueado
            $this->set(compact('login_nombre', 'id_login'));
        }
    }

    public function get_usuario_usuarios($id = null){
        if($id==null){
             $usuarios = $this->Usuarios->find()->where([
                'es_admin is not' => '1']);
        }
        $lista_usuarios=array();
        foreach($usuarios as $usuario){
            $lista_usuarios += [$usuario->id => $usuario->nombre . ' ' .$usuario->apellidos];
        }
        //dd($lista_usuarios);
        $this->set(compact('lista_usuarios'));
    }
}
