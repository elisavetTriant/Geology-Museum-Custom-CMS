<?php
class Role extends AppModel {

	var $name = 'Role';
	
    var $hasAndBelongsToMany = array(
            'Permission' => array('className' => 'Permission',
                        'joinTable' => 'permissions_roles',
                        'foreignKey' => 'role_id',
                        'associationForeignKey' => 'permission_id',
                        'unique' => true
            ),
            'User' => array('className' => 'User',
                        'joinTable' => 'roles_users',
                        'foreignKey' => 'role_id',
                        'associationForeignKey' => 'user_id',
                        'unique' => true
            )
    );
	
	var $validate = array(
		'name' => array('rule' => array('minLength', 1) ),
		
	);
	
	function generateList(){
	
		$rolesList = $this->find('all', 
			array('fields' => array('id', 'name') , 'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $rolesList,
			'{n}.Role.id',
			 array('%s', '{n}.Role.name')
	    ); 
		
		return $list;
	
	}
	

}
?>