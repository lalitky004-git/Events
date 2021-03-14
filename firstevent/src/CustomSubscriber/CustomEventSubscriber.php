<?php
namespace Drupal\firstevent\CustomSubscriber;

use Drupal\firstevent\CustomEvent\CustomEventForm;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use \Drupal\user\Entity\User;

class CustomEventSubscriber implements EventSubscriberInterface{
    public static function getSubscribedEvents(){
        return[
            CustomEventForm::EVENT_NAME => 'geteMail',
        ];
    }

    public function geteMail(CustomEventForm $event){
        $user = User::load(\Drupal::currentUser()->id());
        $email = $user->get('mail')->value;
        \Drupal::messenger()->addStatus(t("Current user's email is: %email", ['%email' => $email]));
    }
}