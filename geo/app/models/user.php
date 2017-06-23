<?php
class User extends AppModel {

	var $displayField = 'username';
    var $name = 'User';
   
    var $validate = array(
        
		'username' => array(
			'alphaNumeric'=> array(
					'rule' => 'alphaNumeric',
					'message' => 'Τα username μπορεί να περιέχουν γράμματα του αγγλικού αλφαβήτου και αριθμούς.',
			), 
			'unique' => array(
					'rule' => 'isUnique',
					'on' => 'create',				 
					'message' => 'Αυτό το username υπάρχει ήδη.',							   
			),
		 ),
		 'password_confirm1' => array(
			 'between' => array(
					'rule' => array('between', 5, 12),
					'message' => 'Το μήκος του password μπορεί να είναι από 5 έως 12 χαρακτήρες.',
					'required' => true
					),	

		 ),
		 'password_confirm2' => array(
		 	  'between'=> array(
					'rule' => array('between', 5, 12),
					'message' =>'Το μήκος του password μπορεί να είναι από 5 έως 12 χαρακτήρες.',
					'required' => true
					),	
		 ), 
    );
	
	
	var $validate_edit = array(
		'username' => array(
			'alphaNumeric'=> array(
					'rule' => 'alphaNumeric',
					'message' => 'Τα username μπορεί να περιέχουν γράμματα του αγγλικού αλφαβήτου και αριθμούς.',
			), 
			'unique' => array(
					'rule' => 'isUnique',
					'on' => 'create',				 
					'message' => 'Αυτό το username υπάρχει ήδη.',							   
			),
		 ),
		 'password_confirm1' => array(
			 'between' => array(
					'rule' => array('between', 5, 12),
					'message' => 'Το μήκος του password μπορεί να είναι από 5 έως 12 χαρακτήρες.',
					'required' => false,
					'allowEmpty' => true
					),	

		 ),
		 'password_confirm2' => array(
		 	  'between'=> array(
					'rule' => array('between', 5, 12),
					'message' =>'Το μήκος του password μπορεί να είναι από 5 έως 12 χαρακτήρες.',
					'required' => false,
					'allowEmpty' => true
					),	
		 ), 
	);
	
	var $validate_change_pwd = array(
		 'password_confirm1' => array(
			 'between' => array(
					'rule' => array('between', 5, 12),
					'message' => 'Το μήκος του password μπορεί να είναι από 5 έως 12 χαρακτήρες.',
					'required' => true,
					'allowEmpty' => false
					),	

		 ),
		 'password_confirm2' => array(
		 	  'between'=> array(
					'rule' => array('between', 5, 12),
					'message' =>'Το μήκος του password μπορεί να είναι από 5 έως 12 χαρακτήρες.',
					'required' => true,
					'allowEmpty' => false
					),	
		 ), 
	);
   
    var $hasAndBelongsToMany = array(
            'Role' => array('className' => 'Role',
                        'joinTable' => 'roles_users',
                        'foreignKey' => 'user_id',
                        'associationForeignKey' => 'role_id',
                        'unique' => true
            )
    );
	
	
	var $hasMany = array(
					 'Sample' => array(
						 'className' => 'Sample',
						 'foreignKey' => 'user_id',
						 'dependent'=> false)
	); 

	
	function generateList(){
	
		$userList = $this->find('all', 
			array('fields' => array('id', 'username',),'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $userList,
			'{n}.User.id',
			 array('%s', '{n}.User.username')
	    ); 
		
		return $list;
	
	}
}
?>