<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Exception;

/**
 * Citas Controller
 *
 * @property \App\Model\Table\CitasTable $Citas
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CitasController extends AppController
{

    public $paginate = [
        'limit' => 1,
        'order' => [
            'Usuarios.nombre' => 'asc'
        ]
    ];

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($usuario_id = null)
    {
      //  dd($usuario_id);
     /*   $this->paginate = [
            'contain' => ['Usuarios', 'Calendarios'],
        ];*/
 
        if($usuario_id != null){
            $citas = $this->Citas->find()->where([
                'usuario_id' => $usuario_id
            ]);
        }else{
            $citas = $this->paginate($this->Citas->find('all'));
        }
        //dd( $citas );
        $anio_calendario = (int) date("Y");
        $this->get_calendario_completo((int) date("Y"));
        $this->set(compact('usuario_id','citas','anio_calendario'));
    }

    /**
     * View method
     *
     * @param string|null $id Cita id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
     //   dd($id);
     $this->paginate = [
        'contain' => ['Usuarios', 'Calendarios'],
    ];
        try{
            $citas = $this->Citas->get($id, [
                'contain' => ['Usuarios', 'Calendarios'],
            ]);
        }catch (Exception $e){
            $citas= null;
           /*@TODO Mostrar el nombre del usuario $usuario = $this->paginate($this->Citas->find()->where(['Usuarios.id'=>$id]));
            $this->set(compact('citas','usuario'));*/
            $this->set(compact('citas'));
        }
        
        if($id != null){
            $citas = $this->paginate($this->Citas->find()->where([
                'usuario_id' => $id
            ]));
        }

        $this->set(compact('citas'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cita = $this->Citas->newEmptyEntity();
        if ($this->request->is('post')) {
            $cita = $this->Citas->patchEntity($cita, $this->request->getData());
            if ($this->Citas->save($cita)) {
                $this->Flash->success(__('Cita añadida correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cita could not be saved. Please, try again.'));
        }
        $usuarios = $this->Citas->Usuarios->find('list', ['limit' => 200])->all();
        $calendarios = $this->Citas->Calendarios->find('list', ['limit' => 200])->all();
        $this->set(compact('cita', 'usuarios', 'calendarios'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cita id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cita = $this->Citas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cita = $this->Citas->patchEntity($cita, $this->request->getData());
            if ($this->Citas->save($cita)) {
                $this->Flash->success(__('Cita guardado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cita could not be saved. Please, try again.'));
        }
        $usuarios = $this->Citas->Usuarios->find('list', ['limit' => 200])->all();
        $calendarios = $this->Citas->Calendarios->find('list', ['limit' => 200])->all();
        $this->set(compact('cita', 'usuarios', 'calendarios'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cita id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cita = $this->Citas->get($id);
        if ($this->Citas->delete($cita)) {
            $this->Flash->success(__('Cita eliminada correctamente.'));
        } else {
            $this->Flash->error(__('The cita could not be deleted. Please, try again.'));
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
       // dd($calendario_completo);
        $this->set(compact('calendario_completo'));
    }
}
