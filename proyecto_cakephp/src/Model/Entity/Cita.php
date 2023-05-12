<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cita Entity
 *
 * @property int $id_cita
 * @property \Cake\I18n\FrozenDate $fecha
 * @property \Cake\I18n\Time $hora
 * @property string|null $nota_profesional
 * @property string|null $nota_paciente
 * @property int|null $id_usuario
 */
class Cita extends Entity
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
        'id_cita' => true,
        'fecha' => true,
        'hora' => true,
        'nota_profesional' => true,
        'nota_paciente' => true,
        'id_usuario' => true,
    ];
}
