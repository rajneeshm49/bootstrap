<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Issues Model
 *
 */
class IssueCommentsTable extends Table
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

        $this->table('issue_comments');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasOne('IssueFiles', [
        		'className' => 'IssueFiles',
        		'foreignKey' => 'issue_comment_id',
        		'dependent' => true
        ]);
    }
}