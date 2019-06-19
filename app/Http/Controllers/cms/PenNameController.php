<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests\Penname;
use App\Model\Author;
use App\Model\AuthorPenname;
use App\Model\Penname as PennameModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenNameController extends Controller
{
    public function index()
    {
        $author = Author::select('id', 'name')->get();
        $penname = PennameModel::leftJoin('author_pen_name', function ($q) {
            $q->on('author_pen_name.pen_name_id', '=', 'pen_names.id');
        })->leftJoin('authors', function ($q) {
            $q->on('authors.id', '=', 'author_pen_name.author_id');
        })->select('pen_names.id', 'pen_names.pen_name', 'authors.name as author_name', 'authors.id as author_id')
            ->orderBy('id', 'ASC')
            ->paginate(30);
        $header = ['id', 'pen_name', 'author', 'Precess'];

        $data = [
            'header' => $header,
            'authors' => $author,
            'pennames' => $penname,
        ];


        return view('cms.authors.penname')->with($data);
    }

    public function store(Penname $request)
    {
        $id = $request->has('penname_id') ? $request->input('penname_id') : null;
        $name = $request->input('penname');
        $penname = new PennameModel();
        if ($id !== null) {
            $penname = PennameModel::whereId($id)->first();
        } elseif ($id === null && PennameModel::wherePenName($name)->first()) {
            \Log::error('Pen Name is duplicate');
            return redirect('cms/authors/pen-names/list?status=error');
        }

        try {
            $penname->pen_name = $name;
            $penname->save();
            \Log::debug($id);

            AuthorPenname::where('pen_name_id', $id)
                ->delete();

            if ($request->input('author') != 0) {
                $authorPenname = new AuthorPenname();
                $authorPenname->author_id = $request->input('author');
                $authorPenname->pen_name_id = $penname->id;
                $authorPenname->save();
            }

        } catch (\Exception $e) {
            \Log::error($e);
            return redirect('cms/authors/pen-names/list?status=error');
        }

        return redirect('cms/authors/pen-names/list?status=success');

    }


    public function destroy($id)
    {
        $penname = PennameModel::whereId($id)->first();

        if (!$penname) {
            return redirect('cms/authors/pen-names/list?status=error');
        }

        try {
            AuthorPenname::where('pen_name_id',$id)->delete();
            PennameModel::whereId($id)->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            return redirect('cms/authors/pen-names/list?status=error');
        }

        return redirect('cms/authors/pen-names/list?status=success');
    }
}
