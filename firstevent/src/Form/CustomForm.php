<?php
namespace Drupal\firstevent\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\firstevent\CustomEvent\CustomEventForm;

class CustomForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'custom_form';
    }
  
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
  
        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => t('Candidate Name:'),
            '#required' => TRUE,
        );

        $form['number'] = array (
            '#type' => 'tel',
            '#title' => t('Mobile no'),
            '#required' => TRUE,
        );
  
        $form['mail'] = array(
            '#type' => 'email',
            '#title' => t('Email ID:'),
            '#required' => TRUE,
        );
  
        $form['city'] = array (
            '#type' => 'textfield',
            '#title' => t('City'),
            '#required' => TRUE,
        );
  
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Save'),
            '#button_type' => 'primary',
        );
        return $form;
    }
  
    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        if (strlen($form_state->getValue('number')) < 10) {
            $form_state->setErrorByName('number', $this->t('Mobile number is too short.'));
        }
    }
  
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $name = $form_state->getValue('name');
        $number = $form_state->getValue('number');
        $mail = $form_state->getValue('mail');
        $city = $form_state->getValue('city');
        
        $event = new CustomEventForm($name, $number, $mail, $city);
        $event_dispatcher = \Drupal::service('event_dispatcher');

        $event_dispatcher->dispatch(CustomEventForm::EVENT_NAME, $event);
          
        /*foreach ($form_state->getValues() as $key => $value) {
            print_r($key . ': ' . $value);
          }
          die;*/
          \Drupal::messenger()->addMessage('Data saved Successfully');
     }
  }