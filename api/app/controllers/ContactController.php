<?php

class ContactController extends \BaseController {
    /**
     * Show the contact us form.
     *
     * @return Response
     */
    public function index()
    {
        return \View::make('contacts/index');
    }

    /**
     * Show the thank you page.
     *
     * @return Response
     */
    public function thankYou()
    {
        return \View::make('contacts/thank-you');
    }

    /**
     * Process the contact us form data
     *
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function process()
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => '',
            'email' => 'required|email',
            'phone' => '',
            'message_body' => 'required'
        ];
        $data = \Input::only(
            'first_name', 
            'last_name',
            'email',
            'company',
            'phone',
            'message_body'
        );
        $validator = \Validator::make($data, $rules);

        if ($validator->fails()) {
            return \Redirect::Action('ContactController@index')
                ->withErrors($validator)
                ->withInput();
        }

        //-- Save to database incase email is lost, or fails
        $contact = \Contact::create($data);

        \Mail::send('emails.contact', $data, function ($message)
        {
            $message->to('john.doe@email.com', 'John Doe')->subject('Welcome!');
        });

        return \Redirect::Action('ContactController@thankYou');
    }
}