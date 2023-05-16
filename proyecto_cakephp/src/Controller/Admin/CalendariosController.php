<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Calendarios Controller
 *
 * @property \App\Model\Table\CalendariosTable $Calendarios
 * @method \App\Model\Entity\Calendario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CalendariosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $calendarios = $this->paginate($this->Calendarios);

        $this->set(compact('calendarios'));
    }

    /**
     * View method
     *
     * @param string|null $id Calendario id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $calendario = $this->Calendarios->get($id, [
            'contain' => ['Citas'],
        ]);

        $this->set(compact('calendario'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $calendario = $this->Calendarios->newEmptyEntity();
        if ($this->request->is('post')) {
            $calendario = $this->Calendarios->patchEntity($calendario, $this->request->getData());
            if ($this->Calendarios->save($calendario)) {
                $this->Flash->success(__('The calendario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The calendario could not be saved. Please, try again.'));
        }
        $this->set(compact('calendario'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Calendario id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $calendario = $this->Calendarios->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $calendario = $this->Calendarios->patchEntity($calendario, $this->request->getData());
            if ($this->Calendarios->save($calendario)) {
                $this->Flash->success(__('The calendario has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The calendario could not be saved. Please, try again.'));
        }
        $this->set(compact('calendario'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Calendario id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $calendario = $this->Calendarios->get($id);
        if ($this->Calendarios->delete($calendario)) {
            $this->Flash->success(__('The calendario has been deleted.'));
        } else {
            $this->Flash->error(__('The calendario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
