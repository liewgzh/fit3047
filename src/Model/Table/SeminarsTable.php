<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Seminars Model
 *
 * @method \App\Model\Entity\Seminar newEmptyEntity()
 * @method \App\Model\Entity\Seminar newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Seminar> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Seminar get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Seminar findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Seminar patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Seminar> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Seminar|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Seminar saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Seminar>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Seminar>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Seminar>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Seminar> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Seminar>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Seminar>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Seminar>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Seminar> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SeminarsTable extends Table
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

        $this->setTable('seminars');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->date('date')
            ->allowEmptyDate('date');

        $validator
            ->time('time')
            ->allowEmptyTime('time');

        $validator
            ->scalar('video_path')
            ->maxLength('video_path', 255)
            ->allowEmptyString('video_path')
            ->add('video_path', 'fileSize', [
                'rule' => ['fileSize', '<=', '200MB'],
                'message' => 'The video must be less than or equal to 200MB.'
            ])
            ->add('video_path', 'fileType', [
                'rule' => ['mimeType', ['video/mp4', 'video/avi']],
                'message' => 'Please upload a valid video (mp4, avi).'
            ]);

        return $validator;
    }
}
