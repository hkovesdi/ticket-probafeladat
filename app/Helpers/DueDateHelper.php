<?php

namespace App\Helpers;

use Carbon\CarbonInterface;
use DateInterval;
use Illuminate\Support\Carbon;

class DueDateHelper 
{
    private $submitDate;
    private $workTimes;
    private $maxResponseTime;

    /**
     * Constructs a new DueDateHelper class
     * @param string $maxResponseTime The maximum response time in HH:MM:SS format
     * @param array $workTimes The work times of a given week in HH:MM:SS-HH:MM:SS format or null
     * if a given day is not a workday, where the first element represents Monday and the seventh element represents Sunday
     * @param CarbonInterface $submitDate The date from where the due date will be calculated
     */
    function __construct(string $maxResponseTime, array $workTimes, CarbonInterface $submitDate = NULL) 
    {
        $this->submitDate = $submitDate ?? Carbon::now()->milliseconds(0);
        $this->maxResponseTime = $maxResponseTime;
        $this->workTimes = $this->parseWorkTimes($workTimes);
    }

    /**
     * Convert the time from string to DateInterval
     * @param string $time The time in HH:MM:SS format
     * @return DateInterval
     */
    private function timeToDateInterval(string $time) 
    {
        $timeSplit = explode(':', $time);
        $hours = $timeSplit[0];
        $minutes = $timeSplit[1];
        $seconds = $timeSplit[2];

        return new DateInterval("PT{$hours}H{$minutes}M{$seconds}S");
    }

    /**
     * Parses the work times of the week into DateIntervals
     * @param array $workTimes
     * @return array
     */
    private function parseWorkTimes(array $workTimes) 
    {
        $parsedWorkTimes = array();
        foreach($workTimes as $workTime) {
            if ($workTime === null) {
                array_push($parsedWorkTimes, null);
            } else {
                $workTime = explode('-', $workTime);
                $workTimeStart = $this->timeToDateInterval($workTime[0]);
                $workTimeEnd = $this->timeToDateInterval($workTime[1]);
                array_push($parsedWorkTimes, array("start" => $workTimeStart, "end" => $workTimeEnd));
            }
        }
        return $parsedWorkTimes;
    }

    /**
     * Calculates the due date based on the workdays and max response hours
     * @return CarbonInterface
     */
    public function calculateDueDate() 
    {   
        $remainingSeconds = strtotime($this->maxResponseTime) - strtotime('TODAY');
        $currentTime = $this->isWorkday($this->submitDate) ? $this->submitDate : $this->getNextWorkDay($this->submitDate);
        $currentWorkday = $this->createWorkday($currentTime);
        $workTimeRemaining = $currentWorkday->getRemainingWorkTimeInSeconds();

        while ($remainingSeconds > $workTimeRemaining) {
            $remainingSeconds -= $workTimeRemaining;
            $currentTime = $this->getNextWorkDay($currentTime);
            $currentWorkday = $this->createWorkday($currentTime);
            $workTimeRemaining = $currentWorkday->getRemainingWorkTimeInSeconds();
        }

        return $currentTime->addSeconds($remainingSeconds);
    }

    /**
     * Gets the next workday
     * @param CarbonInterface $date
     * @return CarbonInterface $nextDay
     */
    private function getNextWorkDay(CarbonInterface $date) 
    {   
        $nextDay = $date->copy()->addDay();
        
        while (!$this->isWorkday($nextDay)) {
            $nextDay->addDay();
        }

        $workdayStart = $this->workTimes[$nextDay->dayOfWeekIso-1]['start'];
        
        return $nextDay->startOfDay()->add($workdayStart);
    }

    /**
     * Determines if the given date is a workday
     * @param CarbonInterface $date
     * @return bool
     */
    private function isWorkday(CarbonInterface $date) 
    {
        return $this->workTimes[$date->dayOfWeekIso-1] !== null;
    }

    /**
     * Creates a new workday based on the date
     * @param CarbonInterface $date
     * @return Workday
     */
    private function createWorkday(CarbonInterface $date) 
    {   
        $workTimes = $this->workTimes[$date->dayOfWeekIso-1];
        return new Workday($workTimes['start'], $workTimes['end'], $date);
    }
}