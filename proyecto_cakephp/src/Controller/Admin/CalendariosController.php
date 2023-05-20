<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Chronos\Date;

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
        $anio_calendario = date("Y");
        //Muestra sólo datos del año 2023
        $resultado_calendarios = $this->Calendarios->find()
            ->where(function ($exp, $q) use ($anio_calendario) {
                return $exp->equalFields('YEAR(fecha)', $anio_calendario);
            });

        $calendarios_sinformato = $resultado_calendarios->all()->toArray();

        $calendarios = [];
        foreach ($calendarios_sinformato as $calendario) {
            $calendarios[] = [
                'id' => $calendario->id,
                'fecha' => date('Y-m-d', strtotime($calendario->fecha)),
                'descripcion' => $calendario->descripcion
            ];
        }
        $this->get_calendario_completo((int) date("Y"));
        $this->set(compact('calendarios', 'anio_calendario'));
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
    public function add($fecha_selecionada = null)
    {
        $calendario = $this->Calendarios->newEmptyEntity();
        if ($this->request->is('post')) {
            $calendario = $this->Calendarios->patchEntity($calendario, $this->request->getData());
            if ($this->Calendarios->save($calendario)) {
                $this->Flash->success(__('La fehca ha sido añadida.'));

                return $this->redirect(['action' => 'index']);
            }
        } elseif ($fecha_selecionada != null) {
            $f = new Date($fecha_selecionada);
            $fecha_selecionada = $f->format('Y-m-d');
            $this->set(compact('fecha_selecionada'));
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

        if ($this->request->is(['post', 'delete'])) {
            if (empty($selectedDates)) {
                $this->Flash->error(__('Debe seleccionar al menos una fecha para relizar la eliminación.'));
            }else{
                 //dd($this->request->getData('selected_ids'));
            $ids_seleccionados = $this->request->getData('selected_ids');
            if ($this->Calendarios->deleteAll(['fecha IN' => $ids_seleccionados])) {
                $this->Flash->success(__('La/s fecha/s se ha/n eliminado correctamente del calendario.'));
            } else {
                $this->Flash->error(__('La fecha no ha sido eliminada, vuelva a intentarlo más tarde.'));
            }
            }
           
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
