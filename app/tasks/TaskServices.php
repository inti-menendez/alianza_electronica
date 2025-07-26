<?php

class TaskServices
{
    public static function getTasksWithDetails($customerId)
    {
        $tasks = TaskModel::table()
            ->where('customer_id', '=', $customerId)
            ->read();

        foreach ($tasks as &$task) {
            $task['technician'] = UserModel::findBy($task['assigned_technician_id']);
            $task['device'] = DeviceModel::findBy($task['device_id']);
        }

        return $tasks;
    }
}
