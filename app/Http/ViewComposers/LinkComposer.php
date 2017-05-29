<?php

namespace App\Http\ViewComposers;

use App\Category;
use App\Link;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

/**
 * Class LinkComposer
 * @package App\Http\ViewComposers
 */
class LinkComposer
{
    /**
     * @var Link
     */
    protected $links;
    /**
     * @var Category
     */
    protected $category;
    /**
     * LinkComposer constructor.
     * @param $links
     */
    public function __construct(Link $links,Category $category)
    {
        $this->links = $links;
        $this->category = $category;
    }

    /**
     * @param View $view
     */
    public function compose(View $view){
        $link = Cache::remember('link',10,function (){
            return $this->links->get();
        });
        $category = Cache::remember('category',10,function (){
            return $this->category->get();
        });
        $view->with('links',$link);
        $view->with('category',$category);
    }

}