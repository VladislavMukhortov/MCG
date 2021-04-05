<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\AccountRepository;
use App\Models\Account;
use App\Validators\AccountValidator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;


/**
 * Class AccountRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AccountRepositoryEloquent extends BaseRepository implements AccountRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $Account;
    protected $User;

    
    public function __construct(Account $Account , User $User){
        $this->Account = $Account;
        $this->User = $User;

    }

    public function model()
    {
        return Account::class;
    }

    public function getUserAccount(User $user)
    {
        return Account::firstOrCreate(['user_id' => $user->id]);
    }

    public function index()
    {
        return $this->User->where('id',Auth::id())->first();        
    }

    public function account()
    {
        return $this->Account->where('user_id',Auth::id())->first();        
    }

    public function store($data)
    {

        $users = $this->User->find($data['id']);
 
        $userIn = $this->User->update([$users]);
        $accountdata['user_id'] = $users->id;
        $accountdata['email_signature'] = $data['email_signature'];
        $account = $this->Account->updateOrCreate($accountdata);    
    }

    public function update($data,$id)
    {

        $user = User::where('id',Auth::id())->find($id);
        // dd($user);

        if (isset($data['password'])) {
            if (Hash::check($data['current_password'] ,$user->password)) {
                $data['password'] = Hash::make($data['password']);  
            }else{
                Session::flash('success' , 'Current Password Dont match');
                return redirect()->back(); 
            }
        }

        $this->User->find($id)->update($data);
    }

    public function updateWithUserData(User $user, Collection $data)
    {
        $user->account()->update([
            'email_signature' => $data->get('email_signature'),
            //'calendar_sync_token' //todo
        ]);
        $user->update([
            'name'  => $data->get('name'),
            'email' => $data->get('email')
        ]);
    }

    public function updatePassword(User $user, Collection $data): bool
    {
        return $user->update(['password' => Hash::make($data->get('password'))]);
    }
        
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
