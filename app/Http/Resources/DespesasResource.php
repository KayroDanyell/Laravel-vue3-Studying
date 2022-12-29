<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class DespesasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'short_desc'=> Str::limit($this->desc,10),
            'desc'=> $this->desc,
            'data'=> Carbon::createFromTimestamp($this->data)->format('d/m/Y'),
            'user'=> UserResource::make($this->User),
            'valor' => $this->valor
        ];
        //return parent::toArray($request);
    }
}
