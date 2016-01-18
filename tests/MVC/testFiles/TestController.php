<?php

class TestController extends JanPetr\MVC\Controller
{
	public function runTemplate($id)
	{
		$this->template->foo = $id;
	}
}