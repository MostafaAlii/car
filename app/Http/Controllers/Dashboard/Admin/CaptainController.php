<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\DataTables\Orders\OrderDataTable;
use App\Models\Image;
use App\Models\Captain;
use Illuminate\Http\Request;
use App\Models\CaptainProfile;
use App\Models\CarsCaptionStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\Api\ImageUploadTrait;
use App\DataTables\Dashboard\Admin\CaptainDataTable;
use App\Http\Requests\Dashboard\Admin\CaptionRequestValidation;
use App\Services\Dashboard\{Admins\CaptainService, General\GeneralService};

class CaptainController extends Controller
{
    use ImageUploadTrait;

    public function __construct(protected CaptainDataTable $dataTable, protected CaptainService $captainService, protected GeneralService $generalService)
    {
        $this->dataTable = $dataTable;
        $this->captainService = $captainService;
        $this->generalService = $generalService;
    }

    public function index()
    {
        $data = [
            'title' => 'Captions',
            'countries' => $this->generalService->getCountries(),
        ];
        return $this->dataTable->render('dashboard.admin.captains.index', compact('data'));
    }

    public function store(CaptionRequestValidation $request)
    {
        try {
            $requestData = $request->validated();
            $this->captainService->create($requestData);
            return redirect()->route('captains.index')->with('success', 'captain created successfully');
        } catch (\Exception $e) {
            return redirect()->route('captains.index')->with('error', 'An error occurred while creating the captain');
        }
    }

    public function show($captainId)
    {
        try {
            $data = [
                'title' => 'Captain Details',
                'captain' => $this->captainService->getProfile($captainId),
            ];
            return view('dashboard.admin.captains.show', compact('data'));
        } catch (\Exception $e) {
            return redirect()->route('captains.index')->with('error', 'An error occurred while getting the captain details');
        }
    }

