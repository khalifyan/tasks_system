<?php
namespace App\Http\Controllers\Api;

use App\Actions\Tasks\TaskDestroyAction;
use App\Actions\Tasks\TaskListAction;
use App\Actions\Tasks\TaskStoreAction;
use App\Actions\Tasks\TaskUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\TaskListRequest;
use App\Http\Requests\Tasks\TaskStoreRequest;
use App\Http\Requests\Tasks\TaskUpdateRequest;
use App\Http\Resources\Tasks\TaskResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class TaskController extends Controller
{
   public function index(
       TaskListAction $taskListAction,
       TaskListRequest $request,
   ): AnonymousResourceCollection {
     return TaskResource::collection($taskListAction->execute($request->dto()));
   }

   public function store(
       TaskStoreAction $taskStoreAction,
       TaskStoreRequest $request,
   ): TaskResource
   {
        return new TaskResource($taskStoreAction->execute($request->dto()));
   }

   public function update(
       int $id,
       TaskUpdateAction $taskUpdateAction,
       TaskUpdateRequest $request,
   ): Response {
        $taskUpdateAction->execute($id, $request->dto());

       return response()->noContent();
   }

   public function destroy(
       int $id,
       TaskDestroyAction $taskDestroyAction
   ): Response {
        $taskDestroyAction->execute($id);

       return response()->noContent();
   }
}
