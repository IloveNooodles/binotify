<?php
require_once BASE_URL . '/src/middleware/middleware.php';
require_once BASE_URL . '/src/service/subscription/index.php';
class Subscribed extends Controller {
    public function index() {
      switch($_SERVER['REQUEST_METHOD']){
        case "GET":
          $middleware = new Middleware();
          $is_logged_in = $middleware->is_logged_in();
          $is_admin = $middleware->can_access_admin_page();
          if (!$is_logged_in || $is_admin) {
              redirect_home();
              return;
          }
          $this->view("subscribed/index");
          return;
          break;

        // Ini callback buat subscribe
        case "POST":
            $API_KEY = $_SERVER['HTTP_X_API_KEY'];
            if (!isset($API_KEY) && $API_KEY !== SOAP_API_KEY) {
                response_json(NOT_AUTHENTICATED);
                return;
            }
            
            if(!isset($_POST['creator_id']) || !isset($_POST['subscriber_id'])){
              response_json(DATA_NOT_COMPLETE);
              return ;
            }

            if($_POST['subscriber_id'] < 0){
              response_json(INVALID_SUBSCRIBER_ID);
              return ;
            }

            if($_POST['creator_id'] < 0){
              response_json(INVALID_CREATOR_ID);
              return;
            }

            $subscription_service = new SubscriptionService();
            $res = $subscription_service->subscribe($_POST['creator_id'], $_POST['subscriber_id']);
            
            if($res == INTERNAL_ERROR){
              response_json($res, 500);
              return;
            }

            response_json($res);
            return;
            break;
        default:
            response_not_allowed_method();
            return;
            break;
      }
    }

    // ini callback buat update
    public function update(){
      switch($_SERVER['REQUEST_METHOD']){
        case "POST":
    
            $API_KEY = $_SERVER['HTTP_X_API_KEY'];
            if (!isset($API_KEY) && $API_KEY !== SOAP_API_KEY) {
                response_json(NOT_AUTHENTICATED);
                return;
            }
            
            if(!isset($_POST['creator_id']) || !isset($_POST['subscriber_id']) || !isset($_POST['status'])){
              response_json(DATA_NOT_COMPLETE);
              return;
            }

            if($_POST['subscriber_id'] < 0){
              response_json(INVALID_SUBSCRIBER_ID);
              return;
            }

            if($_POST['creator_id'] < 0){
              response_json(INVALID_CREATOR_ID);
              return;
            }

            if(!in_array($_POST['status'], ["ACCEPTED", "REJECTED"])){
              response_json(INVALID_STATUS);
              return;
            }

            $subscription_service = new SubscriptionService();
            $res = $subscription_service->updateSubscription($_POST['creator_id'], $_POST['subscriber_id'], $_POST['status']);
            response_json($res);
            return;
            break;
        default:
            response_not_allowed_method();
            return;
            break;
      }
    }

    // ini subscribe
    public function subscribe(){
      switch($_SERVER['REQUEST_METHOD']){
        case "POST":
  
            $middleware = new Middleware();
            $is_logged_in = $middleware->is_logged_in();
            if (!$is_logged_in) {
                redirect_home();
                return;
            }

            
            if(!isset($_POST['creator_id'])){
               response_json(DATA_NOT_COMPLETE);
               return;
            }

            if($_POST['creator_id'] < 0){
              response_json(INVALID_CREATOR_ID);
              return;
            }

            try {
              $headers = array(
                "http" => array(
                  "header" => "x-api-key: " . SOAP_API_KEY
                )
              );

              $soap_client = new SoapClient("http://host.docker.internal:9000/api/subscription?wsdl", array (
                'stream_context' => stream_context_create($headers)
              ));

              $res = $soap_client->__soapCall("subscribe", array(
                  "SubscriptionData" => array(
                  "creator_id" => $_POST['creator_id'],
                  "subscriber_id" => $_SESSION['user_id'],
                  "status" => "PENDING",
                )
              ));

              response_json($res);
              return;

            } catch (Exception $e) {
              return response_json(INTERNAL_ERROR);

            }

        default:
            response_not_allowed_method();
            return;
            break;
      }
    }
}