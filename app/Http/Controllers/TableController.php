<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Http\Resources\TableResource;
use App\Models\Table;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('tables.index', compact('tables'));
    }

    public function store(StoreTableRequest $request)
    {
        $table = new Table();
        // want to limit last 6 digit
        $table_id =  substr(round(microtime(true) * 1000), -6);
        $table->id = $table_id;
        $table->name = $request->name;
        $table_name = str_replace(' ', '', $request->name);
        // Generate QrCode
        // $path = "qr_codes/table_qr_" . $request->name . "_" . time() . '.svg';
        $filename = "table_qr_" . $request->name . "_" . time() . '.svg';
        $path = public_path('qr_codes/' . $filename);
        // 192.168.211.223
        // 192.168.47.246
        QrCode::size(300)
            ->generate("http://192.168.211.223:3000/table/" . $table_id . '?name=' . $table_name, $path);
        $table->qr_code = $filename;
        $table->save();
        return back()->with('success_message', 'New Table has been successfully saved.');
    }

    public function show(Table $table)
    {
        return view('tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTableRequest  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        //
    }

    public function destroy(Table $table)
    {
        if ($table->qr_code) {
            $path = public_path('qr_codes/' . $table->qr_code);
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $table->delete();
        return back()->with('success_message', 'Table has been successfully deleted.');
    }
}
