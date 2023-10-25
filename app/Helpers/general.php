<?php

use App\Models\Captain;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

if (!function_exists('get_user_data')) {
    function get_user_data()
    {
        $guards = ['admin', 'web', 'company', 'captain', 'employee', 'agent'];
        foreach ($guards as $guard) {
            if (auth($guard)->check())
                return auth($guard)->user();
        }
        return null;
    }
}

if (!function_exists('require_api_routes')) {
    function require_api_routes()
    {
        $files = glob(base_path('routes/api/*.php'));
        foreach ($files as $file) {
            if ($file != base_path('routes/api/api.php'))
                require_once $file;
        }
    }
}


if (!function_exists('require_dashboard_routes')) {
    function require_dashboard_routes()
    {
        $files = glob(base_path('routes/dashboard/*.php'));
        foreach ($files as $file) {
            if ($file != base_path('routes/dashboard/dashboard.php'))
                require_once $file;
        }
    }
}

if (!function_exists('mainsSettings')) {
    function mainsSettings()
    {
        return \App\Models\Settings::first();
    }
}

if (!function_exists('sendNotificationUser')) {
    function sendNotificationUser($fcm, $body, $title, $store = false)
    {
        $user = User::where('fcm_token', $fcm)->first();
        $url = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "key=AAAA5dxbfSs:APA91bH6P3jOhcvNzYL9u-9n9J8Zm_PhOmSDhJu-IfPiH7ofh7IWf8nRl-xNd_TMlIB_0jDuGu4swGYk3MYxZ2B_NXGbO8NPZJcL0d4UtDRqHnDGIcoSqDlkGYp8RPazQdnLhZWV3T4u"
        ])->post('https://fcm.googleapis.com/fcm/send', [
            "to" => $fcm,
            "notification" => [
                "body" => $body,
                "title" => $title,
            ]
        ]);

        if ($url->ok()) {
            if ($store === false) {
                Notification::create([
                    "type" => "user",
                    "user_id" => $user->id,
                    "notifications_title" => $title,
                    "notifications_body" => $body,
                ]);
            }

            return true;
        }
        return true;
    }
}

if (!function_exists('sendNotificationCaptain')) {
    function sendNotificationCaptain($fcm, $body, $title, $store = false)
    {
        $captain = Captain::where('fcm_token', $fcm)->first();
      
        $url = Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "key=AAAA5dxbfSs:APA91bH6P3jOhcvNzYL9u-9n9J8Zm_PhOmSDhJu-IfPiH7ofh7IWf8nRl-xNd_TMlIB_0jDuGu4swGYk3MYxZ2B_NXGbO8NPZJcL0d4UtDRqHnDGIcoSqDlkGYp8RPazQdnLhZWV3T4u"
        ])->post('https://fcm.googleapis.com/fcm/send', [
            "to" => $fcm,
            "notification" => [
                "body" => $body,
                "title" => $title,
            ]
        ]);
        if ($url->ok()) {
            if ($store === false) {
                Notification::create([
                    "type" => "driver",
                    "captains_id" => $captain->id,
                    "notifications_title" => $title,
                    "notifications_body" => $body,
                ]);
                return true;
            }

        }
        return true;
    }
}

if (!function_exists('sendNotificatioAll')) {
    function sendNotificatioAll($type, $body, $title)
    {

        Http::withHeaders([
            "Content-Type" => "application/json",
            "Authorization" => "key=AAAA5dxbfSs:APA91bH6P3jOhcvNzYL9u-9n9J8Zm_PhOmSDhJu-IfPiH7ofh7IWf8nRl-xNd_TMlIB_0jDuGu4swGYk3MYxZ2B_NXGbO8NPZJcL0d4UtDRqHnDGIcoSqDlkGYp8RPazQdnLhZWV3T4u"
        ])->post('https://fcm.googleapis.com/fcm/send', [
            "to" => "/topics/" . $type,
            "notification" => [
                "body" => $body,
                "title" => $title,
            ]
        ]);

        return true;
    }
}

if (!function_exists('checkYears')) {
    function checkYears($years)
    {
        $currentYear = date('Y');

        if ($years <= $currentYear) {
            $difference = $currentYear - $years;

            if ($difference <= 4) {
                $carCategory = \App\Models\CategoryCar::where('name', "A+")->first();
                return $carCategory->id;
            } elseif ($difference <= 8) {
                $carCategory = \App\Models\CategoryCar::where('name', 'A')->first();
                return $carCategory->id;
            } elseif ($difference <= 12) {
                $carCategory = \App\Models\CategoryCar::where('name', 'B')->first();
                return $carCategory->id;
            } else {
                $carCategory = \App\Models\CategoryCar::where('name', 'C')->first();
                return $carCategory->id;
            }
        } else {
            return "Invalid Year";
        }
    }
}


