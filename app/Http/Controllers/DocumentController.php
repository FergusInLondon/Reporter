<?php

namespace App\Http\Controllers;

use App\Entities\Document\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;

class DocumentController extends Controller
{
    private $documentRepository;

    public __construct(DocumentRepositoryInterface $docRepo) {
        $this->documentRepository = $docRepo;
    }

    private function checkUserOwnsDocument(Request $request, Document $document) {
        return $request->user()->id == $document->user_id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->documentRepository->getAllForUser($request->user);
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
        if (!$this->checkUserOwnsDocument($req, $document)) {
            return response()->noContent(Response::HTTP_UNAUTHORIZED);
        }

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
        if (!$this->checkUserOwnsDocument($req, $document)) {
            return response()->noContent(Response::HTTP_UNAUTHORIZED);
        }

        if (!$document->validateAndFill($req->all())) {
            return $model->errors();
        }

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
        if (!$this->checkUserOwnsDocument($req, $document)) {
            return response()->noContent(Response::HTTP_UNAUTHORIZED);
        }

        return $document->delete();
    }
}
