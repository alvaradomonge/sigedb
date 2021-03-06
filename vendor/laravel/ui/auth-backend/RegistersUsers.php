<?php

namespace Illuminate\Foundation\Auth;

use App\Http\Controllers\AdminController;
use App\Models\grupo_guia;
use App\Models\rubro;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    public function registerEstudiante(Request $request, grupo_guia $grupo_guia)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $grupo_guia->estudiantes()->save($user);
        foreach($grupo_guia->materias as $materia){
            $materia->promedio_estudiante()->save($user);
            foreach($materia->rubros as $rubro){
                foreach($rubro->asignaciones as $asignacion){
                     $asignacion->nota()->save($user,['id_materia'=>$rubro->materia->id,'id_rubro'=>$rubro->id]);
                }
            }
        }
        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect()->route('admin.gruposEstudiantes',$grupo_guia)->with('status','Estudiante nuevo añadido exitósamente');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
