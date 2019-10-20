<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Notification Management.
 *
 * @return \Illuminate\Http\Response
 */
class UserDeviceController extends Controller
{
    /**
     * Enable or Disable Notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatusNotification(Request $request)
    {
        $user_id = Auth::id();

        $device_user = $request->device()->users()->where('user_id', $user_id)->first();
        $settings = $device_user->pivot->settings;
        $allow_push_notification = $settings['allow_push_notification'] == 'Yes' ? 'No' : 'Yes';

        $request->device()->users()->syncWithoutDetaching(
            [
                $user_id => [
                    'settings->allow_push_notification' => $allow_push_notification,
                ],
            ]
        );

        return $this->setData(
            [
                'allow_push_notification' => $allow_push_notification,
            ]
        )->setMessage('Notification setting has been changed.')->response();
    }

    public function deviceInfo(Request $request)
    {
        $device = $request->user()->devices()->where(
            'devices.id', $request->device()->id
        )->first();

        return $this->setData($device)
            ->response();
    }

    public function updateDeviceToken(Request $request)
    {
        $device = $request->user()->devices()->where(
            'devices.id', $request->device()->id
        )->first();

        $device->update(['device_token' => $request->device_token]);

        return $this->setData($device)
            ->response();
    }
}
