<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' =>$this->email,
            'mobile_no' =>$this->mobile_no, 
            'role_id' => $this->role_id,
            //'profile' =>$this->profile,
            'gender' => $this->gender,
            'gender_text' =>  config('constants.user.gender.'.$this->gender),
            'dob' => $this->dob,
            'country_id' => $this->country_id,
            'country' => $this->country,
            'state_id' => $this->state_id,
            'state' => $this->state,
            'city_id' => $this->city_id,
            'city' => $this->city,
            'address' => $this->address,
            'status' => $this->status,
            //'status_text' => config('constants.user.status.'.$this->status),
            'gallery' => $this->user_galleries,
            'hobby' => $this->hobbies,
            //'role' => $this->role,
            //'email_verified_at' =>$this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];       return parent::toArray($request);
    }
}
