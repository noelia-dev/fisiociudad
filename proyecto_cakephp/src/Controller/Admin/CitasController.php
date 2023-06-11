<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Event\EventInterface;
use Cake\Datasource\Pagination\NumericPaginator;
use Cake\Routing\Router;
use Cake\Chronos\Date;
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\Http\Response;
use Cake\Database\Expression\QueryExpression;
use Cake\View\View;


/**
 * Citas Controller
 *
 * @property \App\Model\Table\CitasTable $Citas
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CitasController extends AppController
{
    public $lista_horario = [
        '10:00:00', '11:00:00', '12:00:00', '13:00:00',
        '16:00:00', '17:00:00', '18:00:00', '19:00:00'
    ];

    public $paginate = [
        'limit' => '1',
        /*'order' => [
            'Citas.fecha' => 'desc',
        ]*/
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
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        //No quitar
        $this->paginate = [
            //    'contain' => ['Usuarios', 'Calendarios'],
        ];
        $citas = $this->Citas->find('all')->toArray();


        $fechas_citas = array();
        //Visualizar todo
        foreach ($citas as $cita) {
            $fechas_citas[] = $cita->fecha->format('Y-m-d');
        }

        $fechas_citas = array_unique($fechas_citas);
        // dd($fechas_citas);
        $anio_calendario = (int) date("Y");
        $this->get_calendario_completo((int) date("Y"));

        $this->set(compact('citas', 'anio_calendario', 'fechas_citas'));
    }

    public function exportarPdf($fecha)
    {
        $fecha = new Date($fecha);
        $fecha_formateada = $fecha->format('Y-m-d');

        $dompdf = new Dompdf();
        $options = new Options();
        $this->paginate = [];
        setlocale(LC_TIME, 'es_ES');

        $resultado_citas = $this->Citas->find()
            ->where([
                'fecha' => $fecha_formateada
            ])
            ->order(['hora' => 'asc'])
            ->contain('Usuarios')
            ->formatResults(function ($results) {
                return $results->map(function ($row) {
                    $row['hora'] =  date('H:i', strtotime($row['hora'])); // Formateo de la hora
                    return $row;
                });
            });

        $options->set('isRemoteEnabled', true);
        // Establecemos las opciones en Dompdf
        $dompdf->setOptions($options);
        // Generar el contenido HTML del PDF
        foreach ($resultado_citas as $citas) {
        };

        $this->set('resultado_citas', $resultado_citas);
        $html = $this->render('view_dia_export', 'export');
        // Cargar el contenido HTML en Dompdf
        $dompdf->loadHtml($html);

        $dompdf->render();
        // Obtener el contenido del PDF generado
        $pdfContent = $dompdf->output();

        // Descargar el PDF
        $response = new Response();
        $response = $response->withType('application/pdf')
            ->withStringBody($pdfContent)
            ->withDownload('citas_' . $fecha . '.pdf');
        //Devolvemos al usuario a la página con el listado de citas de ese día
        $this->redirect(['action' => 'viewDia', $fecha->format('d') . $fecha->format('m') . $fecha->format('Y')]);

        return $response;
    }

    /**
     * Muestra un listado de usuarios para la fecha seleccionada
     * 
     */
    public function viewDia($dia_mostrar, $mes, $anio_calendario)
    {
        $fecha = new Date(($anio_calendario . '-' . $mes . '-' . $dia_mostrar));
        $fecha_selecionada = $fecha->format('Y-m-d');

        $this->paginate = [
            'contain' => ['Usuarios', 'Calendarios'],
        ];
        /*  $cita = $this->Citas->get($id, [
            //'contain' => ['Usuarios', 'Calendarios'],
        ]);*/
        //dd($fecha_selecionada);

        $resultado_citas = $this->Citas->find()
            ->where([
                'Citas.fecha' => $fecha_selecionada
            ])
            ->formatResults(function ($results) {
                return $results->map(function ($row) {
                    $row['hora'] =  date('H:i', strtotime($row['hora'])); // Formateo de la hora
                    $row['alta'] =  $row['alta']->format('d-m-Y, H:i'); // Formateo de la hora
                    return $row;
                });
            });
        $citas_por_usuario = $this->paginate($resultado_citas, ['limit' => '5']);
        // Verificar si se encontraron registros
        if (!empty($resultado_citas) && $resultado_citas->count() != 0) {
            foreach ($resultado_citas as $result) {
                // Con el objeto de entidad creamos el nombre para mostrarlo en la vista
                $nombre_usuario = $result->usuario->nombre . ' ' . $result->usuario->apellidos;
                break;
            }
        } else {

            // @TODO para mostrar ingualmente el usuario
            //No se encontraron registros
            /* $resultado_citas = $this->Usuarios->find()->where([
                    'id' => $id
                ]);
                dd($resultado_citas);*/
        }

        $fecha_mostrar = $fecha->format('d-m-Y');

        $this->set(compact('citas_por_usuario', 'fecha_mostrar'));
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
        $nombre_usuario = '';
        $this->paginate = [
            'contain' => ['Usuarios', 'Calendarios'],
        ];
        /*  $cita = $this->Citas->get($id, [
            //'contain' => ['Usuarios', 'Calendarios'],
        ]);*/

        if ($id != null) {
            $resultado_citas = $this->Citas->find()
                ->where(['usuario_id' => $id])
                ->order(['Citas.fecha' => 'asc'])
                ->formatResults(function ($results) {
                    return $results->map(function ($row) {
                        $row['fecha'] = $row['fecha']->format('d-m-Y'); // Formateo de la fecha
                        $row['hora'] =  date('H:i', strtotime($row['hora'])); // Formateo de la hora
                        $row['alta'] =  $row['alta']->format('d-m-Y, H:i'); // Formateo de la hora
                        return $row;
                    });
                });

            $citas = $this->paginate($resultado_citas, ['limit' => '10']);
            // Verificar si se encontraron registros
            if (!empty($resultado_citas) && $resultado_citas->count() != 0) {
                foreach ($resultado_citas as $result) {
                    // Con el objeto de entidad creamos el nombre para mostrarlo en la vista
                    $nombre_usuario = $result->usuario->nombre . ' ' . $result->usuario->apellidos;
                    break;
                }
            } else {

                // @TODO para mostrar ingualmente el usuario
                //No se encontraron registros
                /* $resultado_citas = $this->Usuarios->find()->where([
                    'id' => $id
                ]);
                dd($resultado_citas);*/
            }
        }
        $this->set(compact('citas', 'nombre_usuario'));
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
            if(!in_array($cita->hora,$this->lista_horario)){
                $this->Flash->error('El horario debe ser el establecido por la aplicación.', ['escape' => false]);
                return $this->redirect(['action' => 'add']);
            }
            if ($this->Citas->save($cita)) {
                $this->Flash->success(__('Cita añadida correctamente.'));
                return $this->redirect(['action' => 'index']);
            } else {
                //Obtenemos los errores procedentes de la validación y los mostramos
                $errores = $cita->getErrors();
                // Recorre los errores y establece cada mensaje en la sesión
                foreach ($errores as $field => $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        if ($field == 'fecha') {
                            //dd($cita->getInvalid()[$field]);
                            // Genera el enlace utilizando el Router y el control deseado
                            $url = Router::url([
                                'controller' => 'Calendarios',
                                'action' => 'add/' . $cita->getInvalid()[$field] //parámetro que se carga al darle a añadir
                            ], true);
                            //Modificamos el mensaje de error
                            $error = sprintf($error, '<a href="' . $url . '">Añadir</a>');
                        }
                        $this->Flash->error($error, ['escape' => false]);
                    }
                }
            }
        }
        //Establece una array con todos los pacientes, sin incluir al administrador
        $this->get_usuario_usuarios();
        $calendarios = $this->Citas->Calendarios->find('list', ['limit' => 200])->all();
        $lista_horario = str_replace('00:00','00',implode(' // ',$this->lista_horario));
        $this->set(compact('cita', 'calendarios','lista_horario'));
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
            'contain' => ['Usuarios'],
        ]);
        //dd($id);
        $usuario_nombre = $cita->usuario->nombre . ' ' . $cita->usuario->apellidos;

        if ($this->request->is(['patch', 'post', 'put'])) {
            $cita = $this->Citas->patchEntity($cita, $this->request->getData());
            if(!in_array($cita->hora,$this->lista_horario)){
                $this->Flash->error('El horario debe ser el establecido por la aplicación.', ['escape' => false]);
                return $this->redirect(['action' => 'edit',$id]);
            }
            if ($this->Citas->save($cita)) {
                $this->Flash->success(__('Cita guardado correctamente.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $errores = $cita->getErrors();
                // Recorre los errores y establece cada mensaje en la sesión
                foreach ($errores as $field => $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        $this->Flash->error($error, ['escape' => false]);
                    }
                }
            }
        } else {
            $this->getRequest()->getData()['nota_profesional'] = $cita->nota_profesional;
            //$this->Form->setValue('nota_profesional',);
        }
        $lista_horario = str_replace('00:00','00',implode(' // ',$this->lista_horario));
        $this->set(compact('cita', 'usuario_nombre','lista_horario'));
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
        $this->request->allowMethod(['post', 'delete','get']);
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
