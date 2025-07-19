<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Service\BookService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;


class BookController extends Controller
{
    public function __construct(
        private readonly BookService $bookService
    )
    {
    }

    #[OA\Get(
        path: "/api/books",
        summary: "Get a list of all books",
        tags: ["books"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Get a list of all books",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/BookCollection"
                )
            )
        ]
    )]
    public function index(): BookCollection
    {
        return new BookCollection(Book::with('authors')->paginate(10));
    }


    #[OA\Post(
        path: "/api/books",
        summary: "Create a book",
        security: [["sanctum" => []]],
        requestBody: new OA\RequestBody(
            required: true, content: new OA\JsonContent(
            ref: "#/components/schemas/StoreRequest"
        )),
        tags: ["books"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Get created book",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/BookResource"
                )
            )
        ]
    )]
    public function store(StoreRequest $request): BookResource
    {
        $bookDTO = $request->toDTO();

        $book = $this->bookService->createBook($bookDTO);

        return BookResource::make($book);
    }

    #[OA\Get(
        path: "/api/books/{book}",
        summary: "Get book by id",
        security: [["sanctum" => []]],
        tags: ["books"],
        parameters: [
            new OA\Parameter(
                parameter: 'post',
                name: "book",
                description: "Get Book by id",
                in: "path",
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 2
                )
            )],
        responses: [
            new OA\Response(
                response: 200,
                description: "Get Book by id",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/BookResource"
                )
            )
        ]
    )]
    public function show(int $id): BookResource
    {
        return BookResource::make(Book::with('authors')->findOrFail($id));
    }

    #[OA\Patch(
        path: "/api/books/{book}",
        summary: "Update book by id",
        security: [["sanctum" => []]],
        requestBody: new OA\RequestBody(
            required: true, content: new OA\JsonContent(
            ref: "#/components/schemas/StoreRequest"
        )),
        tags: ["books"],
        parameters: [
            new OA\Parameter(
                parameter: 'post',
                name: "book",
                description: "Update Book by id",
                in: "path",
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 2
                )
            )],
        responses: [
            new OA\Response(
                response: 200,
                description: "Get Book by id",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/BookResource"
                )
            )
        ]
    )]
    public function update(UpdateRequest $request, Book $book): BookResource
    {
        $bookDTO = $request->toDTO();

        $book = $this->bookService->updateBook($book, $bookDTO);

        return BookResource::make($book);
    }

    #[OA\Delete(
        path: "/api/books/{book}",
        summary: "Destroy book by id",
        security: [["sanctum" => []]],
        tags: ["books"],
        parameters: [
            new OA\Parameter(
                parameter: 'post',
                name: "book",
                description: "Destroy Book by id",
                in: "path",
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    example: 2
                )
            )],
        responses: [
            new OA\Response(
                response: 200,
                description: "Destroyed Book by id",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/BookResource"
                )
            )
        ]
    )]
    public function destroy(Book $book): JsonResponse
    {
        return response()->json($this->bookService->deleteBook($book), 204);
    }
}
