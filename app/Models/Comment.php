<?php

namespace App\Models;

use App\Contracts\Comment\Commentable;
use App\Contracts\Comment\CommentableMorphTo;
use App\Http\Resources\CommentResource;
use App\Models\Concern\MorphCommentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements CommentableMorphTo
{
    use HasFactory, MorphCommentable;
    protected $guarded = [];

    public function getAllComments($productId): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $product = Product::find($productId);
        return CommentResource::collection($product->comments);
    }

    public function storeComment($request, $product_id): \Illuminate\Http\JsonResponse
    {
        $product = Product::find($product_id);
        $auth_user = auth()->user();

        $newComment = $product->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
            'user_avatar' => $auth_user->avatar
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment created ',
            'comment' => new CommentResource($newComment)
        ]);
    }
}
