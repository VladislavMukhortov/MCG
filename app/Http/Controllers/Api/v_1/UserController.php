<?php

namespace App\Http\Controllers\Api\v_1;

use App\Mail\Email;
use App\Models\Leads;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Redirect;
use URL;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Http\Requests\UserFormRequest;
use App\Repositories\ContactRepositoryEloquent;
use App\Repositories\UserRepositoryRepositoryEloquent;
use App\Repositories\ClientRepositoryEloquent;
class UserController extends Controller
{

    /**
     * @var UserRepositoryRepositoryEloquent
     */
    protected $userRepository;

    protected $contactRepository;

    protected $clientRepository;

    public function __construct(UserRepositoryRepositoryEloquent $userRepository,
                                ContactRepositoryEloquent $contactRepository,
                                ClientRepositoryEloquent $clientRepository){
        $this->userRepository = $userRepository;
        $this->contactRepository=$contactRepository;
        $this->clientRepository=$clientRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= $this->userRepository->all();

        return response()->json([
            'users' => $users,
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = \Bouncer::role()->all();

        return response()->json([
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $data=$request->all();
        $contact=$this->contactRepository->fill($data);
        
        $user=$user=$this->userRepository->create($data);
      
        $user->user()->save($contact);

        if(!empty($data['role']) && $data['role']==1){
            $data['contact_id']=$contact->id;
            $this->clientRepository->create( $data);
        }
       
        return Redirect::to(URL::route('users.index'));
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

    public function edit($id)
    {
        $roles = \Bouncer::role()->all();
        $user=$this->userRepository->find($id);

        return response()->json([
            'user'  => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->all();
      
        $this->userRepository->update($data,$id);
        return Redirect::to(URL::route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userRepository->find($id)->delete();
        return Redirect::to(URL::route('users.index'));
    }

    public function dataTable(){
        return $this->userRepository->all();
    }

    public static function createLeadUser(Leads $lead)
    {
        $user = User::where('email', $lead->email)->first();

        if ($user) {
            return false;
        }

        $generatePassword = Str::random(10);

        $user = User::create([
            'name' => $lead->name . ' ' . $lead->last_name,
            'password' => Hash::make($generatePassword),
            'email' => $lead->email,
            'user_status' => 1,
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        \Bouncer::assign(User::ROLE_LEAD)->to($user);

        $lead->user_id = $user->id;
        $lead->save();

        $userData = [
            'id' => $user->id,
            'password' => $generatePassword,
            'email' => $user->email,
        ];


        return response()->json($userData);
    }

    public static function sendUserPassword(string $password, string $email)
    {
        if (!$password && !$email) {
            return false;
        }
        $data = [
            'receiver' => $email,
            'subject' => 'verification email',
            'body' => 'your password: ' . $password,
        ];

        Mail::to($email)->send(new Email($data));

        return redirect()->route('leads.index')->with('success-lead', 'link sent');;
    }
}
