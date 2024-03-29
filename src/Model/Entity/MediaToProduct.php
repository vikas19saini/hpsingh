<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MediaToProduct Entity
 *
 * @property int $id
 * @property int $media_id
 * @property int $product_id
 * @property string $type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Media $media
 * @property \App\Model\Entity\Product $product
 */
class MediaToProduct extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'media_id' => true,
        'product_id' => true,
        'type' => true,
        'created' => true,
        'modified' => true,
        'media' => true,
        'product' => true,
    ];
}
