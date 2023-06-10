<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\EventInterface;
use Cake\Datasource\Pagination\NumericPaginator;
use Cake\Mailer\Mailer;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController
{
    public $paginate = [
        'limit' => 5,
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
            if($resultado->getData()->correo=='admin@admin.com'){
                //Redirigimos al usuario a la edición de su perfil, para que establezca sus datos correctamente.
                return $this->redirect(['controller' => 'Usuarios', 'action' => 'editadmin',$resultado->getData()->id]);
            }else{
                return $this->redirect(['controller' => 'Usuarios', 'action' => 'index']);
            }
        }
        if ($this->getRequest()->is('post')){
            if( !$resultado->isValid()) {
                $this->Flash->error('Conexión no establecida');
            } else {
                $this->Flash->success('Conexión establecida, datos incorrectos. Vuelva a intentarlo.');
            }
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
            return $this->redirect('/');
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
        
       // $resultado->getData('Usuario')['correo']

        //Condiciones AND sobre la condición where. Sólo se mostrarán que no son administradores.
        $usuarios = $this->paginate(
            $this->Usuarios->find()
                ->where(['es_admin is not' => '1'])
                ->order(['alta' => 'desc'])
                ->formatResults(function ($results) {
                    return $results->map(function ($row) {
                        $row['alta'] =  $row['alta']->format('d-m-Y, H:i'); // Formateo de la hora
                        return $row;
                    });
                })
        );
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
                    $this->Flash->success(__('Pacinete añadido correctamente.'));
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('Las contraseñas no coinciden.'));
            }

            $this->Flash->error(__('Pacinete no guardado. Inténtelo de nuevo más tarde.'));
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
                $this->Flash->success(__('Paciente modificado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Modificaciones no guardadas. Inténtelo de nuevo más tarde.'));
        }
        $this->set(compact('usuario'));
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
        if ($this->Usuarios->delete($usuario)) {

        //$usuario = $this->Usuarios->patchEntity($usuario, ['eliminado' => date('Y-m-d H:i:s')]);
        //if ($this->Usuarios->save($usuario)) {
            $this->Flash->success(__('El pacinete ha sido eliminado correctamente.'));
        } else {
            $this->Flash->error(__('El pacinete NO ha podido ser eliminado. Por favor, intentelo de nuevo.'));
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

    public function editadmin($id = null)
    {
        $usuario = $this->Usuarios->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $user = $this->Usuarios->patchEntity($usuario, $this->request->getData());

            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Pacinete modificado correctamente.'));
                $this->request->getSession()->renew(); //por si ha cambiado el nombre del usuario

                $session = $this->request->getSession();
                if ($session->check('login_nombre')) {
                    dd('dd');
                    $usuario = $this->Usuarios->get($id);
                    $login_nombre = $usuario->nombre;
                    $login_nombre .= ' ' . $usuario->apellidos;
                    // Obtener el valor actual de la variable de sesión
                    $session->write('login_nombre', $login_nombre);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Modificaciones no guardadas. Inténtelo de nuevo más tarde.'));
        }
        $this->set(compact('usuario'));
    }
    /**
     * Permite el cambio de contraseña del usuario administrador
     */
    public function adminpass($id = null)
    {
        $usuario = $this->Usuarios->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($this->request->getData('confirm_password') == $this->request->getData('password')) {
                if ($this->Usuarios->save($usuario)) {
                    $this->Flash->success(__('Constraseña modificado correctamente.'));
                    return $this->redirect(['controller' => 'Usuarios', 'action' => 'logout']);
                }
            } else {
                $this->Flash->error(__('Las contraseñas no coinciden.'));
            }
        }
        $this->set(compact('usuario'));
    }

    public function passwordRecup()
    {
        $this->viewBuilder()->setLayout('BackTheme.login');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $email = new Mailer('default');
         //   dd($this->request->getData('correo'));
            $email->setFrom(['me@example.com' => 'My Site'])
                ->setTo($this->request->getData('correo'))
                ->setSubject('Prueba de correo electrónico')
                ->deliver('Contenido del correo electrónico');
            $this->Flash->success(__('Correo enviado correctamente.'));
        }
        //$this->viewBuilder()->setLayout('BackTheme.password_recup');
    }
}