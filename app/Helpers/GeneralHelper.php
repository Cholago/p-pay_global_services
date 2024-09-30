<?php

function formatPhoneNumber($phoneNumber) {
    // Remove non-numeric characters
    $numericPhoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
    // Remove leading plus sign if present
    if (strpos($numericPhoneNumber, '+') === 0) {
        $numericPhoneNumber = substr($numericPhoneNumber, 1);
    }
    return $numericPhoneNumber;
}