<?php

namespace app\core\services\auth;

/**
 * Description of RoleManager
 *
 * @author kotov
 */
class RoleManager
{
    /**
     *
     * @var ManagerInterface
     */
    private $authManager;
    
    public function __construct(ManagerInterface $authManager)
    {
        $this->authManager = $authManager;
    }
    
    /**
     * 
     * @param string $role
     * @param int $userId
     * @return void
     */
    public function setRole(string $role, int $userId):void
    {
        $roleInstance = $this->authManager->getRole($role);
        $this->authManager->assign($roleInstance, $userId);
    }
    
    public function revokeRoles(int $userId)    
    {
        $this->authManager->revokeAll($userId);
    }
}
