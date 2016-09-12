<?php

class DateTimeView
{

    /**
     * Shows a formatted server time string
     */
    public function show() {
        return '<p>' . $this->generateServerTimeString() . '</p>';
    }

    /**
     * Gets a formatted server time string
     * Format: Sunday, the 11th of September 2016, The time is 07:06:52
     */
    private function generateServerTimeString() {
        date_default_timezone_set("Europe/Stockholm");

        return date('l, \t\h\e d\t\h \o\f F Y, \T\h\e \t\i\m\e \i\s H:i:s');
    }
}