<?php

namespace App\Helpers;

use Carbon\CarbonInterface;
use DateInterval;
use Illuminate\Support\Carbon;

class DueDateHelper 
{
    private $submitDate;
    private $dueDate;
    private $workTimes;
    private $exceptions;
    private $maxResponseTime;

    function __construct(string $maxResponseTime, array $workTimes, CarbonInterface $submitDate = NULL, array $exceptions = array()) 
    {
        $this->submitDate = $submitDate ?? Carbon::now();
        $this->maxResponseTime = $maxResponseTime;
        $this->workTimes = $this->parseWorkTimes($workTimes);
        $this->exceptions = $exceptions;
    }

    private function parseWorkTimes(array $workTimes) 
    {
        $parsedWorkTimes = array();
        foreach($workTimes as $workTime) {
            if($workTime === null) {
                array_push($parsedWorkTimes, null);
            } else {
                $workTime = explode('-', $workTime);
                $workTimeStartSplit = explode(':', $workTime[0]);
                $workTimeStart = new DateInterval("PT{$workTimeStartSplit[0]}H{$workTimeStartSplit[1]}M{$workTimeStartSplit[2]}S");
                $workTimeEndSplit = explode(':', $workTime[1]);
                $workTimeEnd = new DateInterval("PT{$workTimeEndSplit[0]}H{$workTimeEndSplit[1]}M{$workTimeEndSplit[2]}S");
                array_push($parsedWorkTimes, array("start" => $workTimeStart, "end" => $workTimeEnd));
            }
        }
        return $parsedWorkTimes;
    }

    public function calculateDueDate() 
    {
        $remainingSeconds = strtotime($this->maxResponseTime) - strtotime('TODAY');
        $currentTime = $this->isWorkday($this->submitDate) ? $this->submitDate : $this->getNextWorkDay($this->submitDate);
        $currentWorkday = $this->createWorkday($currentTime);
        $workTimeRemaining = $currentWorkday->getRemainingWorkTimeInSeconds();

        while($remainingSeconds <= $workTimeRemaining) {
            $remainingSeconds -= $workTimeRemaining;
            $currentTime = $this->getNextWorkDay($currentTime);
            $currentWorkday = $this->createWorkday($currentTime);
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
        
        while(!$this->isWorkday($nextDay)) {
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