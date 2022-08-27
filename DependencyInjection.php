<?php

declare(strict_types=1);


class person
{
    public Jobs $jobs;

    public function __construct(
        Jobs $jobs
    ) {
        $this->jobs = $jobs;
    }

    public function getJobs(): Jobs
    {
        $this->jobs ??= new Jobs();

        return $this->jobs;
    }


    public function getPersonDetails()
    {
        $this->getJobs()->getJobTitle('Me', 2);
    }
}


class Jobs
{
    public function __construct(){
    }

    public function getJobTitle($name, $level)
    {
        switch ($level) {
            case 1:
                return 'Admin Assistant';
                break;
            case 2:
                return 'Team member';
                break;
        }
    return;
    }
}
