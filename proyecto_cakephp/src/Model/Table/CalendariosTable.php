<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Calendarios Model
 *
 * @property \App\Model\Table\CitasTable&\Cake\ORM\Association\HasMany $Citas
 *
 * @method \App\Model\Entity\Calendario newEmptyEntity()
 * @method \App\Model\Entity\Calendario newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Calendario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Calendario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Calendario findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Calendario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Calendario[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Calendario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Calendario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Calendario[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Calendario[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Calendario[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Calendario[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CalendariosTable extends Table
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

        $this->setTable('calendarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Citas', [
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
        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 45)
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('fecha')
            ->maxLength('fecha', 45)
            ->requirePresence('fecha', 'create')
            ->notEmptyString('fecha')
            ->add('fecha', 'unique', ['rule' => 'validateUnique', 'provider' => 'table',
                'message' => 'La fecha seleccionada ya se encuentra en el calendario.']
        );

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
        $rules->add($rules->isUnique(['fecha']), ['errorField' => 'fecha']);

        return $rules;
    }
}
