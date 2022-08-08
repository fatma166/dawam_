<?php
namespace App\Library;

use App\Models\Notifications_log;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class NotificationManager
{
    private $notification;

    public function build($data_id, $type, $request)
    {  
        $user = Auth::guard('api')->user();
        $admin_role=Role::Where("name","admin")->where("company_id", $user->company_id)->first();
        $admin = User::where("company_id", $user->company_id)->where("role_id",$admin_role->id)->first();
        $notification_content = $this->format_notification($type, $user);
        $notification = new notifications_log();
        $notification->title = $notification_content["title"];
        $notification->message = $notification_content["message"];
        $notification->data_id = $data_id;
        $notification->type = $type;
        $notification->company_id = $user->company_id;
        $notification->notify_from = $user->id;
        $notification->notify_to = $admin->id;
        $notification->created_by = "user";
        $notification->addtion_data = $request->addtion_data??null;


        $this->notification = $notification;
    }

    public function commit()
    {
        if (!$this->notification) {
            throw new \Exception("Build Notification First");
        }
        $this->notification->save();
    }

    public function getNotification()
    {

        return $this->notification ?? 0;

    }

    private function format_notification($type, $user)
    {
        switch ($type) {
            case "make_leave":
                $data["title"] = "طلب اذن";
                $data["message"] = "الموظف " . $user->name . " طالب اذن مغادرة";
                break;
            case "add_outdoor":
                $data["title"] = "اضافة زيارة";
                $data["message"] = "الموظف " . $user->name . " قام باضافة زيارة";
                break;
            case "end_outdoor":
                $data["title"] = "انهاء زيارة";
                $data["message"] = "الموظف " . $user->name . " قام بانهاء زيارة";
                break;
            case "end_task":
                $data["title"] = "انهاء مهمة";
                $data["message"] = "الموظف " . $user->name . " قام بانهاء المهمة المسندة الية";
                break;
            case "add_client":
                $data["title"] = "اضافة عميل";
                $data["message"] = "الموظف " . $user->name . " قام باضافة عميل جديد الى المنصة";
                break;
            case "edit_client":
                $data["title"] = "تعديل عميل";
                $data["message"] = "الموظف " . $user->name . " قام تعديل بيانات عميل  فى المنصة";
                break;
           case "change_mac":
                $data["title"] = "محاولة الدخول";
                $data["message"] = "الموظف " . $user->name . " حاول دخول المنصة من جهاز اخر";
                break;
           case "access_by_new_mac":
                $data["title"] = "الدخول بالمنصة";
                $data["message"] = "الموظف " . $user->name ."قام بدخول المنصة من جهاز مختلف";
                break;
        }
        return $data;
    }

}
