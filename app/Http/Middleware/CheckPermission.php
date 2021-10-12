<?php

namespace App\Http\Middleware;

use Closure;
use Str;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //get controllerclassname@method
        $actionName = class_basename($request->route()->getActionname());
        //separate it from '@' character
        $actionName = explode("@",$actionName);
        //get module name from Controller class e.g. ClientsAPIController -> client
        if(Str::contains($actionName[0],'APIController'))
            $module = Str::lower(str_replace("APIController","",$actionName[0]));
        else
            $module = Str::lower(str_replace("sAPIController","",$actionName[0]));

        $action = $actionName[1];
        $permission = $action.'-'.$module;
        $excluded_permissions = [
        ];// Like this - 'changePassword-user'

        if($request->path() == 'api/v1/batch_request' || $request->path() == 'api/v1/auth_batch_request')
            return $next($request);

        if(in_array($permission,$excluded_permissions))
            return $next($request);
        else if($request->user()->tokenCan($permission))//check user permission with his token
            return $next($request); //redirect to requested uri if permitted
        else//reject the requested uri
            return \Illuminate\Support\Facades\Response::make(config('constants.permission.user_has_not_permission'), config('constants.validation_codes.forbidden'));
    }
}
