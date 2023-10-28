<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\StoreRequest;
use App\Http\Requests\Article\UpdateRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\QueryFilters\CreatedAt;
use App\QueryFilters\CursorPaginateLoc;
use App\QueryFilters\Sort;
use App\QueryFilters\Text;
use App\QueryFilters\Title;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

final class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $articles = app(Pipeline::class)
            ->send(Article::query()->with('author'))
            ->through(
                [
                    Title::class,
                    Text::class,
                    CreatedAt::class,
                    Sort::class,
                    CursorPaginateLoc::class,
                ]
            )->thenReturn();

        return response()->json(
            new ArticleCollection($articles)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $article = new Article($request->only('text', 'title'));
        $imagePath = $request->file('image')->store('article_images');
        $article->image_path = $imagePath;
        $article->author_id = auth()->id();
        $article->save();

        return response()->json(
            ['message' => 'Статья создана'],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json(
            new ArticleResource(Article::query()->findOrFail($id))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('article_images');
            $data['image_path'] = $imagePath;
        }
        Article::query()->findOrFail($id)
            ->update($data);

        return response()->json(
            ['message' => 'Статья обновлено'],
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        Article::destroy($id);
        return response()->json(
            ['message' => 'Статья удалена'],
            201
        );
    }
}
