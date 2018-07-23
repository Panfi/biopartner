<?php

namespace biopartnering\biopartnering\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Mail;
use \biopartnering\biopartnering\plugins\Mailer;
use biopartnering\biopartnering\Models\VerifyUser;
use biopartnering\biopartnering\Models\User;

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
    protected $redirectTo = '/register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('biopartnering::auth.register');
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        $user->subject = "User Verificaion";
        $user->mail_template = 'biopartnering::emails.user_verification';

        $this->sendVerifyMail($user);

        return redirect($this->redirectPath())->with('flash_info', 'Check your email for a verification link!');
    }

    /**
     * @param $user
     * @return mixed
     */
    private function sendVerifyMail($user)
    {
        $this->createToken($user->id);

        try {
            return Mail::to($user->email)->send(new Mailer($user));
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage(), 500);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    private function createToken($id)
    {
        return VerifyUser::create([
            'user_id' => $id,
            'token' => str_random(30)
        ]);
    }
}