    public function update(CaptionRequestValidation $request, $captainId)
    {
        try {
            $requestData = $request->validated();
            $this->captainService->update($captainId, $requestData);
            return redirect()->route('captains.index')->with('success', 'captain updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('captains.index')->with('error', 'An error occurred while updating the captain');
        }
    }

    public function updatePassword(Request $request, $captainId)
    {
        try {
            $this->captainService->updatePassword($captainId, $request->password);
            return redirect()->route('captains.index')->with('success', 'captain password updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('captains.index')->with('error', 'An error occurred while updating the captain password');
        }
    }

    public function destroy($id)
    {
        try {
            $this->captainService->delete($id);
            return redirect()->route('captains.index')->with('success', 'captain deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('captains.index')->with('error', 'An error occurred while deleting the captain');
        }
    }

    public function notifications($captainId)
    {
        try {
            return $this->captainService->getNotifications($captainId);
        } catch (\Exception $e) {
            return redirect()->route('captains.index')->with('error', 'An error occurred while getting the captain notifications');
        }
    }

    public function uploadPersonalMedia(Request $request)
    {
        if ($request->hasFile('personal_avatar'))
            $this->storeImage($request, 'personal_avatar', $request->get('imageable_id'));
        if ($request->hasFile('id_photo_front'))
            $this->storeImage($request, 'id_photo_front', $request->get('imageable_id'));
        if ($request->hasFile('id_photo_back'))
            $this->storeImage($request, 'id_photo_back', $request->get('imageable_id'));
        if ($request->hasFile('criminal_record'))
            $this->storeImage($request, 'criminal_record', $request->get('imageable_id'));
        if ($request->hasFile('captain_license_front'))
            $this->storeImage($request, 'captain_license_front', $request->get('imageable_id'));
        if ($request->hasFile('captain_license_back'))
            $this->storeImage($request, 'captain_license_back', $request->get('imageable_id'));
        if ($request->hasFile('car_license_front'))
            $this->storeImage($request, 'car_license_front', $request->get('imageable_id'));
        if ($request->hasFile('car_license_back'))
            $this->storeImage($request, 'car_license_back', $request->get('imageable_id'));
        return redirect()->back()->with('success', 'تم حفظ الصور بنجاح');
    }

    private function storeImage(Request $request, $field, $imageable)
    {
        $image = new Image();
        $image->photo_type = $field;
        $image->imageable_type = 'App\Models\Captain';
        $imageable = json_decode($imageable);
        if ($request->file($field)->isValid()) {
            $captainProfile = CaptainProfile::whereCaptainId($imageable->id)->select('uuid')->first();
            if ($captainProfile) {
                $nameWithoutSpaces = str_replace(' ', '_', $imageable->name);
                $request->file($field)->storeAs(
                    $nameWithoutSpaces . '_' . $captainProfile->uuid . DIRECTORY_SEPARATOR,
                    $field . '.' . $request->file($field)->getClientOriginalExtension(),
                    'upload_image'
                );
                $image->photo_status = 'not_active';
                $image->filename = $field . '.' . $request->file($field)->getClientOriginalExtension();
                $image->imageable_id = $imageable->id;
                $image->save();
            }
        }
    }


    public function uploadCarMedia(Request $request)
    {
        try {
            $this->captainService->uploadCarMedia($request);
            return redirect()->back()->with('success', 'captain car media uploaded successfully');
        } catch (\Exception $e) {
            return redirect()->route('captains.index')->with('error', 'An error occurred while uploading the captain media');
        }
    }

    public function updateStatus(Request $request, $id)
    {

        try {
            $captainId = $request->input('captain_id');
            $fieldName = $request->input('field_name');
            $newStatus = $request->input('status');
            $status = CarsCaptionStatus::findOrFail($id);

            if ($newStatus === 'reject') {
                $rejectReason = $request->input('reject_message');
                $status->status = $newStatus;
                $status->reject_message = $rejectReason;
                $status->save();
                sendNotificationCaptain($status->captain_profile->owner->fcm_token, 'reject', $status->reject_message);
                return redirect()->back()->with('success', 'Captain media updated status successfully');
            } else {
                $status->status = $newStatus;
                $status->save();
                sendNotificationCaptain($status->captain_profile->owner->fcm_token, $newStatus, $status->status);
                return redirect()->back()->with('success', 'Captain media updated status successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating status');
        }
    }

    public function updateCarStatus(Request $request, $id)
    {
        try {
            $captainId = $request->input('captain_id');
            $fieldName = $request->input('field_name');
            $newStatus = $request->input('status');
            $status = CarsCaptionStatus::findOrFail($id);
            if ($newStatus === 'reject') {
                $captain_profile_uuid = $request->input('captain_profile_uuid');
                $captain_name = $request->input('captain_name');
                $rejectReason = $request->input('reject_message');
                $status->status = $newStatus;
                $status->reject_message = $rejectReason;
                $status->save();
                sendNotificationCaptain($status->captain_profile->owner->fcm_token, 'reject', $status->reject_message);
                return redirect()->back()->with('success', 'Captain car media updated status successfully');
            } else {
                $status->status = $newStatus;
                $status->save();
                sendNotificationCaptain($status->captain_profile->owner->fcm_token, $newStatus, $status->status);
                return redirect()->back()->with('success', 'Captain car media updated status successfully');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating Captain car media status');
        }
    }

    public function updateActivityStatus(Request $request, $id)
    {
        try {
            $captain = Captain::findOrFail($id);
            $captain->captainActivity->status_captain_work = $request->input('status_captain_work');
            $captain->captainActivity->save();
            return redirect()->route('captains.show', $this->captainService->getProfile($id))->with('success', 'captain activity status updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating Captain activity status');
        }
    }

    public function sendNotificationAll(Request $request)
    {
        try {
            sendNotificatioAll($request->type, $request->body, $request->title);
            return redirect()->route('captains.index')->with('success', 'Successfully Send Notifications');

        } catch (\Exception $exception) {
            return redirect()->route('captains.index')->with('error', 'An error occurred');

        }
    }

    public function sendNotification(Request $request)
    {
        try {
            sendNotificationCaptain($request->fcm_token_captain, $request->body, $request->title);
            return redirect()->route('captains.index')->with('success', 'Successfully Send Notifications');

        } catch (\Exception $exception) {
            return redirect()->route('captains.index')->with('error', 'An error occurred');

        }
    }

    public function getOrders(OrderDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.captains.Orders.orders',['caption_orders' => \request()->caption_orders]);
    }
}
