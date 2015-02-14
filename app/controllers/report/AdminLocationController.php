<?php

class AdminLocationController extends AdminController {


    public function getIndex()
    {
        // Title
     	$title = "แก้ไขเรือนจำ";

        // Grab all the blog posts
        $location = Location::all();

        // Show the page
        return View::make('admin/location/index', compact('location', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = "เพิ่มเรือนจำ";
        // Show the page
        return View::make('admin/location/create_edit', compact('title'));
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
         	'username'   => 'required|min:3|unique:users,username',
            'location_name'   => 'required|min:3|unique:locations,name',
            'location_fullname'   => 'required|min:3|unique:locations,fullname',
            'password'         => 'required',
        	'password_confirm' => 'required|same:password',
        	'khet_id' => 'not_in:0' 
        );


        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes() && Input::get('khet_id') != 0)
        {
            // Update the blog post data
            $location = new Location;
            $location->name  = Input::get('location_name');
			$location->fullname  = Input::get('location_fullname');
			$location->khet_id = Input::get('khet_id');
            // Was the blog post updated?
            if($location->save())
            {
            	User::add(Input::get('username'),Input::get('password'),Input::get('location_name'));
            	return View::make('closeme');
			}

            // Redirect to the blog post create page
            return Redirect::to('report/admin/location/create')->with('error', 'ไม่สามารถเพิ่มเรือนจำได้');
        }

        // Form validation failed
        return Redirect::to('report/admin/location/create')->withInput()->withErrors($validator);
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
	public function getEdit($locationId)
	{
        // Title
        $title = "แก้ไขเรือนจำ";

        // Show the page
        return View::make('admin/location/create_edit', compact('locationId','title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $post
     * @return Response
     */
	public function postEdit($locationId)
	{
		 $user = User::where('location_id','=',$locationId)->first();
        // Declare the rules for the form validation
         $rules = array(
         	'username'   => 'required|min:3|unique:users,username,'.$user->id.',id',
            'location_name'   => 'required|min:3|unique:locations,name,'.$locationId.',id',
            'location_fullname'   => 'required|min:3|unique:locations,fullname,'.$locationId.',id',
 			'khet_id' => 'not_in:0' 
        );



        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes() && Input::get('password') == Input::get('password_confirm'))
        {
            // Update the blog post data
            $location = Location::find($locationId);
			$previousKhetId = $location->khet_id;
            $location->name  = Input::get('location_name');
			$location->fullname  = Input::get('location_fullname');
			$location->khet_id = Input::get('khet_id');
            // Was the blog post updated?
            if($location->save())
            {
            	$user->username = 	Input::get('username');
				if(Input::get('password')!="")
					$user->password	= Hash::make(Input::get('password'));
				$user->save();
				
				// if khet id is changed
				if($previousKhetId != Input::get('khet_id'))
				{
					$report = Report::where('location_id','=',$locationId);
					$report->khet_id = Input::get('khet_id');
				}
				
            	return View::make('closeme');
			}

            // Redirect to the blogs post management page
            return Redirect::to('report/admin/location/' . $locationId . '/edit')->with('error', 'ไม่สามารถแก้ไขเขตได้');
        }

        // Form validation failed
        if (Input::get('password') != Input::get('password_confirm'))
				return Redirect::to('report/admin/location/' . $locationId . '/edit')->withInput()->with('password', 'กรุณากรอกยืนยันรหัสผ่านให้ถูกต้อง');
			else if ($validator->passes())
        		return Redirect::to('report/admin/location/' . $locationId . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($locationId)
    {
        // Title
		
        if(count(Report::where('location_id','=',$locationId)->get()) > 0)
		{
			$title = "คำเตือน";
			return View::make('admin/location/delete_warning', compact('locationId', 'title'));
		}
		else{
	 		$title = "ลบเรือนจำ";	
        	return View::make('admin/location/delete', compact('locationId', 'title'));
		}
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($locationId)
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
            $id = $locationId;
		
            /*$posts = Post::where('category_id','=',$id)->get();
            foreach($posts as $post)
			{
				$post->category_id = 0;
				$post->save();
			}*/
			
            // Was the blog post deleted?
            if(Location::where('id','=',$locationId)->delete())
            {
                if(User::where('location_id','=',$id)->delete())
				{
					if(Report::where('location_id','=',$id)->delete())
						return View::make('closeme');
                		// Redirect to the blog posts management page
                	return View::make('closeme');
				}
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
        	
       
        $khet = Location::leftjoin('users', 'users.location_id', '=', 'locations.id')->where('role_id','=',3)->select(array('locations.id', 'locations.name'));

        return Datatables::of($khet)

       
        ->add_column('actions', '<a href="{{{ URL::to(\'report/admin/location/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'edit\') }}}</a>
                <a href="{{{ URL::to(\'report/admin/location/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}