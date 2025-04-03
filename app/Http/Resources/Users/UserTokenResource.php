<?php
namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTokenResource extends JsonResource
{
    protected ?string $token = null;

    public function withToken(string $token): static
    {
        $this->token = $token;
        return $this;
    }
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->token,
        ];
    }
}
