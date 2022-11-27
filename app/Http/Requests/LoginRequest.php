<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
			'username' => 'required',
			'password' => 'required'
            //
        ];
    }
	
	/**
	* Get the needed authorization credentials from the request.
	* Username can be as username or email, so we need to check in both ways with isEmail
	* @return array
	* @throws \Illuminate\Contracts\Container\BindingResolutionException
	*/

	public function getCredentials()
	{

		$username = $this->get('username');

		if($this->isEmail($username)){
			
			return [
				'email' => $username,
				'password' => $this->get('password')
			];
		}
		return 	$this->only('username', 'password');
	}
	
	/**
	 * Check if provided parameter is valid email.
	 *
	 * @param $param
	 * @return bool
	 *  @throws \Illuminate\Contracts\Container\BindingResolutionException
	 */
	private function isEmail($param){
		
		$factory = $this->container->make(ValidationFactory::class);

		return !$factory->make(
			['username' => $param],
			['username' => 'email']
		)->fails();
	}
}
