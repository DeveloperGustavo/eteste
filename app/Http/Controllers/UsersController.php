<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Mail\SendMailUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(UsersRequest $request)
    {
        $password = str_replace('-', '', now());
        $password = str_replace(':', '', $password);
        $password_encrypt = bcrypt($password = str_replace(' ', '', $password));
        $salario = $this->valorFormated($request->salary);
        $birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        $request->merge([
            'password'  => $password_encrypt,
            'is_admin'  => 0,
            'birthday'  => $birthday,
            'salary'    => $salario
        ]);
        $user = User::create($request->all());
        Mail::to($user->email)->send(new SendMailUser($password));
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $salario = $this->valorFormated($request->salary);
        $birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        $request->merge([
            'salary'    => $salario,
            'birthday'  => $birthday
        ]);
        User::findOrFail($id)->update($request->all());
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('home');
    }

    private function valorFormated($valor)
    {
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        return $valor;
    }
}
