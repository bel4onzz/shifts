<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use App\Imports\ShiftsImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ShiftPutRequest;

class ShiftController extends Controller
{
    // public function import(Request $request)
    // {
    //     Excel::import(new ShiftsImport, $request->file);

    //     return redirect('/')->with('success', 'All good!');
    // }
    public function upload(Request $request)
    {
        Excel::import(new ShiftsImport, $request->file);
        return Shift::select('employee')
            ->groupBy('employee')
            ->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd("SHIFTS", $request->all());
        $employee = Shift::select('employee')
            ->groupBy('employee')
            ->get();

        $page = 1;
        if(array_key_exists('page', $request->all())){
            $page = $request['page'];
        }
        $size = 10;
        if(array_key_exists('size', $request->all())){
            $size = $request['size'];
        }

        $shifts = new Shift;
        if(array_key_exists('search_query', $request->all())){
            $shifts = $shifts->select("*", DB::raw('(SUBSTRING(rate_per_hours,2) * hours) as total_pay'))->having('total_pay', '>',(int) $request['search_query']);
        }

        $total_records = $shifts->count();
        $shifts = $shifts->skip(($page - 1)*$size)->take($size);

        return response()->json([
            'employee' => $employee,
            'shifts' => $shifts->get(),
            'total' => $total_records
        ]);
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
    public function store(Request $request)
    {
        // dd("STORESTORE");
        return Shift::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        //
        $get_shift_types = $this->get_shift_types();
        $get_shift_statuses = $this->get_shift_statuses();

        $response = [
            'shift_types' => $get_shift_types,
            'shift_statuses' => $get_shift_statuses,
            'shift' => $shift,
        ];
        return $response;
    }
    public function get_shift_types()
    {
        return Shift::select('shift_type')->groupBy('shift_type')->get();
    }
    public function get_shift_statuses()
    {
        return Shift::select('status')->groupBy('status')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(ShiftPutRequest $request, Shift $shift)
    {
        $updated = $shift->update($request->all());
        return $updated;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        return $shift->delete();
    }

    public function truncate()
    {
        Shift::truncate();
        return Shift::take(5)->get();
    }

    public function employee(Request $request)
    {
        if ($request->name) {
            $employee_db = Shift::where('employee', str_replace('+', ' ', $request->name));
            $employee_shifts = $employee_db->get();

            $employee_avg_pay_per_hour = $employee_db->get()->avg('rate_per_hours');

            $total_rate = 0;
            foreach ($employee_shifts as $key => $value) {
                $total_rate += $value->hours * $value->rate_per_hours;
            }
            $employee_total_pay = $total_rate / $employee_shifts->count();

            $last_completed_payments = $employee_db->where('status', 'Complete')->orderBy('paid_at', 'desc')->take(5)->get();
            $response = [
                'name' => str_replace('+', ' ', $request->name),
                'avg_pay_hour' => number_format($employee_avg_pay_per_hour, 2),
                'avg_total_pey' => number_format($employee_total_pay, 2),
                'last_completed_payments' => $last_completed_payments
            ];
            return $response;
        }
        return response()->json([
            'message' => 'BAD REQUEST'
        ]);
    }
}
