<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//General

$config['insertSuccess'] = 'Successfully Created';
$config['editSuccess'] = 'Successfully Edited';
$config['deleteSuccess'] = 'Successfully Deleted';


//Password Change Errors

$config['someErrors'] = '<strong>There were some problems with your request</strong></br> ';
$config['enterPassword'] = 'Please enter your password.</br>';
$config['smallPassword'] = 'Password must have at least 8 characters.</br>';
$config['passwordsNotMaching'] = 'Please check that your passwords match.</br>';
$config['passwordChanged']='Password successfully changed';


//Reset Error and Success Messages

$config['emailNotRegistered'] = 'This Email Address is not registered with us';
$config['wrongOrExpiredVcode'] = 'Your reset Token is either Expired or Incorrect';
$config['resetEmailSend'] = 'Email with reset code has been send to you';


//Login Error and Success Messages
$config['wrongEmailPassword']='<strong>Wrong Email or Password</strong>';


//Registration Error and Success Messages
$config['successfullyRegistered']='Registration Successful! Confirm your Email Please';
$config['emailSuccessfullyVerified']='Your Email address has been verified successfully';
$config['emailSuccessfullyVerified']='Your Email address has been verified successfully';


$config['someErrorsWhileRegistration']='<strong>There were some problems with your request</strong></br>';
$config['emailAlreadyRegistered']='This email is already registered</br>';
$config['missingEmail']="Missing e-mail address.</br>";
$config['invalidEmail']="Invalid e-mail address.</br>";
$config['missingPassword']="Please enter your password.</br>";
$config['tooSmallPassword']="Password must have at least 8 characters.</br>";
$config['passwordNotMaching']="Please check that your passwords match.</br>";
$config['missingName']="You must provide a name.</br>";
$config['missingPhone']="You must provide a phone number.</br>";






/*
 * Email Settings Start Here
 *
 * */

//Email Subjects

$config['registrationVerificationEmail']='Registration Successful! Confirm your Email Please';
$config['passwordResetVerification']='Password reset request verification! AdsonanceBusiness.com';
$config['passwordResetSucccess']='Password reset Successful AdsonanceBusiness.com';
$config['sendMessageToListingOwner']='Adsonance Local Businesses (AdsonanceBusiness.com)';

//Email Headers

$config['registrationVerificationEmailHeader']='Registration Successful! Confirm your Email Please';
$config['passwordResetVerificationHeader']='Password reset request verification! AdsonanceBusiness.com';
$config['passwordResetSucccessHeader']='Password reset Successful AdsonanceBusiness.com';
$config['sendMessageToListingOwnerHeader']='Adsonance Local Businesses AdsonanceBusiness.com';



//Email From

$config['registrationVerificationEmailFrom']='support@adsonance.com';
$config['passwordResetVerificationFrom']='support@adsonance.com';
$config['passwordResetSucccessFrom']='support@adsonance.com';
$config['sendMessageToListingOwnerFrom']='support@adsonance.com';


//Email ReplyTo

$config['registrationVerificationEmailReplyTo']='support@adsonance.com';
$config['passwordResetVerificationReplyTo']='support@adsonance.com';
$config['passwordResetSucccessReplyTo']='support@adsonance.com';
$config['sendMessageToListingOwnerReplyTo']='support@adsonance.com';

//Email ReplyToHeader

$config['registrationVerificationEmailReplyToHeader']='Adsonance Business Reply';
$config['passwordResetVerificationReplyToHeader']='Adsonance Business Reply';
$config['passwordResetSucccessReplyToHeader']='Adsonance Business Reply';
$config['sendMessageToListingOwnerReplyToHeader']='Adsonance Business Reply';



