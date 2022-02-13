<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{

    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'categories' => $this->categories,
            'author' => $this->author,
            'image_url' => $this->image_url,
            'release_data' => $this->release_data,
            'project_url' => $this->project_url,
            'project_version' => $this->project_version,
            'description' => $this->description,
        ];
    }

}
