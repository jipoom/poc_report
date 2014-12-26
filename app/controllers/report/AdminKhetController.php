<?php

class AdminKhetController extends AdminController {


    public function getIndex()
    {
        // Title
     	$title = "แก้ไขเขต";

        // Grab all the blog posts
        $khet = Khet::all();

        // Show the page
        return View::make('admin/khet/index', compact('khet', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = "เพิ่มเขต";
        // Show the page
        return View::make('admin/khet/create_edit', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
        // Declare the rules for the form validation
         $rules = array(
            'khet'   => 'required|min:3|unique:khets,name',
        );


        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the blog post data
            $khet = new Khet;
            $khet->name  = Input::get('khet');
            // Was the blog post updated?
            if($khet->save())
            {
            	return View::make('closeme');
			}

            // Redirect to the blog post create page
            return Redirect::to('report/admin/khet/create')->with('error', 'ไม่สามารถเพิ่มเขตได้');
        }

        // Form validation failed
        return Redirect::to('report/admin/khet/create')->withInput()->withErrors($validator);
    }

    /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getShow($category)
	{
        // redirect to the frontend
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getEdit($khetId)
	{
        // Title
        $title = "แก้ไขเขต";

        // Show the page
        return View::make('admin/khet/create_edit', compact('khetId','title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $post
     * @return Response
     */
	public function postEdit($khetId)
	{
		
        // Declare the rules for the form validation
         $rules = array(
            'khet'   => 'required|min:3|unique:khets,name,'.$khetId.',id',
        );


        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the blog post data
            $khet = Khet::find($khetId);
            $khet->name  = Input::get('khet');
            // Was the blog post updated?
            if($khet->save())
            {
            	return View::make('closeme');
			}

            // Redirect to the blogs post management page
            return Redirect::to('report/admin/khet/' . $khetId . '/edit')->with('error', 'ไม่สามารถแก้ไขเขตได้');
        }

        // Form validation failed
        return Redirect::to('report/admin/khet/' . $khetId . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($khetId)
    {
        // Title
		
        if(count(Location::where('khet_id','=',$khetId)->get()) > 0)
		{
			$title = "ลบไม่ได้";
			return View::make('admin/khet/delete_no', compact('khetId', 'title'));
		}
		else{
	 		$title = "ลบเขต";	
        	return View::make('admin/khet/delete', compact('khetId', 'title'));
		}
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($khetId)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $khetId;
		
            /*$posts = Post::where('category_id','=',$id)->get();
            foreach($posts as $post)
			{
				$post->category_id = 0;
				$post->save();
			}*/
			
            // Was the blog post deleted?
            if(Khet::find($khetId)->delete())
            {
                // Redirect to the blog posts management page
                return View::make('closeme');
            }
        }
        // There was a problem deleting the blog post
        //return Redirect::to('admin/category')->with('error', Lang::get('admin/category/messages.delete.error'));
    }

       /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
   {
        	
        
        $khet = Khet::select(array('id', 'name'));

        return Datatables::of($khet)

       
        ->add_column('actions', '<a href="{{{ URL::to(\'report/admin/khet/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'edit\') }}}</a>
                <a href="{{{ URL::to(\'report/admin/khet/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}