<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelName;

class ModelNameController extends Controller
{
    public function index(Request $request)
    {
        $models = ModelName::orderBy('name', 'ASC')->paginate(15);

        return view('backend.model.index', compact('models'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:model_names,name',
        ]);

        ModelName::create(['name' => $request->name]);

        flash('Model has been created successfully')->success();
        return redirect()->route('model-names.index');
    }

    public function edit($id)
    {
        $model = ModelName::findOrFail($id);
        return view('backend.model.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $model = ModelName::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:model_names,name,' . $model->id,
        ]);

        $model->update(['name' => $request->name]);

        flash('Model has been updated successfully')->success();
        return redirect()->route('model-names.index');
    }

    public function destroy($id)
    {
        ModelName::destroy($id);
        flash('Model has been deleted successfully')->success();
        return redirect()->route('model-names.index');
    }
}
