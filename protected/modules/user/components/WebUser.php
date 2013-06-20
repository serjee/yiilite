<?php

class WebUser extends CWebUser
{
    private $_model = null;
    
    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params=array())
    {
        if (empty($this->id))
        {
            // Not identified => no rights
            return false;
        }
        
        $role = $this->getRole();
        if ($role === 'ADMIN')
        {
            return true; // admin role has access to everything
        }
        
        if (strstr($operation,$role) !== false)
        { // Check if multiple roles are available
            return true;
        }
        
        // allow access if the operation request is the current user's role
        return ($operation === $role);
    }
    
    private function getRole()
    {
        if($user = $this->getModel())
        {
            // get Value role from User table
            return $user->role;
        }
    }
 
    private function getModel()
    {
        if (!$this->isGuest && $this->_model === null)
        {
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }
}