<?php

interface iReadSideCommand
{
    
}

class CreateEntry implements iReadSideCommand
{
    public $name;
    public $number;
    public $experience;
    
    public function __construct($name, $number, $experience)
    {
        
    }
}

interface iEvent
{
    
}

class JobSeekerRegistered implements iEvent
{
    public $name;
    public $number;
    public $experience;
}

class JobSeekerQuery
{
    public function handle(iReadSideCommand $command);
}

class JobSeekerEventListenerController
{
    public function handle_event_jobseeker_registered(JobSeekerRegistered $event)
    {
        $jobseeker_query = new JobSeekerQuery;
        $jobseeker_query->handle(
            new CreateEntry($event->name, $event->number, $event->experience)
        );
    }
}
