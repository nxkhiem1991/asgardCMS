<?php

namespace Modules\Contact\Http\Controllers\Frontend;

use Modules\Contact\Http\Requests\CreateContactRequestRequest;
use Modules\Contact\Repositories\ContactRequestRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Notification\Services\Notification;

class ContactRequestController extends BasePublicController
{
    /**
     * @var ContactRequestRepository
     */
    private $contactRequest;

    public function __construct(ContactRequestRepository $contactRequest, Notification $notification)
    {
        parent::__construct();

        $this->contactRequest = $contactRequest;
        $this->notification = $notification;
    }

    public function show()
    {
        return view('contact::public.contact');
    }

    public function store(CreateContactRequestRequest $request)
    {
        // var_dump($request->all());exit();
        $this->contactRequest->create($request->all());
        $this->notification->push('New subscription', 'Someone has subscribed!', 'fa fa-hand-peace-o text-green', route('admin.user.user.index'));
        return redirect()->back()->withSuccess('We received your request. We\'ll get back to you soon.');
    }
}
