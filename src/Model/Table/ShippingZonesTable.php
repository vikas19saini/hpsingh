<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ShippingZones Model
 *
 * @method \App\Model\Entity\ShippingZone get($primaryKey, $options = [])
 * @method \App\Model\Entity\ShippingZone newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ShippingZone[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ShippingZone|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ShippingZone|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ShippingZone patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ShippingZone[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ShippingZone findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShippingZonesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('shipping_zones');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->integer('postcode')
            ->requirePresence('postcode', 'create')
            ->notEmpty('postcode')
            ->add('postcode', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('cod')
            ->maxLength('cod', 3)
            ->requirePresence('cod', 'create')
            ->notEmpty('cod');

        $validator
            ->scalar('availability')
            ->maxLength('availability', 3)
            ->requirePresence('availability', 'create')
            ->notEmpty('availability');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['postcode']));

        return $rules;
    }
}
