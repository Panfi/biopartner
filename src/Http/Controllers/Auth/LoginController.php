<?php

namespace biopartnering\biopartnering\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use biopartnering\biopartnering\Models\VerifyUser;
use biopartnering\biopartnering\Models\User;
use Mail;
use \biopartnering\biopartnering\plugins\Mailer;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('biopartnering::auth.login');
    }

    /**
     * @param $token
     * @return mixed
     */
    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        
        if (isset($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->verified) {
                
                $user->verified = 1;
                $user->save();

                $this->sendRegistrationCompleteEmail($user);
            }

            return redirect('/login');

        }

        throw new NotFoundHttpException();
    }

    /**
     * @param $user
     * @return mixed
     */
    private function sendRegistrationCompleteEmail($user)
    {
        $user->subject = "User Verification Complete";
        $user->mail_template = 'biopartnering::emails.user_verification_complete';

        try {
            return Mail::to($user->email)->send(new Mailer($user));
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {

            //Check if account is active
            if (!$this->canLogin($request->input('email'))) {
                $this->logout($request);

                $this->resendVerifyMail($request->input('email'));
                
                return redirect()->back()
                        ->withInput($request->only('email'))
                        ->with(['flash_error' => 'Your email is not verified, please check your email for a verification link!']);

            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param $email
     * @return mixed
     */
    private function resendVerifyMail($email)
    {
        $user = User::where('email', $email)->first();

        $user->subject = "User Verificaion";
        $user->mail_template = 'biopartnering::emails.user_verification';

        $this->updateToken($user->id);

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
    private function updateToken($id)
    {
        return VerifyUser::where('user_id', $id)->update(['token' => str_random(30)]);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function canLogin($email)
    {
        $user = User::where('email', $email)->first();

        if (!isset($user)) {
            throw new AccessDeniedHttpException("You need to create your account first!");
        }

        return $user->verified;
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
                ->withInput($request->only('email'))
                ->with(['flash_error' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');//->with('flash_info', 'Your session has been successfully reset!!');
    }
}
