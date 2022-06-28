<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        $perPage = $request->get('perPage');
        try {
            $data = User::select('name', 'emails')->paginate($perPage);
            return UserResource::collection($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage(),[request()->user()]);
            return $this->ErrorResponse("Gagal mengambil data",$e->getCode());
        }
    }
}
