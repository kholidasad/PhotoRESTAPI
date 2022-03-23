<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as Controller;
use App\Http\Controllers\API\CloudinaryStorage;
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Like;
use Validator;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::join('users', 'users.id', '=', 'photos.user_id')->get(['photos.*', 'users.name']);

        return response()->json([
            'status' => 200,
            'data' => $photos,
            'message' => 'Get Photos Success'
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required'
        ]);

        $file = $request->file('photo');
        $upload = cloudinaryStorage::upload($file->getRealPath(), $file->getClientOriginalName());
        $photo = Photo::create([
            'photo' => $upload,
            'caption' => $request->caption,
            'tags' => $request->tags,
            'user_id' => $request->user()->id
        ]);

        return response()->json([
            'status' => 200,
            'data' => $photo,
            'message' => 'Successfully Created'
        ]);
    }

    public function detail($id)
    {
        $photo = Photo::join('users', 'users.id', '=', 'photos.user_id')->where('photos.id', $id)->get(['photos.*', 'users.name']);

        if(count($photo) == 0) {
            return response()->json([
                'status' => 404,
                'message' => 'Photo doesnt exist'
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $photo,
            'message' => 'Get Photo Success'
        ]);
    }

    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);
        if(auth()->user()->id == $photo->user_id) {
            if(!($request->caption || $request->tags)) {
                return response()->json([
                    'message' => 'can only accept caption and tags id'
                ]);
            }
            $photo->caption = $request->caption;
            $photo->tags = $request->tags;
            $photo->save();
    
            return response()->json([
                'status' => 200,
                'data' => $photo,
                'message' => 'Update Photo Success'
            ]);
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }
    }

    public function delete($id)
    {
        $photo = Photo::find($id);
        if(auth()->user()->id == $photo->user_id) {
            cloudinaryStorage::delete($photo->photo);

            Photo::where('id', $id)->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Delete Photo Success'
            ]);
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ]);
        }
    }

    public function like($id)
    {
        // $photo = Photo::find($id);
        $like = Like::create([
            'user_id' => auth()->user()->id,
            'photo_id' => $id
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Like Photo Success'
        ]);
    }

    public function unlike($id)
    {
        $like = Like::where([
            ['photo_id', $id],
            ['user_id', auth()->user()->id]
        ])->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Unlike Photo Success'
        ]);
    }

    public function countLike($id)
    {
        $count = Like::where('photo_id', $id)->count();

        return response()->json([
            'count' => $count
        ]);
    }
}
