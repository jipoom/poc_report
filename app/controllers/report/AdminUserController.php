<?php

class AdminUserController extends AdminController {


    public function getIndex()
    {
        // Title
     	$title = "แก้ไขบัญชีผู้ใช้";

        // Grab all the blog posts
        $user = User::where('role_id','=',2)->get();

        // Show the page
        return View::make('admin/user/index', compact('user', 'title'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = "เพิ่มผู้ใช้";
        // Show the page
        return View::make('admin/user/create_edit', compact('title'));
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
            'password'	 => 'required|min:6|',
        	'password_confirm' => 'required|same:password' 
        );


        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the blog post data
            $user = new User;
            $user->username  = Input::get('username');
			$user->password  = Input::get('username');
			$user->comment  = Input::get('comment');
			$user->password = Hash::make(Input::get('password'));
			$user->role_id = 2;
            // Was the blog post updated?
            if($user->save())
            {
            	return View::make('closeme');
			}

            // Redirect to the blog post create page
            return Redirect::to('report/admin/user/create')->with('error', 'ไม่สามารถเพิ่มเขตได้');
        }

        // Form validation failed
        return Redirect::to('report/admin/user/create')->withInput()->withErrors($validator);
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
	public function getEdit($userId)
	{
        // Title
        $title = "แก้ไขข้อมูลผู้ใช้";

        // Show the page
        return View::make('admin/user/create_edit', compact('userId','title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $post
     * @return Response
     */
	public function postEdit($userId)
	{
		
        // Declare the rules for the form validation
         $rules = array(
            'password'	 => 'required|min:6|',
        	'password_confirm' => 'required|same:password' 
        );


        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the blog post data
            $user = User::find($userId);
            $user->password  = Hash::make(Input::get('password'));
            // Was the blog post updated?
            if($user->save())
            {
            	return View::make('closeme');
			}

            // Redirect to the blogs post management page
            return Redirect::to('report/admin/user/' . $userId . '/edit')->with('error', 'ไม่สามารถแก้ข้อมูลผู้ใช้ได้');
        }

        // Form validation failed
        return Redirect::to('report/admin/user/' . $userId . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($userId)
    {
        // Title
		
	 	$title = "ลบรายชื่อผู้ใช้";	
        return View::make('admin/user/delete', compact('userId', 'title'));
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($userId)
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
            $id = $userId;
		
            /*$posts = Post::where('category_id','=',$id)->get();
            foreach($posts as $post)
			{
				$post->category_id = 0;
				$post->save();
			}*/
			
            // Was the blog post deleted?
            if(User::find($userId)->delete())
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
        	
        
        $user = User::select(array('id', 'username'))->where('role_id','=',2);

        return Datatables::of($user)

       
        ->add_column('actions', '<a href="{{{ URL::to(\'report/admin/user/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'change pwd\') }}}</a>
                <a href="{{{ URL::to(\'report/admin/user/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}