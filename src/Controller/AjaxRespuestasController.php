<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Response;
use Cake\ORM\TableRegistry;
use Cake\Chronos\Date;


/**
 * AjaxRespuestas Controller
 *
 * @method \App\Model\Entity\AjaxRespuesta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AjaxRespuestasController extends AppController
{
    //Horarios disponibles por días.
    public $lista_horario = [
        '10:00:00', '11:00:00', '12:00:00', '13:00:00',
        '16:00:00', '17:00:00', '18:00:00', '19:00:00'
    ];

    public function obtenerHorarios()
    {
        $data = $this->getRequest();
        $dia = $data->getData('dia');
        $mes = $data->getData('mes');
        $anio = $data->getData('anio');

        //$resultado =  $dia .$mes . $anio;
        $fecha = new Date($anio . '-' . $mes . '-' . $dia);
        $fecha_selecionada = $fecha->format('Y-m-d');

        $this->citas = TableRegistry::getTableLocator()->get('Citas');

        $resultado_citas = $this->citas->find()->where([
            'Citas.fecha' => $fecha_selecionada
        ])->toArray();

        $horas = [];
        foreach ($resultado_citas as $key => $value) {
            $horas[] = $value['hora'];
        }
        $horas = array_values(array_diff($this->lista_horario, $horas));

        // Devuelve una respuesta JSON
        $response = new Response();
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['success' => $horas]));

        return $response;
    }
    /**
     * Obtiene el mes completo con los días que no disponibilidad. Para ello tomaremos también 
     * el número de citas creados para añadirlo o no a la tabla devuelta.
     */
    public function diasSinCita()
    {
        $mes = $this->getRequest()->getData('mes');
        $anio = $this->getRequest()->getData('anio');
        $this->Calendarios = TableRegistry::getTableLocator()->get('Calendarios');
        $resultado_calendarios = $this->Calendarios->find()
            ->where(function ($exp, $q) use ($anio, $mes) {
                return $exp->and([
                    $exp->equalFields('YEAR(fecha)', $anio),
                    $exp->equalFields('MONTH(fecha)', $mes)
                ]);
            });

        $calendarios_sinformato = $resultado_calendarios->all()->toArray();

        $calendarios = [];
        foreach ($calendarios_sinformato as $calendario) {
            $calendarios[] = $calendario->fecha;
        }
        //Obtenemos los días donde no hay más disponibilidad para citas y lo añadimos al 
        //array anterior
        $this->Citas = TableRegistry::getTableLocator()->get('Citas');
        $resultado_citas = $this->Citas->find();
        $resultado_citas->select([
            'count' => $resultado_citas->func()->count('*'),
            'fecha'])
            ->where([
                'YEAR(fecha)' => $anio,
                'MONTH(fecha)' => $mes
            ])
            ->group('fecha')
            ->having(['count' => count($this->lista_horario)]);

        foreach ($resultado_citas as $cita) {
            $calendarios[] = $cita->fecha;
        }
        // Devuelve una respuesta JSON
        $response = new Response();
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['success' => $calendarios,'otros'=> $resultado_citas]));

        return $response;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->citas = TableRegistry::getTableLocator()->get('Citas');

        //$ajaxRespuestas = $this->paginate($this->AjaxRespuestas);

        $this->set(compact('ajaxRespuestas'));
    }

    /**
     * View method
     *
     * @param string|null $id Ajax Respuesta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ajaxRespuesta = $this->AjaxRespuestas->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('ajaxRespuesta'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ajaxRespuesta = $this->AjaxRespuestas->newEmptyEntity();
        if ($this->request->is('post')) {
            $ajaxRespuesta = $this->AjaxRespuestas->patchEntity($ajaxRespuesta, $this->request->getData());
            if ($this->AjaxRespuestas->save($ajaxRespuesta)) {
                $this->Flash->success(__('The ajax respuesta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ajax respuesta could not be saved. Please, try again.'));
        }
        $this->set(compact('ajaxRespuesta'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ajax Respuesta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ajaxRespuesta = $this->AjaxRespuestas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ajaxRespuesta = $this->AjaxRespuestas->patchEntity($ajaxRespuesta, $this->request->getData());
            if ($this->AjaxRespuestas->save($ajaxRespuesta)) {
                $this->Flash->success(__('The ajax respuesta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ajax respuesta could not be saved. Please, try again.'));
        }
        $this->set(compact('ajaxRespuesta'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ajax Respuesta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ajaxRespuesta = $this->AjaxRespuestas->get($id);
        if ($this->AjaxRespuestas->delete($ajaxRespuesta)) {
            $this->Flash->success(__('The ajax respuesta has been deleted.'));
        } else {
            $this->Flash->error(__('The ajax respuesta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
