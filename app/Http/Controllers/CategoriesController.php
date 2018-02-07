<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all()->toArray();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $category = $this->validate(request(), [
          'label' => 'required|unique:categories'
        ]);
        
        Category::create($category);

        return redirect('categories')->with('success','Category has been added');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit',compact('category','id'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $this->validate(request(), [
          'label' => 'required'
        ]);
        $category->label = $request->get('label');
        $category->save();
        return redirect('categories')->with('success','Category has been updated');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('categories')->with('success','Category has been  deleted');
    }


}
