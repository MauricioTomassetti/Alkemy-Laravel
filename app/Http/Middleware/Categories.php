<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;   

class Categories
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixe
     */
    public function handle($request, Closure $next)
    {
       
       // $category = Category::where('slug',$request->id)->first();
    
       // if ($category->slug == $request->id)
       {
             return $next($request);
          //   }  
         
         }
        }
}
