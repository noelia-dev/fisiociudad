<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id_user
 * @property string|null $password
 * @property string|null $correo
 * @property string|null $telefono
 * @property string|null $nombre
 * @property string|null $apellidos
 * @property bool|null $es_admin
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'password' => true,
        'correo' => true,
        'telefono' => true,
        'nombre' => true,
        'apellidos' => true,
        'es_admin' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];
    
    /**
     * Hashage de password.
     * Será llamado automáticamente para crea una password al crear un usuario
     */

    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($value);
        }
    }
}
