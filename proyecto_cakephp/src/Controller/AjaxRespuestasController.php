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
            $calendarios[] = date('Y-m-d', strtotime($calendario->fecha));
        }

        // Devuelve una respuesta JSON
        $response = new Response();
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['success' => $calendarios]));

        return $response;
    }
}
