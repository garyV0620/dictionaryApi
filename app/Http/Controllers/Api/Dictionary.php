<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PostRequest;
use App\Http\Resources\Dictionary as ResourcesDictionary;
use App\Models\Author;
use App\Models\Dictionary as ModelsDictionary;
use Illuminate\Http\Request;

//Extend it to the BaseController to use the sendResponse and SendError that you created
class Dictionary extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all datas from Dictionary model
        $words = ModelsDictionary::all();

        // send the data using the resource that you made(use ::collection() if multiple data is fetch)
        return $this->sendResponse(ResourcesDictionary::collection($words), "ALL WORDS ARE FETCH");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //validate all your data base on the rules on the resource that you made
        $validated = $request->validated();
        //save datas to the DB (it will only use input with the same name on the table)
        $word = ModelsDictionary::create($validated);
        $author_id = [];
        //save each author but if author has identical info do not save
        foreach($validated['authors'] as $author){
            $authorSave = Author::updateOrCreate($author);
            $author_id[] = $authorSave->id;
        }
        // this will save datas to the pivot table using the many to many relationship (attach() for insert data)
        $word->authors()->attach($author_id);
        return $this->sendResponse(new ResourcesDictionary($word), "WORD SUCCESSFULLY SAVE");   
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(ctype_digit($id)){
            $word = ModelsDictionary::find($id);
        }else{
            $word = ModelsDictionary::where('word',$id)->first();
        }
    
        if(is_null($word)){
            return $this->sendError("WORD DOES NOT EXIST");
        }
        
        return $this->sendResponse(new ResourcesDictionary($word), "WORD SUCCESSFULLY FETCH");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $word = ModelsDictionary::find($id);
        if(!$word){
            return $this->sendError("WORD DOES NOT EXIST");
        }
        $word->update($request->only('word','meaning'));

        if(isset($request->authors)){
            $author_id = [];
            foreach($request->input('authors') as $author){
                $authorSave = Author::updateOrCreate($author);
                $author_id[] = $authorSave->id;
            }
            //update the pivot table (sync() for update)
            $word->authors()->sync($author_id);
        }
       
        return $this->sendResponse(new ResourcesDictionary($word),"WORD SUCCESSFULLY UPDATED");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $word = ModelsDictionary::find($id);

        if(!$word){
            return $this->sendError("WORD DOES NOT EXIST");
        }
        //delete the data (pivot table will also be delete since it is cascade on delete) 
        $word->delete();

        return $this->sendResponse([],"WORD SUCCESSFULLY DELETED");
    }
}
