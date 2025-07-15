<?php

class DashboardService 
{
    public function getDashboardData()
    {

        
        return [
            'title' => 'Dashboard',
            'welcomeMessage' => 'Welcome to the Alianza Electrónica Dashboard!',
            'stats' => [
                'users' => 150,
                'projects' => 75,
                'tasks' => 200,
            ],
        ];
    }
}