<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = Point::latest()->paginate(5);
      
        return view('point.index',compact('points'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('point.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'x' => 'required',
            'y' => 'required',
        ]);
      
        Point::create($request->all());
       
        return redirect()->route('points.index')
                        ->with('success','Point created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        return view('point.edit',compact('point'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
        $request->validate([
            'name' => 'required',
            'x' => 'required',
            'y' => 'required',
        ]);
      
        $point->update($request->all());
      
        return redirect()->route('points.index')
                        ->with('success','Point updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        $point->delete();
       
        return redirect()->route('points.index')
                        ->with('success','Point deleted successfully');
    }

    public function process(Request $request)
    {
         $x = $request->get('x');
         $y = $request->get('y');
         $intervalPoints = DB::select('SELECT ROUND((57.3 * acos(cos(radians(?)) * cos(radians(x)) * cos( radians(y) - radians(?)) + sin(radians(?)) * sin(radians(x)))),2) AS distance FROM points having distance > 0 order by distance', [$x, $y, $x]);
         $pointCounts = count($intervalPoints);
         $lowestPointDistance = $intervalPoints[0]->distance;
         $farthestPointDistance = $intervalPoints[$pointCounts - 1]->distance;
         $nearerPointDB = DB::select('SELECT ROUND((57.3 * acos(cos(radians(?)) * cos(radians(x)) * cos( radians(y) - radians(?)) + sin(radians(?)) * sin(radians(x)))),2) AS distance,name, x,y FROM points having distance = ? order by distance', [$x, $y, $x, $lowestPointDistance]);
         $farthestPointDB = DB::select('SELECT ROUND((57.3 * acos(cos(radians(?)) * cos(radians(x)) * cos( radians(y) - radians(?)) + sin(radians(?)) * sin(radians(x)))),2) AS distance,name, x,y FROM points having distance = ? order by distance', [$x, $y, $x, $farthestPointDistance]);
         
         $farthestPoints = $farthestPointDB;
         $nearerPoints = $nearerPointDB;

        //  $farthestPoint = ["x"=> $farthestPointSingle->x, "y"=>$farthestPointSingle->y, "name"=>$farthestPointSingle->name];
        //  $lowestPoint =  ["x"=> $lowestPointSingle->x, "y"=>$lowestPointSingle->y, "name"=>$lowestPointSingle->name];
         return [
                "farthestPoint" => $farthestPoints, 
                "nearerPoint"=> $nearerPoints
        ];
    }
}
