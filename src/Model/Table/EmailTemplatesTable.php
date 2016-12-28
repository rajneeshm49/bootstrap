<?php
namespace App\Model\Table;

use App\Model\Entity\EmailTemplate;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EmailTemplates Model
 *
 */
class EmailTemplatesTable extends Table
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

        $this->table('email_templates');
        $this->displayField('id');
        $this->primaryKey('id');

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
            ->requirePresence('email_type', 'create')
            ->notEmpty('email_type');

        $validator
            ->requirePresence('subject', 'create')
            ->notEmpty('subject');

        $validator
            ->requirePresence('message', 'create')
            ->notEmpty('message');

        $validator
            ->requirePresence('email_from', 'create')
            ->notEmpty('email_from')
            ->add('email_from', 'validFormat', [
	        		'rule' => 'email',
	        		'message' => 'E-mail must be valid'
	        ]);

        $validator
            ->requirePresence('email_from_name', 'create')
            ->notEmpty('email_from_name');

//         $validator
//         	->requirePresence('email_bcc', 'create')
//             ->notEmpty('email_bcc')
//             ->add('email_bcc', 'validFormat', [
//             		'rule' => 'email',
//             		'message' => 'BCC E-mail must be valid'
//             ]);
        
        return $validator;
    }
}
