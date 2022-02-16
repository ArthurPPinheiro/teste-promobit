<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Tags\Entities\Tag;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // SELECT
        //     tag_id,
        //     name,
        //     products_count
        // FROM
        //     (
        //     SELECT
        //         tag_id,
        //         COUNT(product_id) AS products_count
        //     FROM
        //         `product_tag`
        //     GROUP BY
        //         tag_id
        // ) AS temp
        // RIGHT JOIN tag ON tag_id = id

        $tags = Tag::all();

        foreach($tags as $tag) {
            $reports[$tag->id] = $tag->products()->count();
        }

        $tags = Tag::get()->keyBy('id')->toArray();

        return view('dashboard', compact('reports', 'tags'));
    }
}
