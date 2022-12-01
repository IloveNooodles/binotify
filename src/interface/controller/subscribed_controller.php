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
        case "POST":
            if(empty($_POST['creator_id']) || empty($_POST['subscriber_id'])){
              return DATA_NOT_COMPLETE;
            }

            if($_POST['subscriber_id'] < 0){
              return INVALID_SUBSCRIBER_ID;
            }

            if($_POST['creator_id'] < 0){
              return INVALID_CREATOR_ID;
            }

            $subscription_service = new SubscriptionService();
            $res = $subscription_service->subscribe($_POST['creator_id'], $_POST['subscriber_id']);
            return $res;
            break;
        default:
            response_not_allowed_method();
            return;
            break;
      }
    }

    public function update(){
      switch($_SERVER['REQUEST_METHOD']){
        case "POST":
            if(empty($_POST['creator_id']) || empty($_POST['subscriber_id']) || empty($_POST['status'])){
              return DATA_NOT_COMPLETE;
            }

            if($_POST['subscriber_id'] < 0){
              return INVALID_SUBSCRIBER_ID;
            }

            if($_POST['creator_id'] < 0){
              return INVALID_CREATOR_ID;
            }

            if(!in_array($_POST['status'], ["ACCEPTED", "REJECTED"])){
              return INVALID_STATUS;
            }

            $subscription_service = new SubscriptionService();
            $res = $subscription_service->updateSubscription($_POST['creator_id'], $_POST['subscriber_id'], $_POST['status']);
            return $res;
            break;
        default:
            response_not_allowed_method();
            return;
            break;
      }
    }

    public function callback(){
      try {
        $headers = array(
          "http" => array(
            "header" => "x-api-key: " . SOAP_API_KEY
          )
        );
        $client = new SoapClient("http://host.docker.internal:9000/api/subscription?wsdl", array (
          'stream_context' => stream_context_create($headers)
        ));
        $res = $client->__soapCall("subscribe", array(
            "SubscriptionData" => array(
            "creator_id" => 0,
            "subscriber_id" => 10,
            "status" => "PENDING",
          )
        ));
        echo json_encode($res);
      } catch (Exception $e) {
        echo json_encode($e);
      }
    }
}