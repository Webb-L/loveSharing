<?php

namespace App\Http\Controllers;

use App\Services\OSS;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $array = Video::where('status', '2')->inRandomOrder()->first();
        if (!$array->user) $this->index();
        if($array->user->avatar) {
            $img = $array->user->avatar;
        }else {
            $img = "https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png";
        }
        $data = array('id' => $array->id, 'title' => $array->title, 'url' => $array->url, 'displaymap' => $array->displaymap, 'avatar' => $img, 'user_id' => $array->users_id);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => "required|min:2|max:10",
            'image_url' => 'required|url',
            'video_url' => 'required|url',
        ]);

        $data = new Video();
        $data->title = $request->title;
        $data->url = $request->get('video_url');
        $data->users_id = \Auth::guard('user')->user()->id;
        $data->displaymap = $request->get('image_url');

        return $data->save() ? 200 : 422;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video, $id)
    {
        $videoData = $video->where('status', '2')->where('id', $id)->first();
        return empty($videoData) ? '' : array('title' => $videoData->title, 'video_url' => $videoData->url, 'user_id' => $videoData->users_id, 'user_name' => $videoData->user->name, 'user_avatar' => $videoData->user->avatar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Video $video)
    {
        $this->validate($request, [
            'title' => "required|min:2|max:10"
        ]);

        $data = $video->find($id);
        $data->title = $request->get('title');
        if ($request->get('image_url')) $data->displaymap = $request->get('image_url');
        if ($request->get('video_url')) $data->url = $request->get('video_url');
        return $data->save() ? 200 : 422;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Video $video)
    {
        if ($video->where('id', $id)->first()->users_id !== \Auth::guard('user')->user()->id) return '';
        $data = $video->where('id', $id)->first();
        $data->deleted_at = date('Y-m-d H:i:s');
        return $data->save() ? '200' : '';
    }

    /**
     *
     * 传入文件对象和文件类型 上传成功后返回链接
     *
     * @param $file 文件对象
     * @param $type 文件类型
     * @return string
     */
    private function uploadFile($file, $type)
    {
        $imgPath = explode('/', $type)[0] . '/' . str_shuffle(md5(time())) . '.' . explode('/', $type)[1];
        foreach ((array)OSS::publicUpload(config('alioss.BucketName'), $imgPath, $file) as $d) {
            if ($d) return config('alioss.aliOss_Server') . '/' . $imgPath;
        }
    }

    public function search(Request $request)
    {
        return Video::orderBy('id', 'desc')->where('status', '2')->where('title', 'like', "%{$request->get('key')}%")->get()->toArray();
    }
}
