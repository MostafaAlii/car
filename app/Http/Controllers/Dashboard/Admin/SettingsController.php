<?php
namespace App\Http\Controllers\Dashboard\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Settings, SettingPeekTimeFee};
use Illuminate\Support\Facades\DB;
class SettingsController extends Controller {
    public function index() {
        return view('dashboard.admin.settings.index', ['title' => 'Main Settings','setting' => Settings::first()]);
    }

    public function update(Request $request) {
        $settingData = $request->except(['_token']);
        $setting = Settings::updateOrCreate(['id' => 1, 'facebook' => fake()->url(),
            'instagram' => fake()->url(),
            'phone' => fake()->phoneNumber(),
            'whatsapp' => fake()->phoneNumber(),
            'email' => fake()->unique()->email(),
            'version' => 1,
            'open_door' => 3.5,
            'waiting_price' => 2,
            'country_tax' => 10,
            'kilo_price' => 5,
            'api_secret_key' => fake()->name(),
            'ocean' => 2,
            'company_commission' => 5,
            'company_tax' => 6,], $settingData);
        DB::table('setting_peek_time_fees')->delete();
        $data = $request->peek_time_fees;
        foreach ($data as $peekTimeFeeData) {
            SettingPeekTimeFee::create([
                'settings_id' => 1,
                'start_date' => $peekTimeFeeData['start_date'],
                'end_date' => $peekTimeFeeData['end_date'],
                'price' => $peekTimeFeeData['price'],
            ]);
        }
        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
