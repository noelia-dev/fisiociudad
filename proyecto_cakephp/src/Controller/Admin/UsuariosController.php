<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\EventInterface;
use Cake\Datasource\Pagination\NumericPaginator;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController
{
    public $paginate = [
        'limit'=> 1,
        'order' => [
            'Usuarios.nombre' => 'asc'
        ]
    ];

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');

    }
    //Sistema de permisos de acceso a acciones.
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
    }
    /**
     * Establece la conexión del usuario
     */
    public function login()
    {
        //Aceptamos ambos métodos para poder obtener los datos del formulario.
        $this->getRequest()->allowMethod(['get', 'post']);
        $resultado = $this->Authentication->getResult();
        if ($resultado->isValid()) {
            return $this->redirect(['controller' => 'Usuarios', 'action' => 'index']);
        }
        if ($this->getRequest()->is('post') && !$resultado->isValid()) {
            $this->Flash->error('Conexión no establecida');
        } else {
            $this->Flash->error('Conexión establecida');
        }
        //Cambiamos el theme a utilizar
        $this->viewBuilder()->setLayout('BackTheme.login');
    }

    /**
     * Desconexión del usuario
     */
    public function logout()
    {
        $resultado = $this->Authentication->getResult();
        if ($resultado->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Usuarios', 'action' => 'login']);
        }
        $this->Flash->error('Desconexión imposible.');
        //Enviamos al usuario a la página en la que se encontraba antes de desconectarse.
        return $this->redirect($this->referer());
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        //Condiciones AND sobre la condición where. Sólo se mostrarán que no son administradores.
        $usuarios = $this->paginate($this->Usuarios->find()->where([
           'es_admin is not' => '1']));
        //crea una tabla con el contenido con todas las lineas resultantes
        $this->set(compact('usuarios'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Usuarios->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //Creamos uno vacio
        $usuario = $this->Usuarios->newEmptyEntity();
        if ($this->request->is('post')) {
            //venimos de la validación del formulario
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($this->request->getData('confirm_password') == $this->request->getData('password')) {
                if ($this->Usuarios->save($usuario)) {
                    $this->Flash->success(__('Usuario añadido correctamente.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('Las contraseñas no coinciden.'));
            }

            $this->Flash->error(__('Usuario no guardado. Inténtelo de nuevo más tarde.'));
        }
        $this->set(compact('usuario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $usuario = $this->Usuarios->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Usuario modificado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Modificaciones no guardadas. Inténtelo de nuevo más tarde.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuarios->get($id);
        $usuario = $this->Usuarios->patchEntity($usuario, ['eliminado' => date('Y-m-d H:i:s')]);
        if ($this->Usuarios->save($usuario)) {
            $this->Flash->success(__('El usuario ha sido eliminado correctamente.'));
        } else {
            $this->Flash->error(__('El usuario NO ha podido ser eliminado. Por favor, intentelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function get_calendario_completo($year)
    {
        $calendario_completo = array();

        date("L", mktime(0, 0, 0, 7, 7, $year)) ? $days = 366 : $days = 365;
        for ($i = 1; $i <= $days; $i++) {
            //echo $month;
            $mes_letras = (int)date('m', mktime(0, 0, 0, 1, $i, $year));
            $month_num = (int)date('N', mktime(0, 0, 0, 1, $i, $year));
            $wk = (int)date('W', mktime(0, 0, 0, 1, $i, $year));
            $wkDay = date('D', mktime(0, 0, 0, 1, $i, $year));
            // $wkDay = substr($this->get_nombre_semana($wkDay),0,3);
            $day = (int)date('d', mktime(0, 0, 0, 1, $i, $year));

            $calendario_completo[$mes_letras][$wk][$wkDay] = $day;
        }
        //dd($calendario_completo);
        $this->set(compact('calendario_completo'));
    }


}
