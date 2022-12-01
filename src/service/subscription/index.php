<?php

require_once BASE_URL . '/src/interface/model/subscription.php';

class SubscriptionService {
    public function get_all_subscription(){
        $subscription_model = new SubscriptionModel();

        $data = $subscription_model->get_all_subscription();
        return $data;
    }

    public function get_subscription_by_subscriber_id($subscriber_id){
        $subscription_model = new SubscriptionModel();

        $data = $subscription_model->get_all_subscription_by_subscriber_id($subscriber_id);
        return $data;
    }

    public function get_subscription_by_id($creator_id, $subscriber_id){
        $subscription_model = new SubscriptionModel();

        $data = $subscription_model->get_subscription_by_id($creator_id, $subscriber_id);
        return $data;
    }

    public function subscribe($creator_id, $subscriber_id){
        $subscription_model = new SubscriptionModel();
        
        try {
          $subscription = $subscription_model->get_subscription_by_id($creator_id, $subscriber_id);
          
          if(isset($subscription)){
            return SUBSCRIPTION_ALREADY_EXISTS;
          }

          $subscription_model->insert_subscription($creator_id, $subscriber_id);
          return SUBSCRIPTION_SUCCESSFULY_CREATED;

        } catch (Exception $e){
          return INTERNAL_ERROR;
        }
    }

    public function updateSubscription($creator_id, $subscriber_id, $status){
        $subscription_model = new SubscriptionModel();
        try {
           $subscription = $subscription_model->get_subscription_by_id($creator_id, $subscriber_id);

          if(!isset($subscription)){
            return SUBSCRIPTION_NOT_FOUND;
          }

          $current_status = $subscription['status'];

          if($current_status === 'REJECTED'){
            return SUBSCRIPTION_ALREADY_REJECTED;
          }

          if($current_status === 'ACCEPTED'){
            return SUBSCRIPTION_ALREADY_ACCEPTED;
          }

          $subscription_model->update_subscription($creator_id, $subscriber_id, $status);

          if($status === 'ACCEPTED'){
            return SUBSCRIPTION_ACCEPTED;
          }

          if($status === 'REJECTED'){
            return SUBSCRIPTION_REJECTED;
          }
          
        } catch (Exception $e){
          return INTERNAL_ERROR;
        }
    }
}