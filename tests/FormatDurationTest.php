<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class FormatDurationTest extends TestCase
{
    public function test_throws_exception_given_negative_duration()
    {
        $this->expectException(\InvalidArgumentException::class);
        formatDuration(durationInSeconds: -4);
    }

    public function test_throws_exception_given_float_duration()
    {
        $this->expectException(\InvalidArgumentException::class);
        formatDuration(durationInSeconds: 4.5);
    }

    public function test_throws_error_given_bool_duration()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->assertNotSame('now', formatDuration(durationInSeconds: false));
        $this->assertNotSame('1 second', formatDuration(durationInSeconds: true));
    }

    public function test_returns_now_given_zero_duration()
    {
        $this->assertSame('now', formatDuration(durationInSeconds: 0));
    }

    public function test_homework_example_62_seconds()
    {
        $this->assertSame('1 minute and 2 seconds', formatDuration(durationInSeconds: 62));
    }

    public function test_homework_example_3662_seconds()
    {
        $this->assertSame('1 hour, 1 minute and 2 seconds', formatDuration(durationInSeconds: 3662));
    }

    public function test_convert_2356789_seconds()
    {
        $this->assertSame('27 days, 6 hours, 39 minutes and 49 seconds', formatDuration(durationInSeconds: 2356789));
    }

    public function test_convert_650_seconds()
    {
        $this->assertSame('10 minutes and 50 seconds', formatDuration(durationInSeconds: 650));
    }

    public function test_conversion_of_220752000_seconds()
    {
        $this->assertSame('7 years', formatDuration(durationInSeconds: 220752000));
    }

    public function test_conversion_of_220752050_seconds()
    {
        $this->assertSame('7 years and 50 seconds', formatDuration(durationInSeconds: 220752050));
    }

    public function test_conversion_of_90000_seconds()
    {
        $this->assertSame('1 day and 1 hour', formatDuration(durationInSeconds: 90000));
    }

    public function test_conversion_of_31449600_seconds()
    {
        $this->assertSame('364 days', formatDuration(durationInSeconds: 31449600));
    }

    public function test_conversion_of_31622400_seconds()
    {
        $this->assertSame('1 year and 1 day', formatDuration(durationInSeconds: 31622400));
    }
}
