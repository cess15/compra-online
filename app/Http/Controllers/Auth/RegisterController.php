<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Person;
use App\Models\Seller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\MailService;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    private $mailService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MailService $mailService)
    {
        $this->middleware('guest');
        $this->mailService = $mailService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'role' => ['required', 'integer','not_in:0'],
            'per_name' => ['required', 'string', 'max:255'],
            'per_second_name' => ['required', 'string', 'max:255'],
            'per_lastname' => ['required', 'string', 'max:255'],
            'per_second_lastname' => ['required', 'string', 'max:255'],
            'pers_identification' => ['required', 'string', 'max:10', 'unique:people,pers_identification'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try {

            $user = new User();
            $user->role_id = $data['role'];
            $user->email = $data['email'];
            $user->username = $data['pers_identification'];
            $user->password = Hash::make($data['pers_identification']);
            $user->save();

            $person = new Person();
            $person->per_name = $data['per_name'];
            $person->per_second_name = $data['per_second_name'];
            $person->per_lastname = $data['per_lastname'];
            $person->per_second_lastname = $data['per_second_lastname'];
            $person->pers_identification = $data['pers_identification'];
            $person->user_id = $user->id;
            $person->save();

            if($data['role'] == 2)
                Seller::create(['person_id' => $person->id]);

            if($data['role'] == 3)
                Buyer::create(['person_id' => $person->id]);

            $params = [
                "subject"   => "Registro de usuario",
                "view"      => "mails.register",
                "to" => array(
                    ["name" => NULL, "email" => $data['email']]
                ),
                "params" => [
                    "USERNAME" => $user->username,
                    "PASSWORD" => $person->pers_identification,
                    "APP_NAME" => env('APP_NAME'),
                    "DATE" => date('Y'),
                ],
            ];

            $this->mailService->sendMail($params);
            DB::commit();
            return $user;

        } catch (Throwable $ex) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('msg', $ex->getMessage());
        }
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }
}
