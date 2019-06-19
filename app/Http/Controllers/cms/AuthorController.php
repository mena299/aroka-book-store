<?php

namespace App\Http\Controllers\cms;

use App\Http\Requests\Author as AuthorRequest;
use App\Model\Author;
use App\Model\AuthorPenname;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AuthorController extends Controller
{
    public function destroy($id)
    {
        $author = Author::whereId($id)->first();

        if (!$author) {
            return redirect('cms/authors/list?status=error');
        }

        try {
            AuthorPenname::where('author_id',$id)->delete();
            Author::whereId($id)->delete();

        } catch (\Exception $e) {
            \Log::error($e);
            return redirect('cms/authors/list?status=error');
        }

        return redirect('cms/authors/list?status=success');

    }

    public function store(AuthorRequest $request)
    {
        $id = $request->has('author_id') ? $request->input('author_id') : null;
        $authorName = $request->input('author_name');
        $bankName = $request->input('author_bank_name');
        $bankAccount = $request->input('author_bank_account');

        $now = Carbon::now();
        try {

            $author = Author::whereId($id)->first();
            if ($id === null) {
                $author = new Author();
                $author->created_at = $now;
            }

            $author->name = $authorName;
            $author->bank_name = $bankName;
            $author->bank_account = $bankAccount;
            $author->updated_at = $now;
            $author->save();

        } catch (\Exception $e) {
            \Log::error($e);
            return redirect('cms/authors/list?status=error');
        }

        return redirect('cms/authors/list?status=success');
    }

    public function index(Request $request)
    {
        $author = Author::select('id', 'name', 'bank_name', 'bank_account')->paginate(30);
        $header = ['id', 'author', 'Precess'];

        $data = [
            'header' => $header,
            'authors' => $author,
        ];

        return view('cms.authors.author')->with($data);
    }
}
