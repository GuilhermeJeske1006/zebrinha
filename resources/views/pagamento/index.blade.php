
<?php
include_once("../PagSeguroLibrary/PagSeguroLibrary.php");
$notificationCode = $_POST['notificationCode'];

try {

    $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()
    $response = PagSeguroNotificationService::checkTransaction(
        $credentials,
        $notificationCode
    );

    $reference = $response->getReference();
    $status = $response->getStatus()->getTypeFromValue();
    //WAITING_PAYMENT-PAID-AVAILABLE-IN_DISPUTE-CANCELLED-REFUNDED
    switch($status){
        case "WAITING_PAYMENT":
            echo "aguargando";
            break;

        case "PAID":
            echo 'p';
            break;

        case "AVAILABLE":
            echo 'A';
            break;

        case "IN_DISPUTE":
            echo 'I';
            break;

        case "CANCELLED":
            echo 'C';
            break;

        case "REFUNDED":
            echo 'R';
            break;

    }

} catch (PagSeguroServiceException $e) {
    die($e->getMessage());
}
