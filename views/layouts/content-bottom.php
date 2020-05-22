<?php
	if($this->page !== null && count($this->page->contacts)){
		echo '<div class="module bottom-module contact-module">';
		echo '<h4>Contacts</h4>';
		foreach($this->page->contacts as $i => $cnt){
			$contact = Contact::model()->localized()->findByPk($cnt->id);
			if($contact != null) {
				echo '<div class="contact '.($i % 2 == 0 ? 'odd' : 'even').'">';
				echo '<strong>'.$contact->first_name.' '.$contact->last_name.'</strong><br />';
				echo '<em>'.$contact->role.'</em><br />';
				echo '<div><strong>Tel:</strong> '.$contact->tel.'</div>';
				if(!empty($contact->fax)) {
				echo '<div><strong>Fax:</strong> '.$contact->fax.'</div>';
				}
				if(!empty($contact->mob)) {
				echo '<div><strong>Mob:</strong> '.$contact->mob.'</div>';
				}
				echo '<div><strong>Email:</strong> '.$contact->email.'</div>';
				if(!empty($contact->description)) echo '<div>'.$contact->description.'</div>';									
				echo '<div><a href="'.Yii::app()->createUrl('/contact?').'id='.$contact->id.'">Contact Form</a></div>';
				echo '</div>';
			}
		}
		echo '</div>';
	}
