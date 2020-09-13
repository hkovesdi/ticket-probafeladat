<?php

namespace App\Helpers;
use Illuminate\Support\Carbon;
use Carbon\CarbonInterface;
use DateInterval;

/**
 * Represents a workday.
 */
class Workday 
{   
    /**
     * The start of the workday
     * @var CarbonInterface
     */
    private $workdayStart;

    /**
     * The end of the workday
     * @var CarbonInterface
     */
    private $workdayEnd;

    /**
     * The current time in the workday
     * @var CarbonInterface
     */
    private $currentTime;

    /**
     * @param CarbonInterface $currentTime The current time in the given workday.
     * @param DateInterval $workdayStart The start of the workday as a DateInterval
     * @param DateInterval $workdayEnd The end of the workday as a DateInterval
     */
    function __construct(DateInterval $workdayStart, DateInterval $workdayEnd, CarbonInterface $currentTime)
    {   
        $this->currentTime = $currentTime;
        $this->workdayStart = $this->currentTime->copy()->startOfDay()->add($workdayStart);;
        $this->workdayEnd = $this->currentTime->copy()->startOfDay()->add($workdayEnd);;
    }

    /**
     * Checks if the date is before work time
     * @return bool
     */
    public function isBeforeWorkTime() 
    {   
        return $this->currentTime->lte($this->workdayStart);
    }

    /**
     * Checks if date is after work time
     * @return bool
     */
    public function isAfterWorkTime()
    {
        return $this->currentTime->gte($this->workdayEnd);
    }

    /**
     * Calculates the remaining worktime from the day in seconds
     * @return int The remaining worktime in seconds
     */
    public function getRemainingWorkTimeInSeconds() 
    {
        if($this->isAfterWorkTime()){
            return 0;
        }
        else if($this->isBeforeWorkTime()) {
            return $this->workdayEnd->diffInSeconds($this->workdayStart);
        }
        else {
            return $this->workdayEnd->diffInSeconds($this->currentTime);
        }
    }
}