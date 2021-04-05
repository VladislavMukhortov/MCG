<?php

return [
    'contacts' => [
        'create' => [
            'wrong' => 'Couldn\'t create contact',
            'success' => 'Contact create success',
        ],
        'update' => [
            'wrong' => 'Couldn\'t update contact',
            'success' => 'Contact update success',
        ],
        'delete' => [
            'wrong' => 'Couldn\'t delete contact',
            'success' => 'Contact delete success',
        ],
        'add_to_lead' => [
            'wrong' => 'Couldn\'t add contact to lead',
            'empty_contact_id' => 'Couldn\'t add contact to lead, contact_id is empty',
            'success' => 'Success add contact to lead',
        ],
        'remove_from_lead' => [
            'wrong' => 'Couldn\'t remove contact from lead',
            'empty_contact_id' => 'Couldn\'t remove contact from lead, contact_id is empty',
            'success' => 'Success remove contact from lead',
        ],
        'email' => [
            'success' => 'Message sent'
        ]
    ],
    'estimates' => [
        'create' => [
            'success' => 'Estimate create success',
        ],
        'update' => [
            'success' => 'Estimate update success',
        ],
        'delete' => [
            'success' => 'Estimate delete success',
        ],
        'insert_estimate_template' => [
            'success' => 'Template Added Successfully',
        ],
        'update_estimate_template' => [
            'success' => 'Template Updated Successfully',
        ],
    ],
    'estimate_templates' => [
        'create' => [
            'success' => 'Estimate template create success',
        ],
        'update' => [
            'success' => 'Estimate template update success',
        ],
        'save_line_items' => [
            'success' => 'Line items saved',
        ],
        'delete' => [
            'success' => 'Estimate template delete success',
            'wrong' => 'Something wrong upon attempt delete line item in estimate_template_line_items table',
        ],
        'delete_line_item' => [
            'success' => 'Line item from estimate template deleted',
        ],
    ],
    'notes' => [
        'create' => [
            'success' => 'Note create success',
        ],
        'delete' => [
            'success' => 'Notes delete success',
        ],
    ],
    'account' => [
        'create' => [
            'success' => 'Account create success',
        ],
        'update' => [
            'success' => 'Account create success',
        ],
        'delete' => [
            'success' => 'Account delete success',
        ],
    ],

    'leads' => [
        'create' => [
            'success' => 'Lead has been added successfully',
        ],
        'delete' => [
            'success' => 'Lead has been deleted successfully',
        ],
        'update' => [
            'success' => 'Lead has been updated successfully',
        ],
        'email' => [
            'success' => 'Email has been sent',
            'fail' => 'Something went wrong',
        ],
        'verification' => [
            'success' => 'Lead successfully verified',
            'warning_one' => 'lead already had been verified or does not exist',
            'warning_two' => 'lead does not exist',
        ]
     ],
    'requests' => [
        'create' => [
            'success' => 'Request has been added successfully',
        ],
        'delete' => [
            'success' => 'Request has been deleted successfully',
        ],
        'update' => [
            'success' => 'Request has been updated successfully',
        ],
    ],
    'rooms' => [
        'update' => [
            'success' => 'Room changes has been updated'
        ]
    ],
    'lead_link' => [
        'create' => [
            'error' => 'Your link is invalid'
        ],
        'store' => [
            'success' => 'Form was submitted, thank you',
        ],
        'update' => [
            'success' => 'Request has been updated successfully',
        ],
        'email' => [
            'success' => 'Message was sent to lead email'
        ]
    ],
    'initial_request' => [
        'store' => [
            'success' => 'Form was sent to Modern Citi Group, thank you. Our team contact you shortly'
        ],
        'email' => [
            'success' => 'Email is available',
            'fail' => 'Sorry, but this email address already in use',
        ]
    ],
    'admins' => [
        'create' => [
            'success' => 'Admin create success',
        ],
        'update' => [
            'success' => 'Admin update success',
        ],
        'delete' => [
            'success' => 'Admin delete success',
        ],
    ],
    'questions' => [
        'store' => [
            'success' => 'Question is saved'
        ],
        'update' => [
            'success' => 'Changes saved'
        ],
        'attachment' => [
            'store' => 'Attachment saved',
            'destroy' => 'Attachment deleted'
        ],
        'remark' => [
            'store' => 'Remark added',
            'destroy' => 'Remark deleted'
        ],
        'status' => [
            'success' => 'Change status success',

        ]
    ],
    'csi' => [
        'edit' => [
            'success' => 'Csi code edit success',
        ],
        'delete' => [
            'success' => 'Csi code delete success'
        ]
    ],
    'generals' => [
        'create' => [
            'success' => 'General contractor create success',
        ],
        'update' => [
            'success' => 'General contractor update success'
        ],
        'delete' => [
            'success' => 'General contractor delete success'
        ]
    ],
    'managers' => [
        'create' => [
            'success' => 'Manager create success',
        ],
        'update' => [
            'success' => 'Manager update success'
        ],
        'delete' => [
            'success' => 'Manager delete success'
        ]
    ],
    'representatives' => [
        'create' => [
            'success' => 'Representative create success',
        ],
        'update' => [
            'success' => 'Representative update success'
        ],
        'delete' => [
            'success' => 'Representative delete success'
        ]
    ],
    'subContractors' => [
        'create' => [
            'success' => 'Sub contractor create success',
        ],
        'update' => [
            'success' => 'Sub contractor update success'
        ],
        'delete' => [
            'success' => 'Sub contractor delete success'
        ]
    ],
    'users' => [
        'create' => [
            'success' => 'User create success',
        ],
        'update' => [
            'success' => 'User update success'
        ],
        'delete' => [
            'success' => 'User delete success'
        ],
        'set_password' =>  [
            'success' => 'User password set success'
        ],
    ],
    'workers' => [
        'create' => [
            'success' => 'Worker create success',
        ],
        'update' => [
            'success' => 'Worker update success'
        ],
        'delete' => [
            'success' => 'Worker delete success'
        ],
    ],
    'attachments' => [
        'create' => [
            'success' => 'Attachment create success',
        ],
        'update' => [
            'success' => 'Attachment update success',
        ],
        'delete' => [
            'success' => 'Attachment delete success',
        ],
        'store_json' => [
            'success' => 'Attachment store json success',
        ],
        'attachment_email' =>[
            'success' => 'Message sent'
        ],
        'attachment_create' => [
            'success' => "Files were submitted, thank you",
        ],
    ],
    'csi_codes' => [
        'create' => [
            'success' => 'Csi code create success',
            'wrong' => 'Some lvl from form data, not found in data base',
        ],
        'update' => [
            'success' => 'Csi code update success',
            'wrong' => 'Some lvl from form data, not found in data base',
        ],
        'delete' => [
            'success' => 'Csi code delete success'
        ],
    ],
    'csi_levels' => [
        'create' => [
            'success' => 'Csi level create success',
        ],
        'update' => [
            'success' => 'Csi level update success'
        ],
        'delete' => [
            'success' => 'Csi level with children delete success'
        ],
    ],
    'projects' => [
        'create' => [
            'success' => 'Projects create success',
        ],
        'update' => [
            'success' => 'Projects update success'
        ],
        'delete' => [
            'success' => 'Projects delete success',
        ],
        'store_payment' => [
            'success' => 'Store Payment success',
        ],
        'store_payout' => [
            'success' => 'Store Payout success',
        ],
        'payment_delete' => [
            'success' => 'Payment delete success',
        ],
        'payout_delete' => [
            'success' => 'Payout delete success',
        ],
        'convert' => [
            'success' => 'Convert to project success',
        ],
    ],
    'task' => [
        'store' => [
            'success' => 'Task saved'
        ],
        'update' => [
            'success' => 'Changes saved'
        ],
        'destroy' => [
            'success' => 'Task removed'
        ]

    ],
    'user' => [
        'store' => [
            'success' => 'User saved'
        ],
        'update' => [
            'success' => 'Changes saved'
        ],
        'destroy' => [
            'success' => 'Task removed'
        ]
    ],
    'initial_completion_form' => [
        'store' => [
            'success' => 'Form was sent, thank you'
        ]
    ],
    'walkthrough_form' => [
        'store' => [
            'success' => 'Form was sent, thank you'
        ]
    ],
    'final_completion_form' => [
        'store' => [
            'success' => 'Form was sent, thank you'
        ]
    ],
    'project_document' => [
        'create' => [
            'success' => 'Project document create success'
        ],
        'update' => [
            'success' => 'Project document update success'
        ]
    ],
    'estimates_lead_form' => [
        'store_file' => [
            'success' => 'File upload success'
        ],
        'create_promise' => [
            'success' => 'Room create success'
        ],
        'store_phase' => [
            'success' => 'Phase create success'
        ],
        'delete_file' => [
            'success' => 'File delete success'
        ],
        'delete_premise' => [
            'success' => 'Premise delete success'
        ],
        'update_file' => [
            'success' => 'File update success'
        ],
        'update_phase' => [
            'success' => 'Phase update success'
        ],
        'delete_phase' => [
            'success' => 'Delete phase success'
        ],
        'create_next_step' => [
            'success' => 'Create next step success'
        ],
        'update_next_step' => [
            'success' => 'Update next step success'
        ],
        'delete_next_step' => [
            'success' => 'Delete next step success'
        ],
        'update_terms' => [
            'success' => 'Update terms success'
        ],
        'create_terms' => [
            'success' => 'Create terms success'
        ],
    ],
    'events' => [
        'create' => [
            'success' => 'Event create success'
        ],
        'update' => [
            'success' => 'Event update success'
        ],
        'delete' => [
            'success' => 'Event delete success'
        ]
    ],
    'jobs' => [
        'create' => [
            'success' => 'Jobs create success'
        ],
        'update' => [
            'success' => 'Event update success'
        ],
        'delete' => [
            'success' => 'Event delete success'
        ]
    ],
    'email' => [
        'send' => [
            'success' => 'Email was sent successfully'
        ],
        'delete' => [
            'success' => 'Email information has been deleted'
        ],
    ],

];