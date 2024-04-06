<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Counsellors Model
 *
 * @property \App\Model\Table\AppointmentsTable&\Cake\ORM\Association\HasMany $Appointments
 *
 * @method \App\Model\Entity\Counsellor newEmptyEntity()
 * @method \App\Model\Entity\Counsellor newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Counsellor> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Counsellor get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Counsellor findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Counsellor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Counsellor> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Counsellor|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Counsellor saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Counsellor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Counsellor>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Counsellor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Counsellor> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Counsellor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Counsellor>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Counsellor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Counsellor> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CounsellorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('counsellors');
        $this->setDisplayField('email');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Appointments', [
            'foreignKey' => 'counsellor_id',
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
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 128)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 128)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->scalar('gender')
            ->maxLength('gender', 1)
            ->requirePresence('gender', 'create')
            ->notEmptyString('gender');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        return $validator;
    }
}
