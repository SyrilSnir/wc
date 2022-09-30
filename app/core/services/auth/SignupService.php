<?php

namespace app\core\services\auth;

use app\core\repositories\manage\Users\UserRepository;
use app\core\services\mail\MailService;
use app\models\ActiveRecord\Users\User;
use app\models\Forms\User\SignupForm;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/**
 * Description of SignupService
 *
 * @author kotov
 */
class SignupService
{
    /**
     * 
     * @var UserRepository
     */
    private $repository;
    
    /**
     * 
     * @var MailService
     */
    private $mailService;


    public function __construct(UserRepository $repository, MailService $mailService)
    {
        $this->repository = $repository;
        $this->mailService = $mailService;
    }
    
    public function signup(SignupForm $form) :User
    {
        $user = User::signup($form);
        $this->repository->save($user);
        $this->sendInviteNotificationMail($user, 'link');
        return $user;
    }
    
    /**
     * 
     * @param User $user
     * @param string $link
     * @param string $email
     * @return bool
     */
    public function sendInviteNotificationMail(User $user):bool
    {
        $this->mailService->compose([
            'html' => 'invite-html',
            'text' => 'invite-text',
        ],[
            'siteUrl' => Url::toRoute(['/'],true),            
            'link' => $this->getActivateLink($user),
            'email' => $user->email,
        ])->setTo($user->email)->setSubject("ХОЧУ / МОГУ. Портал возможностей! Добро пожаловать {$user->fio}")->send();        
        return true;
    }   
    
    public function getActivateLink(User $user): string
    {
        if (!$user->auth_key) {
            $user->setAuthKey();
            $this->users->save($user);
        }
        $token = StringHelper::base64UrlEncode( $user->auth_key );
        return Url::toRoute(['/activate', 'token' => $token], true);
    }    
}
