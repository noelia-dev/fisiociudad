<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Citas Model
 *
 * @property \App\Model\Table\UsuariosTable&\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\CalendariosTable&\Cake\ORM\Association\BelongsTo $Calendarios
 *
 * @method \App\Model\Entity\Cita newEmptyEntity()
 * @method \App\Model\Entity\Cita newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Cita[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cita get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cita findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Cita patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cita[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cita|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cita saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Cita[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CitasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('citas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Calendarios', [
            'foreignKey' => 'calendario_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        // dd($validator);
        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDate('fecha');

        $validator
            ->time('hora')
            ->requirePresence('hora', 'create')
            ->notEmptyTime('hora');

        $validator
            ->scalar('nota_profesional')
            ->maxLength('nota_profesional', 255)
            ->allowEmptyString('nota_profesional');

        $validator
            ->scalar('nota_paciente')
            ->maxLength('nota_paciente', 255)
            ->allowEmptyString('nota_paciente');

        $validator
            ->integer('usuario_id')
            ->notEmptyString('usuario_id');

        $validator
            ->integer('calendario_id')
            ->allowEmptyString('calendario_id');

        $validator
            ->dateTime('alta')
            ->allowEmptyDateTime('alta');

        //Añadimos el valor de la fecha al id para buscarlo
        $validator
            ->add('fecha', 'notInCalendarios', [
                'rule' => function ($value, $context) {
                    $calendariosTable = TableRegistry::getTableLocator()->get('Calendarios');
                    $calendario = $calendariosTable->find()->where(['fecha' => $value])->first();
                    return empty($calendario);
                },
                'message' => 'La fecha seleccionada no está establecida como una fecha laboral, por favor, seleccione otra fecha o añadala. %s',
            ]);
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('usuario_id', 'Usuarios'), ['errorField' => 'usuario_id']);
        $rules->add($rules->existsIn('calendario_id', 'Calendarios'), ['errorField' => 'calendario_id']);

        return $rules;
    }
}
