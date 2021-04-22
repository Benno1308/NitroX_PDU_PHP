<?php
class NitroX_PDU
{
    private $deviceIP;
    private $deviceCommunity;

    private $outletOID = '.1.3.6.1.4.1.17420.1.2.9.1.13.0';

    public function __construct($deviceIP, $deviceCommunity)
    {
        $this->deviceIP = $deviceIP;
        $this->deviceCommunity = $deviceCommunity;
    }

    // Taken from SnmpProtocol.dll, setBankPlugOnOff
    private function buildStateString(array $states): string
    {
        $stateString = implode(',', array_map(function($v){return (int)$v;}, $states));
        $stateString .= ',';
        $stateString .= str_repeat('-1,', 8 - count($states)); // 8 hardcoded "states" in the SNMP Set

        return rtrim($stateString, ',');
    }

    public function setOutletState(array $stateArray): bool
    {
        return snmpset($this->deviceIP, $this->deviceCommunity, $this->outletOID, 's', $this->buildStateString($stateArray));
    }

    public function getOutletState(): array
    {
        $deviceStateString = snmpget($this->deviceIP, $this->deviceCommunity, $this->outletOID);
        $deviceState = trim(str_replace('STRING: ', '', $deviceStateString), '"');

        $stateArray = explode(',', $deviceState);

        return array_map(function($v){return (int)$v == 1;}, $stateArray);
    }
}
