<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\NotificationManager;
USE App\Contracts\ErrorMessages;
class TaskController extends Controller
{
    //
    public function Index(Request $request, $id = null)
    {

        if ($id) {
            $data = $request->user()->tasks()->find($id);
        } else {

            $data = $request->user()->tasks()->whereNotIn('status', ['done', 'late'])->get();

        }

        return $data;
    }

    public function Register(Request $request, $id)
    {

        if (!$task = $request->user()->tasks()->find($id)) {
            $data['msg'] = 'no content';

            return response()->json(['msg' => ErrorMessages::TASK_REGISTER_NO_CONTENT_ERROR], 400);

        } elseif ($task->status != "done" && $task->status != "late") {

            switch ($task->status) {
                case "delivered":$task->status = "seen";
                    break;
                case "seen":$task->status = "in_progress";
                    break;
                case "in_progress":
                    $CurrentDate = new \DateTime('Africa/cairo');
                    $registirationTime = $CurrentDate->format('Y-m-d');
                    $task->status = ($registirationTime > $task->due_date) ? "late" : "done";

                    $NotificationManager=new NotificationManager();
                    $NotificationManager->build($id,"end_task",$request);
                    $NotificationManager->commit();
                    break;
            }

            $task->save();
        }

        // $task_dones = new task_dones();

        /**
         * set user status late or done
         */
        // $currentTime = new \DateTime('Africa/cairo');
        // $registirationTime = $currentTime->format('Y:m:d H:i:s');

        // $checkinTime = $task->due_date;
        // if ($registirationTime > $checkinTime) {
        //     $task_dones->status = 'late';
        // } else {
        //     $task_dones->status = 'done';
        // }

        /**
         * check dublicate checkin or check out
         * check process state check in or check out
         * save registiration
         */

        // if ($taskDone = $task->task_dones()->where('type', 'checkin')->first()) {
        //     $task_dones->type = "checkout";
        //     $task->status = 'done';
        // } else {
        //     $task_dones->type = "checkin";
        //     $task->status = 'start';
        // }

        // $task_dones->user_id = $request->user()->id;

        // $task->save();
        // $task->task_dones()->save($task_dones);

        $data['msg'] = 'registeration task done';
        $data['status'] = $task->status;
        return response()->json($data, 200);

    }
}
