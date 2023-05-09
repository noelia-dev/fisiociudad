<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
//use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    //Sistema de permisos de acceso a acciones.
  /*  public function beforeFilter(EventInterface $event)
    {
       // parent::beforeFilter($event);
        //Permite al usuario no autenticado acceder al apartado login
       // $this->Authentication->addUnauthenticatedActions(['login']);
    }*/

    /**
     * Establece la conexión del usuario
     */
  /*  public function login()
    {
        //Aceptamos ambos métodos para poder obtener los datos del formulario.
        $this->getRequest()->allowMethod(['get', 'post']);
        $resultado = $this->Authentication->getResult();
        if ($resultado->isValid()) {
            return $this->redirect(['controller' => 'comandos', 'action' => 'index']);
        }
        if ($this->getRequest()->is('post') && !$resultado->isValid()) {
            $this->Flash->error('Conexión no establecida');
        }

        $this->viewBuilder()->setLayout('BackTheme.login');
    }*/

    /**
     * Desconexión del usuario
     */
 /*   public function logout()
    {
        $resultado = $this->Authentication->getResult();
        if ($resultado->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'users', 'action' => 'login']);
        }
        $this->Flash->error('Desconexión imposible.');
        //Enviamos al usuario a la página en la que se encontraba antes de desconectarse.
        return $this->redirect($this->referer());
    }*/


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        //Condiciones AND sobre la condición where
        $users = $this->paginate($this->Users->find()->where(['eliminado is' => null, 'es_admin is not' => null, 'es_admin is not' => '0']));
        //crea una tabla con el contenido con todas las lineas resultantes
        $this->set(compact('users'));
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
        $user = $this->Users->get($id, [
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
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
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
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
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
        $user = $this->Users->get($id);
        $user = $this->Users->patchEntity($user, ['eliminado' => date('Y-m-d H:i:s')]);
        if ($this->Users->save($user)) {
            $this->Flash->success(__('El usuario ha sido eliminado correctamente.'));
        } else {
            $this->Flash->error(__('El usuario NO ha podido ser eliminado. Por favor, intentelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
