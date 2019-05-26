<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function saveuserresponse()
	{
		if (!$this->input->is_ajax_request()) 
		{
   			exit('No direct script access allowed');
		}

		$oauth_provider = $this->input->post('oauth_provider');
		$udata = json_decode($this->input->post('userData'));

		$fields = array('id');
		$cond['oauth_provider'] = $oauth_provider;
		$cond['oauth_uid'] = $udata->id;


		$this->dfd->setTable('users');
		$result = $this->dfd->fetchsinglerecord($fields, $cond);
		$this->dfd->unsetTable();


		if(count($result) > 0)
		{
			$info['oauth_provider'] = $oauth_provider;
			$info['last_login'] = date('Y-m-d H:i:s', time());
			if($oauth_provider == 'facebook')
			{
				$info['first_name'] = $udata->first_name;
				$info['last_name'] = $udata->last_name;
				$info['email'] = $udata->email;
				$info['picture'] = $udata->picture->data->url;
				$this->dfd->setTable('users');
				$this->dfd->updatedata($info, $cond);
				$this->dfd->unsetTable();
				unset($info['picture']);
				unset($info['last_login']);
				$info['u_id'] = $result->id;
				$this->dfd->setSessiondata($info);	
			}
			elseif($oauth_provider == 'google')
			{
				$info['first_name'] = $udata->given_name;
				$info['last_name'] = !empty($udata->family_name) ? $udata->family_name : '';
				$info['email'] = $udata->email;
				$info['picture'] = !empty($udata->picture) ? $udata->picture : '';
				$info['link'] = !empty($udata->link) ? $udata->link : '';
				$info['locale'] = !empty($udata->locale) ? $udata->locale : '';
				$info['gender'] = !empty($udata->gender) ? $udata->gender : '';
				$this->dfd->setTable('users');
				$this->dfd->updatedata($info, $cond);
				$this->dfd->unsetTable();
				unset($info['picture']);
				unset($info['link']);
				unset($info['locale']);
				unset($info['gender']);
				unset($info['last_login']);
				$info['u_id'] = $result->id;
				$this->dfd->setSessiondata($info);	
			}
			
		}
		else
		{
			$info['oauth_provider'] = $oauth_provider;
			$info['oauth_uid'] = $udata->id;
			$info['email'] = $udata->email;
			$info['created_at'] = time();
			$info['last_login'] = date('Y-m-d H:i:s', time());
			if($oauth_provider == 'facebook')
			{
				$info['first_name'] = $udata->first_name;
				$info['last_name'] = $udata->last_name;
				$info['picture'] = $udata->picture->data->url;
			}
			elseif($oauth_provider == 'google')
			{
				$info['first_name'] = $udata->given_name;
				$info['last_name'] = !empty($udata->family_name) ? $udata->family_name : '';
				$info['picture'] = !empty($udata->picture) ? $udata->picture : '';
				$info['link'] = !empty($udata->link) ? $udata->link : '';
				$info['locale'] = !empty($udata->locale) ? $udata->locale : '';
				$info['gender'] = !empty($udata->gender) ? $udata->gender : '';
			}
			

			$this->dfd->setTable('users');
			$u_id = $this->dfd->insertdata($info);
			$this->dfd->unsetTable();

			//unset($info['oauth_provider']);
			unset($info['oauth_uid']);
			unset($info['picture']);
			if(array_key_exists("link", $info))
			{
				unset($info['link']);
			}
			if(array_key_exists("locale", $info))
			{
				unset($info['locale']);
			}
			if(array_key_exists("gender", $info))
			{
				unset($info['gender']);
			}
			if(array_key_exists("last_login", $info))
			{
				unset($info['last_login']);
			}
			unset($info['created_at']);

			$info['u_id'] = $u_id;

			$this->dfd->setSessiondata($info);
		}
		
		die;
	}
}