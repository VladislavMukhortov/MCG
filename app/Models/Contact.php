<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Contact.
 *
 * @package namespace App\Models;
 */
class Contact extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = ['address_id','name','last_name','phone','email','subcontractor','general_contractor','created_by','created','lead','display_name'];

    public function contactsNote(){
        return $this->hasMany(ContactNotes::class, 'contact_id', 'id');
    }

    public function getLead(): BelongsTo
    {
        return $this->belongsTo(Leads::class, 'id', 'lead');
    }

    public function getLeads(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'lead_contact','note_id','leads_id');
    }

    public function getAddress(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id', 'id')->select('address','street','city','state');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public static function getUserContacts()
    {
        return self::whereCreatedBy(auth('api')->user()->id)->with('address')->paginate(30);
    }

    public static function getAllContacts()
    {
        return self::with('address')->paginate(30);
    }

    public static function getContactByIdWithAddress(int $contactId)
    {
        return self::with('address')->find($contactId);
    }



}
