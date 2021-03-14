<?php
namespace Drupal\firstevent\CustomEvent;

use Symfony\Component\EventDispatcher\Event;

/**
* Class EntityTypeSubscriber.
*
* @package Drupal\custom_events\EventSubscriber
*/
class CustomEventForm extends Event {
    const EVENT_NAME = 'custom_event_form';

    public $form;

    public function __construct($name, $number, $mail, $city)
    {
        \Drupal::messenger()->addMessage('Event is called means our dispatcher is working');
        $this->name = $name;
        $this->number = $number;
        $this->mail = $mail;
        $this->city = $city;
    }
    public function getName(){
        return $this->name;
    }
    public function getNumber(){
        return $this->number;
    }
    public function getMail(){
        return $this->mail;
    }
    public function getCity(){
        return $this->city;
    }
}