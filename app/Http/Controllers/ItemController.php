<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiTrait;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    use ApiTrait;

    public function index()
    {
        $items = Item::query()->latest()->paginate(5);
        return $this->listResponse($items);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'completed' => 'boolean',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->messages());
        }

        $item = new Item;
        $item->name = $request->name;
        $item->save();

        return $this->createdResponse($item);
    }

    public function show($id)
    {
        $item = Item::query()->find($id);
        if (!$item) {
            return $this->notFoundResponse();
        }
        return $this->showResponse($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::query()->find($id);
        if (!$item) {
            return $this->notFoundResponse();
        }

        $item->name = $request->name;
        $item->save();
        return $this->updatedResponse($item);
    }

    public function destroy($id)
    {
        $item = Item::query()->find($id);
        if (!$item) {
            return $this->notFoundResponse();
        }
        $item->delete();
        return $this->deletedResponse();
    }

    public function changeStatus(Request $request)
    {
        $item = Item::query()->find($request->id);
        if (!$item) {
            return $this->notFoundResponse();
        }
        $status = $item->completed == 1 ? 0 : 1;
        $item->completed = $status;
        $item->completed_at = Carbon::now();
        $item->save();
        return $this->updatedResponse($item);
    }
}
