# NitroX_PDU_PHP

## Example/Usage
```php
<?php

include 'NitroX_PDU.php';

$pdu = new NitroX_PDU('192.168.18.167', 'private');
var_dump($pdu->getOutletState());
$pdu->setOutletState([false, false]);
```
