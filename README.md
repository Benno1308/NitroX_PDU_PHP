# NitroX_PDU_PHP
Control the NitroX via PHP/SNMPv1, hacked together in 5 minutes

## Compatibility
Tested with the PDU ST-1021

## Requirements
PHP >= 7.0
SNMP support in PHP
PDU write SNMP community (iirc, default: public)

## Example/Usage
```php
<?php

include 'NitroX_PDU.php';

$pdu = new NitroX_PDU('192.168.18.167', 'private');
var_dump($pdu->getOutletState());
$pdu->setOutletState([false, false]);
```
