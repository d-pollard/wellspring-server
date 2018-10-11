<?php
/**
 * Created by IntelliJ IDEA.
 * User: derek - dpollard@mail.bradley.edu
 * Date: 10/11/18
 * Time: 12:52 PM
 */

namespace App\Http\Controllers;


use App\Models\Trains;
use Illuminate\Http\Request;
use Validator;

class TrainsController
{
    public function index(): array
    {
        return Trains::paginate(5)->toArray();
    }

    public function create(Request $request): array
    {
        $validation = Validator::make($request->all(), [
            'line'     => 'required',
            'route'    => 'required',
            'run'      => 'required',
            'operator' => 'required',
        ]);

        if ($validation->fails()) return ['success' => false, 'errors' => $validation->errors()];

        $train = new Trains;
            $train->line     = $request->input('line');
            $train->route    = $request->input('route');
            $train->run      = $request->input('run');
            $train->operator = $request->input('operator');
        $train->save();

        return ['success' => true];
    }

    public function view(int $trainId): array
    {
        $train = Trains::find($trainId);

        return [
            'success' => $train !== null,
            'train'   => $train
        ];

    }

    public function update(int $trainId, Request $request): array
    {
        $validation = Validator::make($request->all(), [
            'id'       => 'required|exists:trains',
            'line'     => 'required',
            'route'    => 'required',
            'run'      => 'required',
            'operator' => 'required',
        ]);

        if (
            $validation->fails() ||
            $trainId !== intval($request->input('id'))
        ) return ['success' => false, 'errors' => $validation->errors()];

        $train = Trains::find($request->input('id'));
            $train->line     = $request->input('line');
            $train->route    = $request->input('route');
            $train->run      = $request->input('run');
            $train->operator = $request->input('operator');
        $train->save();

        return ['success' => true];
    }

    public function delete(int $trainId): array
    {
        $train = Trains::find($trainId);

        if ($train !== null) $train->delete();

        return ['success' => true];

    }
}
