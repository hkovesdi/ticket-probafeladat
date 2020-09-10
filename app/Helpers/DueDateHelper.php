<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DueDateHelper 
{
    private $submitDate;
    private $maxResponseTimeWorkHours;
    private $workdayStartHour;
    private $workdayEndHour;

    function __construct(Carbon $submitDate = NULL, int $maxResponseTimeWorkHours = 16, $workdayStartHour = 9, $workdayEndHour = 17) 
    {
        $this->submitDate = $submitDate ?? Carbon::now();
        $this->maxResponseTimeWorkHours = $maxResponseTimeWorkHours;
        $this->workdayStartHour = $workdayStartHour;
        $this->workdayEndHour = $workdayEndHour;
    }

    public function calculateDueDate() 
    {
        $currentWorkingHour = $this->isWorkingHour($this->submitDate) ? $this->submitDate : $this->getNextWorkingHour($this->submitDate);
        $minutesToAdd = $currentWorkingHour->minute;

        for($i = 0; $i < $this->maxResponseTimeWorkHours; $i++) {
            $currentWorkingHour = $this->getNextWorkingHour($currentWorkingHour);
        }
        
        if($currentWorkingHour->hour == $this->workdayEndHour) {
            $currentWorkingHour = $this->getNextWorkingHour($currentWorkingHour)->addMinutes($minutesToAdd);
        }
        else {
            $currentWorkingHour = $currentWorkingHour->addMinutes($minutesToAdd);
        }

        return $currentWorkingHour;
    }

    /**
     * Gets the next workday
     * @param Carbon $date
     * @return Carbon $nextDay
     */
    private function getNextWorkDay(Carbon $date) 
    {   
        $nextDay = $date->copy()->addDay()->hours($this->workdayStartHour)->minutes(0);
        
        while(!$this->isWorkday($nextDay)) {
            $nextDay->addDay()->hours($this->workdayStartHour)->minutes(0);
        }

        return $nextDay;
    }

    private function getNextWorkingHour(Carbon $date) 
    {   
        //If the date is not a workday, or it is the last hour of the workday, the next working hour will be at the start of the next workday.
        if(!$this->isWorkday($date) || $date->hour > $this->workdayEndHour - 2) {
            return $this->getNextWorkDay($date);
        }
        //If the date is a workday, but it's earlier that working hours, the nex working hour will be at the start.
        else if($date->hour < $this->workdayStartHour) {
            return $date->hours($this->workdayStartHour)->minutes(0);
        }
        else {
            return $date->addHour();
        }
    }

    /**
     * Determines if the given date is a workday
     * @param Carbon $date
     * @return bool
     */
    private function isWorkday(Carbon $date) 
    {
        return $date->isWeekday();
    }

    /**
     * Determines whether the current date is a work hour
     * @param Carbon $date
     * @return bool
     */
    private function isWorkingHour(Carbon $date) 
    {
        return $this->isWorkDay($date) && 
            $date->hour >= $this->workdayStartHour && 
            $date->hour < $this->workdayEndHour;
    }
}