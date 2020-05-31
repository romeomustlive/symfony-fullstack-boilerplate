<?php

namespace App\Presentation\Records\Controllers;


use App\Core\Records\Actions\CreateExerciseAction;
use App\Core\Records\Actions\DeleteExerciseAction;
use App\Core\Records\Actions\UpdateExerciseAction;
use App\Core\Records\DTO\ExerciseDTO;
use App\Core\Records\Queries\ExerciseQuery;
use App\Presentation\Controller;
use App\Presentation\Records\Requests\CreateExerciseRequest;
use App\Presentation\Records\Requests\UpdateExerciseRequest;
use App\Presentation\Records\Resources\ExerciseIndexResource;
use Illuminate\Http\JsonResponse;


final class ExerciseController extends Controller
{
    private CreateExerciseAction $createExercise;

    private UpdateExerciseAction $updateExercise;

    private DeleteExerciseAction $deleteExercise;

    private ExerciseQuery $exerciseQuery;

    public function __construct(
        CreateExerciseAction $createExercise,
        UpdateExerciseAction $updateExercise,
        DeleteExerciseAction $deleteExercise,
        ExerciseQuery $exerciseQuery
    ){
        $this->createExercise = $createExercise;
        $this->updateExercise = $updateExercise;
        $this->deleteExercise = $deleteExercise;
        $this->exerciseQuery = $exerciseQuery;
    }

    public function index(): JsonResponse
    {
        $exercises = $this->exerciseQuery->getAllByUser(current_user()->id);

        return response()->json(ExerciseIndexResource::collection($exercises), 200);
    }

    public function show(int $id): JsonResponse
    {
        $exercise = $this->exerciseQuery->getById($id);

        return response()->json(new ExerciseIndexResource($exercise), 200);
    }

    public function store(CreateExerciseRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $dto = new ExerciseDTO($validated);
        $exercise = $this->createExercise->execute($dto);

        return response()->json(new ExerciseIndexResource($exercise), 201);
    }

    public function update(UpdateExerciseRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();
        $dto = new ExerciseDTO($validated);
        $exercise = $this->updateExercise->execute($dto, $id);

        return response()->json(new ExerciseIndexResource($exercise), 201);
    }

    public function delete(int $id): JsonResponse
    {
        $exercise = $this->deleteExercise->execute($id);

        return response()->json(new ExerciseIndexResource($exercise), 201);
    }
}
