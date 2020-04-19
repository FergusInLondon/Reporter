<?php namespace App\Http\Controllers;

use App\Entities\Document\Document;
use App\Entities\Document\RepositoryInterface as DocumentRepository;
use App\Entities\Document\SearchQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Exceptions\UnauthorisedAccessException;

class DocumentController extends Controller
{
    private $documentRepository;

    public function __construct(DocumentRepository $docRepo) {
        $this->documentRepository = $docRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->documentRepository->getAllForCurrentUser(new SearchQuery($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $model = new Document();
        if (!$model->validateAndFill($req->all())) {
            // Return failure code
            return $model->errors();
        }

        return $req->user()->documents()->save($model);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req, Document $document)
    {
        return $document;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $documentument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Document $document)
    {
        $document->save();
        return $document;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $documentument
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req, Document $document)
    {
        return $document->delete();
    }
}
