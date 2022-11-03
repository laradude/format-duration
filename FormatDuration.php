<?php

//declare(strict_types=1);

if (!function_exists('formatDuration')) {
    /**
     * Formats a duration given in seconds to a string literal
     *
     * @param int $durationInSeconds The seconds to format
     * @throws InvalidArgumentException If the given argument is a negative integer
     * @return string The human-friendly duration expressed in year(s), day(s), hour(s), minute(s), and second(s)
     */
    function formatDuration($durationInSeconds): string
    {

        if (0 > $durationInSeconds || !is_int($durationInSeconds)) {
            throw new \InvalidArgumentException('formatDuration expects a non-negative integer');
        }

        if (0 === $durationInSeconds) {
            return 'now';
        }

        /**
         * @var int[] The units of time
         */
        $components = [];

        /**
         * @var int[] Number of seconds in year, day, hour and minute
         */
        $secondsPer = [
            'year' => 31536000,
            'day' => 86400,
            'hour' => 3600,
            'minute' => 60,
            'second' => 1,
        ];

        foreach ($secondsPer as $period => $secondsInPeriod)
        {
            $numPeriods = floor($durationInSeconds / $secondsInPeriod);
            $durationInSeconds %= $secondsInPeriod;

            if ($numPeriods > 0) {
                $period = $numPeriods > 1 ? $period . 's' : $period;
                $components[] = $numPeriods . ' ' . $period;
            }
        }
        /**
         * @var int The number of components in the resulting human-friendly expression
         */
        $numComponents = count($components);

        return match(true) {
            $numComponents === 1 => $components[0],
            $numComponents === 2 => implode(' and ', $components),
            $numComponents > 2 => (static function() use ($components){
                $lastComponent = array_pop($components);
                return implode(', ', $components) . ' and ' . $lastComponent;
            })(),
            default => '',
        };
    }
}
