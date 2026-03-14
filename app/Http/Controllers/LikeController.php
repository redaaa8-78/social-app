<?php
namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
class LikeController extends Controller
{
    public function like(Post $post)
    {
        Like::firstOrCreate([
            'user_id'=>session('user_id'),
            'post_id'=>$post->id
        ]);

        return response()->json(['success'=>true]);
    }
}
