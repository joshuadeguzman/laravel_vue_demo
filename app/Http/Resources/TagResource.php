<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        // Filter resource via route name
        switch ($request->route()->action["as"]) {
            case 'tags.index': {
                return [
                    'id' => $this->id,
                    'name' => $this->name,
                    'usage' => $this->count
                ];
            }
            case 'tags.task-tags': {
                return [
                    'id' => $this->id,
                    'name' => $this->name,
                ];
            }

            default: {
                return [

                ];
            }
        }
    }
}
