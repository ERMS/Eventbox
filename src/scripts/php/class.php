
<!--   
    This file is part of Eventbox.

    Eventbox is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Eventbox is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Eventbox. If not, see <http://www.gnu.org/licenses/>.
-->

<?php

	error_reporting(0);
	session_start();
	date_default_timezone_set('Asia/Manila');
	include "connectdb.php"; 													//connect to the database
	require '../../../phpmailer/PHPMailer-master/PHPMailerAutoload.php';       //Third party mailing php functions
	require_once('../../../phpmailer/PHPMailer-master/class.phpmailer.php');   //object of the third party function

	class user																	
	{																			//object for user
		public $U_password;														//
		public $U_email;														//	this are the user 
		public $U_firstname;													//	object's properties
		public $U_lastname;														//	
		public $U_country;														//
		public $U_city;															//	
		public $U_picture;
		
		public function __construct()											//   user object constructor
		{
			$this->U_password = $_POST['password'];								//
	    	$this->U_email = $_POST['email'];									//  holds the passed
	    	$this->U_firstname = $_POST['first_name'];							//  data to the 
	    	$this->U_lastname = $_POST['last_name'];							//	object's properties  
	    	$this->U_country = $_POST['country'];								//	from the form upon 	
	    	$this->U_city = $_POST['Address'];									//	creation of object
	    	$this->U_picture= base64_encode(file_get_contents($_FILES['picture']['tmp_name']));
		}
		
		public function RegisterAccount()								//  user object's method that store the properties to database
		{
	    	$con=connectdb();
	    	mysqli_query($con,"INSERT INTO `user`(`User_Password`, `User_ProfilePicture`, `User_Email`, `User_FirstName`, `User_LastName`, `User_Country`, `User_City`)VALUES(md5('$this->U_password'),'$this->U_picture','$this->U_email','$this->U_firstname','$this->U_lastname','$this->U_country','$this->U_city')");
		    mysqli_close($con);
		}

		public function VerifyRegistration($email)
		{
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 3;                               // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'eventbox2015@gmail.com';           // SMTP username
			$mail->Password = 'alkinoko';                         // SMTP password
			$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                    // TCP port to connect to

			$mail->From = ('eventbox2015@gmail.com');
			$mail->FromName = 'EventBox';					  // Name of Sender
			$mail->addAddress($email);     						  // Add a recipient
			//content
			$mail->Subject = 'Verify Your Account!!';
			$mail->Body = "Congratulations!! You have successfully Registered to EventBox. To Activite your account click <a href='".$_SESSION['header']."?verify=".$email."'>Here!</a>";
			$mail->AltBody = "You have successfully Registered to EventBox to Activite your account click <a href='".$_SESSION['header']."?verify=".$email."'>Here!</a>";
			//end-content

			if(!$mail->send()) 									  // checks if the mail was send or not
			{
			    echo '<center>There was an error on sending the verification email. Please register again.<br></center>';
			    echo '<center>Mailer Error: ' . $mail->ErrorInfo . '</center>';
			} 
			else 
			{
			    echo "<h1><center><strong>A Verification was sent to your email... <br>Please activate your account through your email...</strong><center></h1>";
			}
		}
	}

	class event
	{
		public $E_description;
		public $E_title;
		public $E_privacy;
		public $E_deadline;
		public $E_slot;
		public $E_file;
		public $E_country;
		public $E_city;
		public $E_street;
		public $E_additional;
		public $E_logo;
		public $E_password;
		public $E_starthour;
		public $E_startminute;
		public $E_endhour;
		public $E_endminute;
		public $E_startday;
		public $E_startmonth;
		public $E_startyear;
		public $E_endday;
		public $E_endmonth;
		public $E_endyear;
		public $E_contactnumber;
		public $E_status;
		public $E_organizer;
		public $E_email;

		public function __construct()
		{
			$this->E_description = $_POST['description'];
			$this->E_title = $_POST['title'];
			$this->E_privacy = $_POST['privacy'];
			$this->E_deadline = $_POST['deadline'];
			$this->E_slot = $_POST['slot'];
			$this->E_file = $_POST['file'];
			$this->E_state = $_POST['state'];
			$this->E_country = $_POST['country'];
			$this->E_city = $_POST['city'];
			$this->E_street = $_POST['street'];
			$this->E_additional = $_POST['additional'];
			$this->E_logo = base64_encode(file_get_contents($_FILES['logo']['tmp_name']));                 // convert image into binary
			$this->E_password = $_POST['password'];
			$this->E_starthour = $_POST['starthour'];
			$this->E_startminute = $_POST['startminute'];
			$this->E_startch = $_POST['startch'];
			$this->E_endhour = $_POST['endhour'];
			$this->E_endminute = $_POST['endminute'];
			$this->E_endch = $_POST['endch'];
			$this->E_startday = $_POST['startday'];
			$this->E_startmonth = $_POST['startmonth'];
			$this->E_startyear = $_POST['startyear'];
			$this->E_endday = $_POST['endday'];
			$this->E_endmonth = $_POST['endmonth'];
			$this->E_endyear = $_POST['endyear'];
			$this->E_contactnumber = $_POST['contact'];
			$this->E_status=$_POST['status'];
		}
		
		public function createEvent($user)										// stores the data to the database
		{
			$con=connectdb();
	    	mysqli_query($con,"INSERT INTO `event`(`User_ID`, `Event_Title`, `Event_Description`, `Event_ContactNumber`, `Event_Privacy`, `Event_Deadline`, `Event_Slot`, `Event_File`, `Event_Country`, `Event_City`, `Event_Street`, `Event_Additional`, `Event_Logo`, `Event_Password`, `Event_StartHour`, `Event_StartMinute`, `Event_StartCH`, `Event_EndHour`, `Event_EndMinute`, `Event_EndCH`, `Event_StartDay`, `Event_StartMonth`, `Event_StartYear`, `Event_EndDay`, `Event_EndMonth`, `Event_EndYear`, `Event_Status`) VALUES ((SELECT `User_ID` FROM `user` WHERE `User_ID`='$user'), '$this->E_title', '$this->E_description','$this->E_contactnumber','$this->E_privacy','$this->E_deadline','$this->E_slot','$this->E_file','$this->E_country','$this->E_city','$this->E_street','$this->E_additional','$this->E_logo',md5('$this->E_password'),'$this->E_starthour','$this->E_startminute','$this->E_startch','$this->E_endhour','$this->E_endminute','$this->E_endch','$this->E_startday','$this->E_startmonth','$this->E_startyear','$this->E_endday','$this->E_endmonth','$this->E_endyear','$this->E_status')");
		    mysqli_close($con);
		}

		public function manageEvent($user,$event)										// stores the date when the event was created 
		{
			$month=date("F");
			$day=date("d");
			$year=date("Y");
			$hour=date("h");
			$minute=date("i");
			$ch=date("A");

			$con=connectdb();

	    	mysqli_query($con,"INSERT INTO `management`(`Event_ID`, `User_ID`, `Day_Created`, `Month_Created`, `Year_Created`, `Minute_Created`, `Hour_Created`, `CH_Created`) VALUES ((SELECT `Event_ID` FROM `event` WHERE `Event_ID`='$event'),(SELECT `User_ID` FROM `user` WHERE `User_ID`='$user'),'$day','$month','$year','$minute','$hour','$ch')");
		    mysqli_close($con);
		}
	}

	class form
	{
		public $F_order;
		public $Form_Value;
		public function __construct()
		{
			$this->F_order=$_GET['order'];
		}
		public function createTableform($user,$event)								// stores the ordering of the generated form for an event
		{
			$con=connectdb();
			mysqli_query($con,"INSERT INTO `form`(`Event_ID`, `User_ID`, `Form_Order`) VALUES ((SELECT `Event_ID` FROM `event` WHERE `Event_ID`='$event'),(SELECT `User_ID` FROM `user` WHERE `User_ID`='$user'),'$this->F_order')");
			mysqli_close($con);
		}
		
	}

	class formValue
	{
		public $formVal;
		public function __construct()
		{
			$this->formVal=json_encode($_GET['value']);                                  //  converts the passed array data to string
		}
		public function registerFormValue($u_id,$f_id)                                   //  stores the data for the generated form by the user
		{																				
			$con=connectdb();
			$query=mysqli_query($con,"SELECT * FROM `registration` WHERE `Form_ID`=(SELECT `Form_ID` FROM `form` WHERE `Form_ID`='$f_id'),`User_ID`=(SELECT `User_ID` FROM `user` WHERE `User_ID`='$u_id')");
			if(mysqli_num_rows($query)==0)												//  prevents same data to be stored in the database
			{
			mysqli_query($con,"INSERT INTO `registration`(`Form_ID`, `User_ID`, `Form_Value`)VALUES((SELECT `Form_ID` FROM `form` WHERE `Form_ID`='$f_id'),(SELECT `User_ID` FROM `user` WHERE `User_ID`='$u_id'),'$this->formVal')");
			}
			mysqli_close($con);
		}
	}

	class attend
	{
		public $month;
		public $day;
		public $year;
		public $hour;
		public $minute;
		public $ch;

		public function __construct()                                            //  stores the current date and time
		{
			$this->month=date("F");
			$this->day=date("d");
			$this->year=date("Y");
			$this->hour=date("h");
			$this->minute=date("i");
			$this->ch=date("A");
		}

		public function request($u_id,$e_id)									//  sends request to join an event
		{
			$con=connectdb();

			$query=mysqli_query($con,"SELECT * FROM `attendance` WHERE `Event_ID`='$e_id' AND `User_ID`='$u_id'");
			if(mysqli_num_rows($query)==0)                                      // this also prevents string of same data to the database
			{
			mysqli_query($con,"INSERT INTO `attendance`(`Event_ID`, `User_ID`, `Status`, `Attendee_Title`, `Hour_Confirmed`, `Minute_Confirmed`, `CH_Confirmed`, `Day_Confirmed`, `Month_Confirmed`, `Year_Confirmed`, `Hour_Requested`, `Minute_Requested`, `CH_Requested`, `Day_Requested`, `Month_Requested`, `Year_Requested`) VALUES ((SELECT `Event_ID` FROM `event` WHERE `Event_ID`='$e_id'),(SELECT `User_ID` FROM `user` WHERE `User_ID`='$u_id'),'Pending','Request','00','00','--','00','00','0000','$this->hour','$this->minute','$this->ch','$this->day','$this->month','$this->year')");
			}
			mysqli_close($con);
		}

		public function invite($u_id,$e_id)										//  invite other users to join an event
		{
			$con=connectdb();

			$query=mysqli_query($con,"SELECT * FROM `attendance` WHERE `Event_ID`='$e_id' AND `User_ID`='$u_id'");
			if(mysqli_num_rows($query)==0)                                       // this prevents storing of same data to the database
			{
			mysqli_query($con,"INSERT INTO `attendance`(`Event_ID`, `User_ID`, `Status`, `Attendee_Title`, `Hour_Confirmed`, `Minute_Confirmed`, `CH_Confirmed`, `Day_Confirmed`, `Month_Confirmed`, `Year_Confirmed`, `Hour_Requested`, `Minute_Requested`, `CH_Requested`, `Day_Requested`, `Month_Requested`, `Year_Requested`) VALUES ((SELECT `Event_ID` FROM `event` WHERE `Event_ID`='$e_id'),(SELECT `User_ID` FROM `user` WHERE `User_ID`='$u_id'),'Pending','Invite','00','00','--','00','00','0000','$this->hour','this->$minute','$this->ch','$this->day','$this->month','$this->year')");
			}
			mysqli_close($con);
		}

		public function approved($id)											// approves the the request or invitation
		{
			$con=connectdb();

			mysqli_query($con,"UPDATE `attendance` SET `Status`='Approved',`Hour_Confirmed`='$this->hour',`Minute_Confirmed`='$this->minute',`CH_Confirmed`='$this->ch',`Day_Confirmed`='$this->day',`Month_Confirmed`='$this->month',`Year_Confirmed`='$this->year' WHERE `Attendee_ID`='$id'");
			mysqli_close($con);	
		}

		public function decline($id)											// decline the the request or invitation
		{
			$con=connectdb();

			mysqli_query($con,"UPDATE `attendance` SET `Status`='Declined',`Hour_Confirmed`='$this->hour',`Minute_Confirmed`='$this->minute',`CH_Confirmed`='$this->ch',`Day_Confirmed`='$this->day',`Month_Confirmed`='$this->month',`Year_Confirmed`='$this->year' WHERE `Attendee_ID`='$id'");
			mysqli_close($con);	
		}
	}

	class mail
	{
		public $sender;
		public $msg;

		public function setMail($eventID,$sender)
		{
			$this->sender=$sender;
			$con=connectdb();

			$events=mysqli_query($con,"SELECT * FROM `event` WHERE `Event_ID`='$eventID'");
			$e=mysqli_fetch_array($events);

			$e_title=$e['Event_Title'];
			$e_sm=$e['Event_StartMonth'];														
			$e_sd=$e['Event_StartDay'];
			$e_sy=$e['Event_StartYear'];
			$e_em=$e['Event_EndMonth'];
			$e_ed=$e['Event_EndDay'];
			$e_ey=$e['Event_EndYear'];
			$e_sh=$e['Event_StartHour'];
			$e_smm=$e['Event_StartMinute'];
			$e_sc=$e['Event_StartCH'];
			$e_eh=$e['Event_EndHour'];
			$e_emm=$e['Event_EndMinute'];
			$e_ec=$e['Event_EndCH'];
			$privacy=$e['Event_Privacy'];
			$pass=$e['Event_Password'];
			if($privacy=='private')
			{
				$this->msg="You have been invited by $this->sender to be part of $e_title on $e_sm / $e_sd / $e_sy - $e_em / $e_ed / $e_ey at $e_sh : $e_smm $e_sc - $e_eh : $e_emm $e_ec. This event is private and requires password authentication. The password is ($pass). Login or Create an account Here:";
			}
			else
			{
				$this->msg="You have been invited by $this->sender to be part of $e_title on $e_sm / $e_sd / $e_sy - $e_em / $e_ed / $e_ey at $e_sh : $e_smm $e_sc - $e_eh : $e_emm $e_ec. Login or Create an account Here:";
			}

			/*
				this function generates the message to send to the invited users 
			*/

		}

		public function sendMail($email,$e_id)
		{
			$mail = new PHPMailer;
			//$mail->SMTPDebug = 3;                               // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'eventbox2015@gmail.com';           // SMTP username
			$mail->Password = 'alkinoko';                         // SMTP password
			$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                    // TCP port to connect to

			$mail->From = ('eventbox2015@gmail.com');
			$mail->FromName = $this->sender;					  // Name of Sender
			$mail->addAddress($email);     						  // Add a recipient
			//content
			$mail->Subject = 'You are Invited to attend an Event!';
			$mail->Body    = $this->msg."<a href='".$_SESSION['header']."?data=".$email."&id=".$e_id."'>Link</a>";
			$mail->AltBody = $this->msg."<a href='".$_SESSION['header']."?data=".$email."&id=".$e_id."'>Link</a>";
			//end-content

			if(!$mail->send()) 									  // checks if the mail was send or not
			{
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} 
			else 
			{
			    echo 'Message has been sent';
			}
		}
	}
?>
