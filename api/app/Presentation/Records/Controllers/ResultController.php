<?php

namespace App\Presentation\Records\Controllers;


use App\Core\Records\Actions\CreateResultAction;
use App\Core\Records\Actions\DeleteResultAction;
use App\Core\Records\Actions\UpdateResultAction;
use App\Core\Records\DTO\ResultDTO;
use App\Core\Records\Queries\ResultQuery;
use App\Presentation\Controller;
use App\Presentation\Records\Requests\CreateResultRequest;
use App\Presentation\Records\Requests\UpdateResultRequest;
use App\Presentation\Records\Resources\ResultIndexResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


final class ResultController extends Controller
{
    private CreateResultAction $createResult;

    private UpdateResultAction $updateResult;

    private DeleteResultAction $deleteResult;

    private ResultQuery $resultQuery;

    public function __construct(
        CreateResultAction $createResult,
        UpdateResultAction $updateResult,
        DeleteResultAction $deleteResult,
        ResultQuery $resultQuery
    ){
        $this->createResult = $createResult;
        $this->updateResult = $updateResult;
        $this->deleteResult = $deleteResult;
        $this->resultQuery = $resultQuery;
    }

    public function index(Request $request): JsonResponse
    {
       $results = $this->resultQuery->getByFilter($request);

       return response()->json($results, 200);
    }

    public function show(int $id)
    {
        $result = $this->resultQuery->getById($id);
        dd($result);
    }

    public function store(CreateResultRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $dto = new ResultDTO($validated);
        $result = $this->createResult->execute($dto);

        return response()->json(new ResultIndexResource($result), 201);
    }

    public function update(UpdateResultRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $dto = new ResultDTO($validated);
        $result = $this->updateResult->execute($dto, $id);

        return response()->json(new ResultIndexResource($result), 201);
    }

    public function delete(int $id): JsonResponse
    {
        $result = $this->deleteResult->execute($id);

        return response()->json(new ResultIndexResource($result), 201);
    }
}
