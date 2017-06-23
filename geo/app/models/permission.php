<?php
class Permission extends AppModel {
    var $name = 'Permission';
    var $hasAndBelongsToMany = array(
            'Role' => array('className' => 'Role',
                        'joinTable' => 'permissions_roles',
                        'foreignKey' => 'permission_id',
                        'associationForeignKey' => 'role_id',
                        'unique' => true
            )
    );
	
	
	var $validate = array(
		'name' => array('rule' => array('minLength', 1) ),
		
	);
	
	function generateList(){
	
		$permissionList = $this->find('all', 
			array('fields' => array('id', 'name', 'desc') , 'recursive' =>-1)
	     );
	     
		 $list = Set::combine(
			 $permissionList,
			'{n}.Permission.id',
			 array('%s (%s)', '{n}.Permission.desc', '{n}.Permission.name')
	    ); 
		
		return $list;
	
	}
}
?>