if (!function_exists('getUrlPhoto')) {
    function getUrlPhoto($type, $id_captain, $name_photo)
    {
        $captain = \App\Models\CaptainProfile::where('captain_id', $id_captain)->first()->uuid;
        $captain_name = Captain::findorfail($id_captain);
        $cleanedCaptainName = str_replace(' ', '_', $captain_name->name);
        if ($captain) {
            return asset('dashboard/img/' . $captain . '_' . $cleanedCaptainName . '/' . $type . $name_photo);
        }
        return false;
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 5)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
if (!function_exists("getStatisticsGoogle")) {
    function getStatisticsGoogle($latUser, $longUser, $latDriver, $longDriver)
    {
        $response = Http::withOptions([
            'verify' => false
        ])->get('https://maps.googleapis.com/maps/api/directions/json', [
            "origin" => $latUser . ',' . $longUser,
            "destination" => $latDriver . ',' . $longDriver,
            "language" => "en",
            "key" => "AIzaSyCSGP2IG1S0M2-Nt9Pr_yDQmrjjysoH4Ek"
        ]);

        if ($response->ok()) {
            $data = [
                'distance' => $response['routes'][0]['legs'][0]['distance']['text'],
                'duration' => $response['routes'][0]['legs'][0]['duration']['text'],
            ];

            return $data;
        }
        return null;
    }
}

if (!function_exists('getTotalAmountDay')) {
    function getTotalAmountDay($id_caption)
    {
        $commissionPercentage = optional(\App\Models\Settings::first())->company_commission ?? 0;
        $commission = $commissionPercentage / 100;
        
        $ordersTotal = \App\Models\Order::where('status', 'done')
        ->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'),Carbon::now()->format('Y-m-d'))
        ->where('captain_id', $id_caption)
        ->sum('total_price');


        return number_format($ordersTotal - ($ordersTotal * $commission), 2);
    }
}

if (!function_exists('getTotalAmount')) {
    function getTotalAmount($id_order)
    {
        $commissionPercentage = \App\Models\Settings::first()->company_commission ?? 0;
        $commission = $commissionPercentage / 100;
        $dailyTotal = \App\Models\Order::findorfail($id_order);
        $ordersTotal = 0;
        $ordersTotal += $dailyTotal->total_price;
        return number_format($ordersTotal - ($ordersTotal * $commission), 2);
    }
}


if (!function_exists('createInFirebase')) {
    function createInFirebase($user_id, $caption_id, $order_id)
    {
        $order = \App\Models\Order::findorfail($order_id);
        $response = Http::post('https://silver-triangle-client-default-rtdb.firebaseio.com/user-' . $user_id . '.json', [
            "order_code" => $order->order_code,
            "total_price" => $order->total_price,
        ]);
        $response_caption = Http::post('https://silver-triangle-client-default-rtdb.firebaseio.com/captain-' . $caption_id . '.json', [
            "order_code" => $order->order_code,
            "total_price" => $order->total_price,
        ]);
        if ($response->ok() && $response_caption->ok()) {
            return true;
        }
        return false;
    }
}

if (!function_exists('DeletedInFirebase')) {
    function DeletedInFirebase($user_id, $caption_id, $order_id)
    {
        $order = \App\Models\Order::findorfail($order_id);
        $response = Http::delete('https://silver-triangle-client-default-rtdb.firebaseio.com/user-' . $user_id . '.json', [
            "order_code" => $order->order_code,
            "total_price" => $order->total_price,
        ]);
        $response_caption = Http::delete('https://silver-triangle-client-default-rtdb.firebaseio.com/captain-' . $caption_id . '.json', [
            "order_code" => $order->order_code,
            "total_price" => $order->total_price,
        ]); 
        $response_Order = Http::delete('https://silver-triangle-client-default-rtdb.firebaseio.com/' . $order->order_code . '.json', [
            "order_code" => $order->order_code,
            "total_price" => $order->total_price,
        ]);
        if ($response->ok() && $response_caption->ok() && $response_Order->ok()) {
            return true;
        }
        return false;
    }
}
