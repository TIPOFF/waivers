<?php

declare(strict_types=1);

namespace Tipoff\Waivers\Http\Requests;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SignRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'approve.accepted' => 'You must agree to the terms.',
            'playing.required' => 'Please select if the parent is playing with the minors.',
            'minors.required' => 'Please add the names of all minors to the waiver.',
            'name.required' => 'Your first name is required.',
            'name_last.required' => 'Your last name is required.',
            'email.required' => 'Your email address is required to send confirmation.',
            'dob_month.required' => 'The month of your date of birth is required.',
            'dob_day.required' => 'The day of your date of birth is required.',
            'dob_year.required' => 'The year of your date of birth is required.',
            'dob_month.gt' => 'The month of your date of birth is required.',
            'dob_day.gt' => 'The day of your date of birth is required.',
            'dob_year.gt' => 'The year of your date of birth is required.',
        ];
    }

    public function rules()
    {
        return [
            'approve' => 'accepted',
            'room_id' => 'required',
            'email' => 'required|email|min:3|max:900',
            'name' => 'required|min:3|max:100',
            'name_last' => 'required|min:3|max:100',
            'minors' => 'required',
            'playing' => 'required',
            'dob_month' => 'required|gt:0',
            'dob_day' => 'required|gt:0',
            'dob_year' => 'required|gt:0',
        ];
    }
}
