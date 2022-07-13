<?php

namespace App\Services\Comments;

use App\Http\Resources\CommentResource;

class CommentService implements CommentInterface
{
    public function storeCommentService($request, $id, $product): \Illuminate\Http\JsonResponse
    {
        $product = $product->find($id);
        $auth_user = auth()->user();

        $product->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
            'user_avatar' => $auth_user->avatar
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comment created '
        ]);
    }

    public function viewCommentService($id, $product): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $product = $product->find($id);
        return CommentResource::collection($product->comments);
    }
}
