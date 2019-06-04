<?php
class Email{

	public function sendMail($to, $subj, $what, $from = "support@perfect-crm.ru")
	{ 
		mail($to, $subj, $what, 
"From: $from
Reply-To: $from
Content-Type: text/plain; charset=utf-8
Content-Transfer-Encoding: 8bit"
		);
	}
}
?>