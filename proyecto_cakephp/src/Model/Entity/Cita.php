<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cita Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $fecha
 * @property \Cake\I18n\Time $hora
 * @property string|null $nota_profesional
 * @property string|null $nota_paciente
 * @property int|null $usuario_id
 * @property int|null $calendario_id
 * @property \Cake\I18n\FrozenTime|null $alta
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Calendario $calendario
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
        'fecha' => true,
        'hora' => true,
        'nota_profesional' => true,
        'nota_paciente' => true,
        'usuario_id' => true,
        'calendario_id' => true,
        'alta' => true,
        'usuario' => true,
        'calendario' => true,
    ];
}
