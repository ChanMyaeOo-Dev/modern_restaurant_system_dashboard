<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
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

    public function getQrCode(Request $request)
    {
        $path = public_path('images/' . "gg_qr_test" . '.svg');
        $qr_code = QrCode::size(300)
            ->generate('A simple example of QR code', $path);
    }

    public function store(StoreTableRequest $request)
    {
        $table = new Table();
        $table->name = $request->name;
        // Generate QrCode
        $path = public_path('images/' . "gg_qr_test" . '.svg');
        QrCode::size(300)
            ->generate($request->name, $path);
        $table->qr_code = $path;
        $table->save();
        return back()->with('success_message', 'New Table has been successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        //
    }
}
