<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'bedroom' => $this->bedroom,
            'bathroom' => $this->bathroom,
            'property_type' => $this->type->type,
            'status' => $this->status->status,
            'for_sale' => $this->for_sale ? 'Yes' : 'No',
            'for_rent' => $this->for_rent ? 'Yes' : 'No',
            'project_name' => $this->project->name,
            'country' => $this->region->country->country
        ];
    }
}
