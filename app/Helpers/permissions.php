<?php 

function checkUserPermissions($request, $actionName = NULL, $id = NULL) {
    // Get current user 
    $currentUser = $request->user();
    
    // Get current action method
    if($actionName) {
        $currentActionName = $actionName;
    } else {
        $currentActionName = $request->route()->getActionName();
    }
    
    list($controller, $method) = explode('@', $currentActionName);
    $controller = str_replace(["App\\Http\\Controllers\\Backend\\", 'Controller'], '', $controller);
    
    $classesMap = [
        'Posts' => 'post',
        'Categories' => 'category',
        'Users' => 'user'
    ];
    
    $crudPermissionsMap = [
        // 'create' => ['create', 'store'],
        // 'update' => ['edit', 'update'],
        // 'delete' => ['destroy', 'restore', 'delete'],
        // 'read' => ['index', 'view']
        'crud' => ['create','store','edit','update','destroy','restore','delete','index','view']
    ];

    foreach($crudPermissionsMap as $permission => $methods) {
        /**
         * If the current method exists in methods list
         * we'll check the permission
         */
        if(in_array($method, $methods) && isset($classesMap[$controller])) {
            $className = $classesMap[$controller];
            
            if($className == 'post' && in_array($method, ['edit', 'update', 'destroy', 'restore', 'delete'])) {
                
                $id = !is_null($id) ? $id : $request->route('id');
                /** 
                 * If the user doesn't have update-others-post/delete-others-post permission 
                 * Make sure he/she only modify his/her own posts
                */
                if($id && (!$currentUser->can('update-others-post') || !$currentUser->can('delete-others-post'))) {
                    $post = \App\Post::withTrashed()->findOrFail($id);
                    
                    /**
                     * If current user isn't author of specific post
                     */
                    if($post->author->id !== $currentUser->id)
                        return false;
                     
                }
                
            }
            
            /** 
             * If the user doesnt have permission don't allow next request 
             * */
            if(!$currentUser->can("{$permission}-{$className}")) {
                return false;
            }
            
            break;
        }
    }
    
    return true;
}
