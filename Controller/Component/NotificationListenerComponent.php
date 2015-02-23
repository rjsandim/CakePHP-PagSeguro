<?php


App::uses('Component', 'Controller');

class NotificationListenerComponent extends Component {

    public function transaction($user, $token, $code, $type) {

        if ($code && $type) {

            $notificationType = new PagSeguroNotificationType($type);
            $strType = $notificationType->getTypeFromValue();

            switch ($strType) {

                case 'TRANSACTION':
                    return self::transactionNotification($code, $user, $token);
                    break;

                default:
                    LogPagSeguro::error("Unknown notification type [" . $notificationType->getValue() . "]");

            }
        } else {

            LogPagSeguro::error("Invalid notification parameters.");
            self::printLog();
        }

    }

    private static function transactionNotification($notificationCode, $user, $token)
    {

        $credentials = new PagSeguroAccountCredentials($user, $token);

        try {
            return PagSeguroNotificationService::checkTransaction($credentials, $notificationCode);
           
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }

    }
}

