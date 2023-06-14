<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuarios Model
 *
 * @property \App\Model\Table\CitasTable&\Cake\ORM\Association\HasMany $Citas
 *
 * @method \App\Model\Entity\Usuario newEmptyEntity()
 * @method \App\Model\Entity\Usuario newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class UsuariosTable extends Table
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

        $this->setTable('usuarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Citas', [
            'foreignKey' => 'usuario_id',
            'dependent' => true, 
            'cascadeCallbacks' => true,
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
            ->scalar('password')
            ->maxLength('password', 255)
            ->allowEmptyString('password');

        $validator
            ->scalar('correo')
            ->maxLength('correo', 45)
            ->allowEmptyString('correo');
        
        $validator
            ->email('correo', true, 'Ingrese un correo electrónico válido')
            ->requirePresence('correo', 'create', 'Ingrese un correo electrónico')
            ->notEmptyString('correo', 'Ingrese un correo electrónico');;

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 45)
            ->allowEmptyString('telefono');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 45)
            ->allowEmptyString('nombre');

        $validator
            ->scalar('apellidos')
            ->maxLength('apellidos', 45)
            ->allowEmptyString('apellidos');

        $validator
            ->boolean('es_admin')
            ->allowEmptyString('es_admin');

        $validator
            ->dateTime('alta')
            ->allowEmptyDateTime('alta');

        $validator
            ->dateTime('modificado')
            ->allowEmptyDateTime('modificado');

        $validator
            ->dateTime('eliminado')
            ->allowEmptyDateTime('eliminado');

        $validator
            ->scalar('reset_token')
            ->maxLength('reset_token', 255)
            ->allowEmptyString('reset_token');

        $validator
            ->dateTime('caducidad_token')
            ->allowEmptyDateTime('caducidad_token');

        return $validator;
    }
}
