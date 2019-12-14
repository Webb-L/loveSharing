<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $title = "设置";
        return view('admin.setting.index', compact('title'));
    }

    public function video()
    {
        $videos = [];
        foreach (Video::all() as $video) {
            $url = explode('/', $video->url);
            $videos[] = $url[count($url) - 2] . "/" . $url[count($url) - 1];
        }
        return implode(',', $videos);
    }

    public function image()
    {
        $displaymaps = [];
        foreach (Video::all() as $video) {
            $map = explode('/', $video->displaymap);
            $displaymaps[] = $map[count($map) - 2] . "/" . $map[count($map) - 1];
        }
        return implode(',', $displaymaps);
    }

    public function avatar()
    {
        $userAvatar = [];
        foreach (User::all() as $value) {
            $url = explode('/', $value->avatar);
            $userAvatar[] = $url[count($url) - 2] . "/" . $url[count($url) - 1];
        }
        foreach (\App\Admin\User::all() as $value) {
            $url = explode('/', $value->avatar);
            $userAvatar[] = $url[count($url) - 2] . "/" . $url[count($url) - 1];
        }
        return implode(',', $userAvatar);
    }
}
