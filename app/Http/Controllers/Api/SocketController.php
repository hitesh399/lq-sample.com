<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

/**
 * To Handle the Socket Request, Like Join,.
 *
 * @category Socket
 *
 * @author   Hitesh Kumar <hitesh@singsys.com>
 * @license  PHP License 7.2.0
 *
 * @see     http://tuneup.com
 */
class SocketController extends Controller
{
    /**
     * When user joins the sokcet join then roster the socket id in Redis.
     *
     * @param Class $request Illuminate\Http\Request
     *
     * @return Json Illuminate\Http\Response
     *
     * @throws Illuminate\Validation\ValidationException [in case of invalid input]
     */
    public function join(Request $request)
    {
        $request->validate(
            [
                'socket_id' => 'required|regex:/^[^.]+$/',
            ]
        );
        $user_id = Auth::id();
        $socket_id = $request->socket_id;

        $joining_key = "active.users.{$user_id}.{$socket_id}";
        Redis::set($joining_key, 1);
        $active_user_keys = Redis::keys('active.users.*.*');

        return $this->setData(
            [
                'active_users' => $active_user_keys,
            ]
        )->response();
    }
}
