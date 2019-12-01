<?php

namespace Drupal\multi_step_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DefaultForm.
 */
class DefaultForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'default_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
	 
	 
	 
	 if ($form_state->has('step_num') && $form_state->get('step_num') ==2) {
		 return self::stepTwoForm($form, $form_state);
	 }
	 
	 
	 $form['description'] = [
      '#type' => 'item',
      '#title' => $this->t('Multistep form (Step 1)'),
    ]; 
    
    $form_state->set('step_num', 1);
    
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#description' => $this->t('Please enter the first name'),
      '#default_value' => $form_state->getValue('first_name', ''),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '1',
      '#required' => TRUE,
    ];
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#description' => $this->t('Please enter the last name'),
      '#default_value' => $form_state->getValue('last_name', ''),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '2',
    ];
    $form['email_address'] = [
      '#type' => 'email',
      '#title' => $this->t('Email Address'),
      '#description' => $this->t('Please enter the valid email'),
      '#default_value' => $form_state->getValue('email_address', ''),
      '#weight' => '3',
      '#required' => TRUE,
    ];

  $form['actions'] = [
      '#type' => 'actions',
    ];

   $form['actions']['next'] = [
		'#type' => 'submit',
		'#value' => t('Next'),
		 '#button_type' => 'primary',
		'#submit' => ['::stepOneFormSubmit'],
		'#validate' => ['::stepOneFormValidate'],
		
   ];


    return $form;
  }
  
  
  public function stepOneFormSubmit(array &$form, FormStateInterface $form_state) {
	  $form_state->set('page_values',[
					'first_name' => $form_state->getValue('first_name'),
					'last_name' => $form_state->getValue('last_name'),
					'email_address' => $form_state->getValue('email_address'),
					]);
		$form_state->set('step_num',2);
		$form_state->setRebuild(TRUE);
 
	}
  
  
  
  /**
   * {@inheritdoc}
   */
  public function stepTwoForm(array &$form, FormStateInterface $form_state) {
	  
	 $form['description'] = [
      '#type' => 'item',
      '#title' => $this->t('Multistep form (Step 2)'),
    ]; 
	  
	$form['date_of_birth'] = [
		  '#type' => 'date',
		  '#title' => $this->t('Date of birth'),
		  '#description' => $this->t('Please select or enter DOB'),
		  '#default_value' => $form_state->getValue('date_of_birth', ''),
		  '#required' => TRUE,
		];
	$form['telephone'] = [
		  '#type' => 'tel',
		  '#title' => $this->t('Telephone'),
		  '#description' => $this->t('Please enter telephone'),
		  '#default_value' => $form_state->getValue('telephone', ''),
		];
		
	$form['back'] = [
      '#type' => 'submit',
      '#value' => $this->t('Back'),
      '#submit' => ['::stepTowFormBack'],
       '#limit_validation_errors' => [],
    ];
		
	$form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
	return $form;
}
  
  
  public function stepTowFormBack(array &$form, FormStateInterface $form_state) {
	   $form_state->setValues($form_state->get('page_values'));
	   $form_state->set('step_num',1);
	   $form_state->setRebuild(TRUE);
	 }
  
  
  
    /**
   * {@inheritdoc}
   */
  public function stepOneFormValidate(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    
    foreach ($form_state->get('page_values') as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
    }
    
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
    }
    
          
  }

}
