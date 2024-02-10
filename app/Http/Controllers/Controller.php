<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function saveRevisionHistory($model, $action)
    {
        $model->save();

        $model->revisionHistory()->create([
            'user_id' => auth()->user()->id,
            'key' => $action,
            'old_value' => $model->getOriginal(),
            'new_value' => $model->getAttributes(),
        ]);
    }
    public function showrevisionHistory($id)
    {
        $meeting = Meeting::find($id);

        if (!$meeting) {
            return redirect()->route('home')->with('error', 'Pertemuan tidak ditemukan.');
        }

        $revisionHistory = $meeting->revisionHistory;

        return view('meetingRevisionHistory', [
            'meeting' => $meeting,
            'revisionHistory' => $revisionHistory,
        ]);
    }
}
