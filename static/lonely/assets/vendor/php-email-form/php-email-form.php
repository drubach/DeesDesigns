<?php
/**
 * PHP Email Form
 * Version: 3.2
 * Website: https://bootstrapmade.com/php-email-form/
 * Copyright: BootstrapMade.com
 */

if ( version_compare(phpversion(), '5.5.0', '<') ) {
  die('PHP version 5.5.0 and up is required. Your PHP version is ' . phpversion());
}

class PHP_Email_Form {

  public $to = false;
  public $from_name = false;
  public $from_email = false;
  public $subject = false;
  public $mailer = false;
  public $smtp = false;
  public $message = '';

  public $content_type = 'text/html';
  public $charset = 'utf-8';
  public $ajax = false;

  public $options = [***REMOVED***;
  public $cc = [***REMOVED***;
  public $bcc = [***REMOVED***;
  public $honeypot = '';
  public $recaptcha_secret_key = false;

  public $error_msg = array(
    'invalid_to_email' => 'Email to (receiving email address) is empty or invalid!',
    'invalid_from_name' => 'From Name is empty!',
    'invalid_from_email' => 'Email from: is empty or invalid!',
    'invalid_subject' => 'Subject is too short or empty!',
    'short' => 'is too short or empty!',
    'ajax_error' => 'Sorry, the request should be an Ajax POST',
    'invalid_attachment_extension' => 'File extension not allowed, please choose:',
    'invalid_attachment_size' => 'Max allowed attachment size is:'
  );

  private $error = false;
  private $attachments = [***REMOVED***;

  public function __construct() {
    $this->mailer = "forms@" . @preg_replace('/^www\./','', $_SERVER['SERVER_NAME'***REMOVED***);
  }

  public function add_message($content, $label = '', $length_check = false) {
    $message = filter_var($content, FILTER_SANITIZE_STRING) . '<br>';
    if( $length_check ) {
      if( strlen($message) < $length_check + 4 ) {
        $this->error .=  $label . ' ' . $this->error_msg['short'***REMOVED*** . '<br>';
        return;
  ***REMOVED***
***REMOVED***
    $this->message .= !empty( $label ) ? '<strong>' . $label . ':</strong> ' . $message : $message;
  }

  public function option($name, $val) {
    $this->options[$name***REMOVED*** = $val;
  }

  public function add_attachment($name, $max_size = 20, $allowed_exensions = ['jpeg','jpg','png','pdf','doc','docx'***REMOVED*** ) {
    if( !empty($_FILES[$name***REMOVED***['name'***REMOVED***) ) {
      $file_exension = strtolower(pathinfo($_FILES[$name***REMOVED***['name'***REMOVED***, PATHINFO_EXTENSION));
      if( ! in_array($file_exension, $allowed_exensions) ) {
        die( '(' .$name . ') ' . $this->error_msg['invalid_attachment_extension'***REMOVED*** . " ." . implode(", .", $allowed_exensions) );
  ***REMOVED***
  
      if( $_FILES[$name***REMOVED***['size'***REMOVED*** > (1024 * 1024 * $max_size) ) {
        die( '(' .$name . ') ' . $this->error_msg['invalid_attachment_size'***REMOVED*** . " $max_size MB");
  ***REMOVED***

      $this->attachments[***REMOVED*** = [
        'path' => $_FILES[$name***REMOVED***['tmp_name'***REMOVED***, 
        'name'=>  $_FILES[$name***REMOVED***['name'***REMOVED***
      ***REMOVED***;
***REMOVED***
  }

  public function send() {

    if( !empty(trim($this->honeypot)) ) {
      return 'OK';
***REMOVED***

    if( $this->recaptcha_secret_key ) {

      if(! $_POST['recaptcha-response'***REMOVED***) {
        return 'No reCaptcha response provided!';
  ***REMOVED***

      $recaptcha_options = [
        'http' => [
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query([
            'secret' => $this->recaptcha_secret_key,
            'response' => $_POST['recaptcha-response'***REMOVED***
          ***REMOVED***)
        ***REMOVED***
      ***REMOVED***;

      $recapthca_context = stream_context_create($recaptcha_options);
      $recapthca_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $recapthca_context);
      $recapthca_response_keys = json_decode($recapthca_response,true);

      if( ! $recapthca_response_keys['success'***REMOVED*** ) {
        return 'Failed to validate the reCaptcha!';
  ***REMOVED***
***REMOVED***

    if( $this->ajax ) {
      if( !isset($_SERVER['HTTP_X_REQUESTED_WITH'***REMOVED***) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'***REMOVED***) != 'xmlhttprequest') {
        return $this->error_msg['ajax_error'***REMOVED***;
  ***REMOVED***
***REMOVED***

    $to = filter_var( $this->to, FILTER_VALIDATE_EMAIL);
    $from_name = filter_var( $this->from_name, FILTER_SANITIZE_STRING);
    $from_email = filter_var( $this->from_email, FILTER_VALIDATE_EMAIL);
    $subject = filter_var( $this->subject, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $message = nl2br($this->message);

    if( ! $to || md5($to) == '496c0741682ce4dc7c7f73ca4fe8dc5e') 
      $this->error .= $this->error_msg['invalid_to_email'***REMOVED*** . '<br>';

    if( ! $from_name ) 
      $this->error .= $this->error_msg['invalid_from_name'***REMOVED*** . '<br>';

    if( ! $from_email ) 
      $this->error .= $this->error_msg['invalid_from_email'***REMOVED*** . '<br>';

    if( ! $subject ) 
      $this->error .= $this->error_msg['invalid_subject'***REMOVED*** . '<br>';

    if( is_array( $this->smtp) ) {
      if( !isset( $this->smtp['host'***REMOVED*** ) )
        $this->error .= 'SMTP host is empty!' . '<br>';

      if( !isset( $this->smtp['username'***REMOVED*** ) ) {
        $this->error .= 'SMTP username is empty!' . '<br>';
  ***REMOVED***
      if( !isset( $this->smtp['password'***REMOVED*** ) )
        $this->error .= 'SMTP password is empty!' . '<br>';
    
      if( !isset( $this->smtp['port'***REMOVED*** ) )
        $this->smtp['port'***REMOVED*** = 587;
      
      if( !isset( $this->smtp['encryption'***REMOVED*** ) )
        $this->smtp['encryption'***REMOVED*** = 'tls';

      if( isset( $this->smtp['mailer'***REMOVED*** ) ) {
        $this->mailer = $this->smtp['mailer'***REMOVED***;
  ***REMOVED*** else {
        $this->mailer = $this->smtp['username'***REMOVED***;
  ***REMOVED***
***REMOVED***

    if( $this->error )
      return $this->error;

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
      // Set timeout to 30 seconds
      $mail->Timeout = 30;

      // Check and set SMTP
      if( is_array( $this->smtp) ) {
        $mail->isSMTP();
        $mail->Host = $this->smtp['host'***REMOVED***;
        $mail->SMTPAuth = true;
        $mail->Username = $this->smtp['username'***REMOVED***;
        $mail->Password = $this->smtp['password'***REMOVED***;
        $mail->Port = $this->smtp['port'***REMOVED***;
        $mail->SMTPSecure = $this->smtp['encryption'***REMOVED***;
  ***REMOVED***

      // Headers
      $mail->CharSet = $this->charset;
      $mail->ContentType = $this->content_type;

      // Recipients
      $mail->setFrom( $this->mailer, $from_name );
      $mail->addAddress( $to );
      $mail->addReplyTo( $from_email, $from_name );

      // cc
      if(count($this->cc) > 0) {
        foreach($this->cc as $cc) {
          $mail->addCC($cc);
    ***REMOVED***
  ***REMOVED***

      // bcc
      if(count($this->bcc) > 0) {
        foreach($this->bcc as $bcc) {
          $mail->addBCC($bcc);
    ***REMOVED***
  ***REMOVED***

      // Content
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $message;

      // Options
      if(count($this->options) > 0) {
        foreach($this->options as $option_name => $option_val) {
          $mail->$option_name = $option_val;
    ***REMOVED***
  ***REMOVED***

      // Attachments
      if(count($this->attachments) > 0) {
        foreach($this->attachments as $attachment) {
          $mail->AddAttachment($attachment['path'***REMOVED***, $attachment['name'***REMOVED***);
    ***REMOVED***
  ***REMOVED***

      // XMailer
      $mail->XMailer = 'PHP Email Form (https://bootstrapmade.com/php-email-form/)';

      $mail->send();

      return 'OK';
***REMOVED*** catch (Exception $e) {
      return 'Mailer Error: ' . $mail->ErrorInfo;
***REMOVED***
    
  }
}


/**
 * PHPMailer - PHP email creation and transport class.
 * PHP Version 5.5.
 *
 * @see https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 *
 * @author    Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author    Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author    Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author    Brent R. Matzelle (original founder)
 * @copyright 2012 - 2020 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

class PHPMailer
{
    const CHARSET_ASCII = 'us-ascii';
    const CHARSET_ISO88591 = 'iso-8859-1';
    const CHARSET_UTF8 = 'utf-8';

    const CONTENT_TYPE_PLAINTEXT = 'text/plain';
    const CONTENT_TYPE_TEXT_CALENDAR = 'text/calendar';
    const CONTENT_TYPE_TEXT_HTML = 'text/html';
    const CONTENT_TYPE_MULTIPART_ALTERNATIVE = 'multipart/alternative';
    const CONTENT_TYPE_MULTIPART_MIXED = 'multipart/mixed';
    const CONTENT_TYPE_MULTIPART_RELATED = 'multipart/related';

    const ENCODING_7BIT = '7bit';
    const ENCODING_8BIT = '8bit';
    const ENCODING_BASE64 = 'base64';
    const ENCODING_BINARY = 'binary';
    const ENCODING_QUOTED_PRINTABLE = 'quoted-printable';

    const ENCRYPTION_STARTTLS = 'tls';
    const ENCRYPTION_SMTPS = 'ssl';

    const ICAL_METHOD_REQUEST = 'REQUEST';
    const ICAL_METHOD_PUBLISH = 'PUBLISH';
    const ICAL_METHOD_REPLY = 'REPLY';
    const ICAL_METHOD_ADD = 'ADD';
    const ICAL_METHOD_CANCEL = 'CANCEL';
    const ICAL_METHOD_REFRESH = 'REFRESH';
    const ICAL_METHOD_COUNTER = 'COUNTER';
    const ICAL_METHOD_DECLINECOUNTER = 'DECLINECOUNTER';

    /**
     * Email priority.
     * Options: null (default), 1 = High, 3 = Normal, 5 = low.
     * When null, the header is not set at all.
     *
     * @var int|null
     */
    public $Priority;

    /**
     * The character set of the message.
     *
     * @var string
     */
    public $CharSet = self::CHARSET_ISO88591;

    /**
     * The MIME Content-type of the message.
     *
     * @var string
     */
    public $ContentType = self::CONTENT_TYPE_PLAINTEXT;

    /**
     * The message encoding.
     * Options: "8bit", "7bit", "binary", "base64", and "quoted-printable".
     *
     * @var string
     */
    public $Encoding = self::ENCODING_8BIT;

    /**
     * Holds the most recent mailer error message.
     *
     * @var string
     */
    public $ErrorInfo = '';

    /**
     * The From email address for the message.
     *
     * @var string
     */
    public $From = '';

    /**
     * The From name of the message.
     *
     * @var string
     */
    public $FromName = '';

    /**
     * The envelope sender of the message.
     * This will usually be turned into a Return-Path header by the receiver,
     * and is the address that bounces will be sent to.
     * If not empty, will be passed via `-f` to sendmail or as the 'MAIL FROM' value over SMTP.
     *
     * @var string
     */
    public $Sender = '';

    /**
     * The Subject of the message.
     *
     * @var string
     */
    public $Subject = '';

    /**
     * An HTML or plain text message body.
     * If HTML then call isHTML(true).
     *
     * @var string
     */
    public $Body = '';

    /**
     * The plain-text message body.
     * This body can be read by mail clients that do not have HTML email
     * capability such as mutt & Eudora.
     * Clients that can read HTML will view the normal Body.
     *
     * @var string
     */
    public $AltBody = '';

    /**
     * An iCal message part body.
     * Only supported in simple alt or alt_inline message types
     * To generate iCal event structures, use classes like EasyPeasyICS or iCalcreator.
     *
     * @see http://sprain.ch/blog/downloads/php-class-easypeasyics-create-ical-files-with-php/
     * @see http://kigkonsult.se/iCalcreator/
     *
     * @var string
     */
    public $Ical = '';

    /**
     * Value-array of "method" in Contenttype header "text/calendar"
     *
     * @var string[***REMOVED***
     */
    protected static $IcalMethods = [
        self::ICAL_METHOD_REQUEST,
        self::ICAL_METHOD_PUBLISH,
        self::ICAL_METHOD_REPLY,
        self::ICAL_METHOD_ADD,
        self::ICAL_METHOD_CANCEL,
        self::ICAL_METHOD_REFRESH,
        self::ICAL_METHOD_COUNTER,
        self::ICAL_METHOD_DECLINECOUNTER,
    ***REMOVED***;

    /**
     * The complete compiled MIME message body.
     *
     * @var string
     */
    protected $MIMEBody = '';

    /**
     * The complete compiled MIME message headers.
     *
     * @var string
     */
    protected $MIMEHeader = '';

    /**
     * Extra headers that createHeader() doesn't fold in.
     *
     * @var string
     */
    protected $mailHeader = '';

    /**
     * Word-wrap the message body to this number of chars.
     * Set to 0 to not wrap. A useful value here is 78, for RFC2822 section 2.1.1 compliance.
     *
     * @see static::STD_LINE_LENGTH
     *
     * @var int
     */
    public $WordWrap = 0;

    /**
     * Which method to use to send mail.
     * Options: "mail", "sendmail", or "smtp".
     *
     * @var string
     */
    public $Mailer = 'mail';

    /**
     * The path to the sendmail program.
     *
     * @var string
     */
    public $Sendmail = '/usr/sbin/sendmail';

    /**
     * Whether mail() uses a fully sendmail-compatible MTA.
     * One which supports sendmail's "-oi -f" options.
     *
     * @var bool
     */
    public $UseSendmailOptions = true;

    /**
     * The email address that a reading confirmation should be sent to, also known as read receipt.
     *
     * @var string
     */
    public $ConfirmReadingTo = '';

    /**
     * The hostname to use in the Message-ID header and as default HELO string.
     * If empty, PHPMailer attempts to find one with, in order,
     * $_SERVER['SERVER_NAME'***REMOVED***, gethostname(), php_uname('n'), or the value
     * 'localhost.localdomain'.
     *
     * @see PHPMailer::$Helo
     *
     * @var string
     */
    public $Hostname = '';

    /**
     * An ID to be used in the Message-ID header.
     * If empty, a unique id will be generated.
     * You can set your own, but it must be in the format "<id@domain>",
     * as defined in RFC5322 section 3.6.4 or it will be ignored.
     *
     * @see https://tools.ietf.org/html/rfc5322#section-3.6.4
     *
     * @var string
     */
    public $MessageID = '';

    /**
     * The message Date to be used in the Date header.
     * If empty, the current date will be added.
     *
     * @var string
     */
    public $MessageDate = '';

    /**
     * SMTP hosts.
     * Either a single hostname or multiple semicolon-delimited hostnames.
     * You can also specify a different port
     * for each host by using this format: [hostname:port***REMOVED***
     * (e.g. "smtp1.example.com:25;smtp2.example.com").
     * You can also specify encryption type, for example:
     * (e.g. "tls://smtp1.example.com:587;ssl://smtp2.example.com:465").
     * Hosts will be tried in order.
     *
     * @var string
     */
    public $Host = 'localhost';

    /**
     * The default SMTP server port.
     *
     * @var int
     */
    public $Port = 25;

    /**
     * The SMTP HELO/EHLO name used for the SMTP connection.
     * Default is $Hostname. If $Hostname is empty, PHPMailer attempts to find
     * one with the same method described above for $Hostname.
     *
     * @see PHPMailer::$Hostname
     *
     * @var string
     */
    public $Helo = '';

    /**
     * What kind of encryption to use on the SMTP connection.
     * Options: '', static::ENCRYPTION_STARTTLS, or static::ENCRYPTION_SMTPS.
     *
     * @var string
     */
    public $SMTPSecure = '';

    /**
     * Whether to enable TLS encryption automatically if a server supports it,
     * even if `SMTPSecure` is not set to 'tls'.
     * Be aware that in PHP >= 5.6 this requires that the server's certificates are valid.
     *
     * @var bool
     */
    public $SMTPAutoTLS = true;

    /**
     * Whether to use SMTP authentication.
     * Uses the Username and Password properties.
     *
     * @see PHPMailer::$Username
     * @see PHPMailer::$Password
     *
     * @var bool
     */
    public $SMTPAuth = false;

    /**
     * Options array passed to stream_context_create when connecting via SMTP.
     *
     * @var array
     */
    public $SMTPOptions = [***REMOVED***;

    /**
     * SMTP username.
     *
     * @var string
     */
    public $Username = '';

    /**
     * SMTP password.
     *
     * @var string
     */
    public $Password = '';

    /**
     * SMTP auth type.
     * Options are CRAM-MD5, LOGIN, PLAIN, XOAUTH2, attempted in that order if not specified.
     *
     * @var string
     */
    public $AuthType = '';

    /**
     * An instance of the PHPMailer OAuth class.
     *
     * @var OAuth
     */
    protected $oauth;

    /**
     * The SMTP server timeout in seconds.
     * Default of 5 minutes (300sec) is from RFC2821 section 4.5.3.2.
     *
     * @var int
     */
    public $Timeout = 300;

    /**
     * Comma separated list of DSN notifications
     * 'NEVER' under no circumstances a DSN must be returned to the sender.
     *         If you use NEVER all other notifications will be ignored.
     * 'SUCCESS' will notify you when your mail has arrived at its destination.
     * 'FAILURE' will arrive if an error occurred during delivery.
     * 'DELAY'   will notify you if there is an unusual delay in delivery, but the actual
     *           delivery's outcome (success or failure) is not yet decided.
     *
     * @see https://tools.ietf.org/html/rfc3461 See section 4.1 for more information about NOTIFY
     */
    public $dsn = '';

    /**
     * SMTP class debug output mode.
     * Debug output level.
     * Options:
     * @see SMTP::DEBUG_OFF: No output
     * @see SMTP::DEBUG_CLIENT: Client messages
     * @see SMTP::DEBUG_SERVER: Client and server messages
     * @see SMTP::DEBUG_CONNECTION: As SERVER plus connection status
     * @see SMTP::DEBUG_LOWLEVEL: Noisy, low-level data output, rarely needed
     *
     * @see SMTP::$do_debug
     *
     * @var int
     */
    public $SMTPDebug = 0;

    /**
     * How to handle debug output.
     * Options:
     * * `echo` Output plain-text as-is, appropriate for CLI
     * * `html` Output escaped, line breaks converted to `<br>`, appropriate for browser output
     * * `error_log` Output to error log as configured in php.ini
     * By default PHPMailer will use `echo` if run from a `cli` or `cli-server` SAPI, `html` otherwise.
     * Alternatively, you can provide a callable expecting two params: a message string and the debug level:
     *
     * ```php
     * $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";};
     * ```
     *
     * Alternatively, you can pass in an instance of a PSR-3 compatible logger, though only `debug`
     * level output is used:
     *
     * ```php
     * $mail->Debugoutput = new myPsr3Logger;
     * ```
     *
     * @see SMTP::$Debugoutput
     *
     * @var string|callable|\Psr\Log\LoggerInterface
     */
    public $Debugoutput = 'echo';

    /**
     * Whether to keep the SMTP connection open after each message.
     * If this is set to true then the connection will remain open after a send,
     * and closing the connection will require an explicit call to smtpClose().
     * It's a good idea to use this if you are sending multiple messages as it reduces overhead.
     * See the mailing list example for how to use it.
     *
     * @var bool
     */
    public $SMTPKeepAlive = false;

    /**
     * Whether to split multiple to addresses into multiple messages
     * or send them all in one message.
     * Only supported in `mail` and `sendmail` transports, not in SMTP.
     *
     * @var bool
     *
     * @deprecated 6.0.0 PHPMailer isn't a mailing list manager!
     */
    public $SingleTo = false;

    /**
     * Storage for addresses when SingleTo is enabled.
     *
     * @var array
     */
    protected $SingleToArray = [***REMOVED***;

    /**
     * Whether to generate VERP addresses on send.
     * Only applicable when sending via SMTP.
     *
     * @see https://en.wikipedia.org/wiki/Variable_envelope_return_path
     * @see http://www.postfix.org/VERP_README.html Postfix VERP info
     *
     * @var bool
     */
    public $do_verp = false;

    /**
     * Whether to allow sending messages with an empty body.
     *
     * @var bool
     */
    public $AllowEmpty = false;

    /**
     * DKIM selector.
     *
     * @var string
     */
    public $DKIM_selector = '';

    /**
     * DKIM Identity.
     * Usually the email address used as the source of the email.
     *
     * @var string
     */
    public $DKIM_identity = '';

    /**
     * DKIM passphrase.
     * Used if your key is encrypted.
     *
     * @var string
     */
    public $DKIM_passphrase = '';

    /**
     * DKIM signing domain name.
     *
     * @example 'example.com'
     *
     * @var string
     */
    public $DKIM_domain = '';

    /**
     * DKIM Copy header field values for diagnostic use.
     *
     * @var bool
     */
    public $DKIM_copyHeaderFields = true;

    /**
     * DKIM Extra signing headers.
     *
     * @example ['List-Unsubscribe', 'List-Help'***REMOVED***
     *
     * @var array
     */
    public $DKIM_extraHeaders = [***REMOVED***;

    /**
     * DKIM private key file path.
     *
     * @var string
     */
    public $DKIM_private = '';

    /**
     * DKIM private key string.
     *
     * If set, takes precedence over `$DKIM_private`.
     *
     * @var string
     */
    public $DKIM_private_string = '';

    /**
     * Callback Action function name.
     *
     * The function that handles the result of the send email action.
     * It is called out by send() for each email sent.
     *
     * Value can be any php callable: http://www.php.net/is_callable
     *
     * Parameters:
     *   bool $result        result of the send action
     *   array   $to            email addresses of the recipients
     *   array   $cc            cc email addresses
     *   array   $bcc           bcc email addresses
     *   string  $subject       the subject
     *   string  $body          the email body
     *   string  $from          email address of sender
     *   string  $extra         extra information of possible use
     *                          "smtp_transaction_id' => last smtp transaction id
     *
     * @var string
     */
    public $action_function = '';

    /**
     * What to put in the X-Mailer header.
     * Options: An empty string for PHPMailer default, whitespace/null for none, or a string to use.
     *
     * @var string|null
     */
    public $XMailer = '';

    /**
     * Which validator to use by default when validating email addresses.
     * May be a callable to inject your own validator, but there are several built-in validators.
     * The default validator uses PHP's FILTER_VALIDATE_EMAIL filter_var option.
     *
     * @see PHPMailer::validateAddress()
     *
     * @var string|callable
     */
    public static $validator = 'php';

    /**
     * An instance of the SMTP sender class.
     *
     * @var SMTP
     */
    protected $smtp;

    /**
     * The array of 'to' names and addresses.
     *
     * @var array
     */
    protected $to = [***REMOVED***;

    /**
     * The array of 'cc' names and addresses.
     *
     * @var array
     */
    protected $cc = [***REMOVED***;

    /**
     * The array of 'bcc' names and addresses.
     *
     * @var array
     */
    protected $bcc = [***REMOVED***;

    /**
     * The array of reply-to names and addresses.
     *
     * @var array
     */
    protected $ReplyTo = [***REMOVED***;

    /**
     * An array of all kinds of addresses.
     * Includes all of $to, $cc, $bcc.
     *
     * @see PHPMailer::$to
     * @see PHPMailer::$cc
     * @see PHPMailer::$bcc
     *
     * @var array
     */
    protected $all_recipients = [***REMOVED***;

    /**
     * An array of names and addresses queued for validation.
     * In send(), valid and non duplicate entries are moved to $all_recipients
     * and one of $to, $cc, or $bcc.
     * This array is used only for addresses with IDN.
     *
     * @see PHPMailer::$to
     * @see PHPMailer::$cc
     * @see PHPMailer::$bcc
     * @see PHPMailer::$all_recipients
     *
     * @var array
     */
    protected $RecipientsQueue = [***REMOVED***;

    /**
     * An array of reply-to names and addresses queued for validation.
     * In send(), valid and non duplicate entries are moved to $ReplyTo.
     * This array is used only for addresses with IDN.
     *
     * @see PHPMailer::$ReplyTo
     *
     * @var array
     */
    protected $ReplyToQueue = [***REMOVED***;

    /**
     * The array of attachments.
     *
     * @var array
     */
    protected $attachment = [***REMOVED***;

    /**
     * The array of custom headers.
     *
     * @var array
     */
    protected $CustomHeader = [***REMOVED***;

    /**
     * The most recent Message-ID (including angular brackets).
     *
     * @var string
     */
    protected $lastMessageID = '';

    /**
     * The message's MIME type.
     *
     * @var string
     */
    protected $message_type = '';

    /**
     * The array of MIME boundary strings.
     *
     * @var array
     */
    protected $boundary = [***REMOVED***;

    /**
     * The array of available text strings for the current language.
     *
     * @var array
     */
    protected $language = [***REMOVED***;

    /**
     * The number of errors encountered.
     *
     * @var int
     */
    protected $error_count = 0;

    /**
     * The S/MIME certificate file path.
     *
     * @var string
     */
    protected $sign_cert_file = '';

    /**
     * The S/MIME key file path.
     *
     * @var string
     */
    protected $sign_key_file = '';

    /**
     * The optional S/MIME extra certificates ("CA Chain") file path.
     *
     * @var string
     */
    protected $sign_extracerts_file = '';

    /**
     * The S/MIME password for the key.
     * Used only if the key is encrypted.
     *
     * @var string
     */
    protected $sign_key_pass = '';

    /**
     * Whether to throw exceptions for errors.
     *
     * @var bool
     */
    protected $exceptions = false;

    /**
     * Unique ID used for message ID and boundaries.
     *
     * @var string
     */
    protected $uniqueid = '';

    /**
     * The PHPMailer Version number.
     *
     * @var string
     */
    const VERSION = '6.5.1';

    /**
     * Error severity: message only, continue processing.
     *
     * @var int
     */
    const STOP_MESSAGE = 0;

    /**
     * Error severity: message, likely ok to continue processing.
     *
     * @var int
     */
    const STOP_CONTINUE = 1;

    /**
     * Error severity: message, plus full stop, critical error reached.
     *
     * @var int
     */
    const STOP_CRITICAL = 2;

    /**
     * The SMTP standard CRLF line break.
     * If you want to change line break format, change static::$LE, not this.
     */
    const CRLF = "\r\n";

    /**
     * "Folding White Space" a white space string used for line folding.
     */
    const FWS = ' ';

    /**
     * SMTP RFC standard line ending; Carriage Return, Line Feed.
     *
     * @var string
     */
    protected static $LE = self::CRLF;

    /**
     * The maximum line length supported by mail().
     *
     * Background: mail() will sometimes corrupt messages
     * with headers headers longer than 65 chars, see #818.
     *
     * @var int
     */
    const MAIL_MAX_LINE_LENGTH = 63;

    /**
     * The maximum line length allowed by RFC 2822 section 2.1.1.
     *
     * @var int
     */
    const MAX_LINE_LENGTH = 998;

    /**
     * The lower maximum line length allowed by RFC 2822 section 2.1.1.
     * This length does NOT include the line break
     * 76 means that lines will be 77 or 78 chars depending on whether
     * the line break format is LF or CRLF; both are valid.
     *
     * @var int
     */
    const STD_LINE_LENGTH = 76;

    /**
     * Constructor.
     *
     * @param bool $exceptions Should we throw external exceptions?
     */
    public function __construct($exceptions = null)
***REMOVED***
        if (null !== $exceptions) {
            $this->exceptions = (bool) $exceptions;
    ***REMOVED***
        //Pick an appropriate debug output format automatically
        $this->Debugoutput = (strpos(PHP_SAPI, 'cli') !== false ? 'echo' : 'html');
***REMOVED***

    /**
     * Destructor.
     */
    public function __destruct()
***REMOVED***
        //Close any open SMTP connection nicely
        $this->smtpClose();
***REMOVED***

    /**
     * Call mail() in a safe_mode-aware fashion.
     * Also, unless sendmail_path points to sendmail (or something that
     * claims to be sendmail), don't pass params (not a perfect fix,
     * but it will do).
     *
     * @param string      $to      To
     * @param string      $subject Subject
     * @param string      $body    Message Body
     * @param string      $header  Additional Header(s)
     * @param string|null $params  Params
     *
     * @return bool
     */
    private function mailPassthru($to, $subject, $body, $header, $params)
***REMOVED***
        //Check overloading of mail function to avoid double-encoding
        if (ini_get('mbstring.func_overload') & 1) {
            $subject = $this->secureHeader($subject);
    ***REMOVED*** else {
            $subject = $this->encodeHeader($this->secureHeader($subject));
    ***REMOVED***
        //Calling mail() with null params breaks
        $this->edebug('Sending with mail()');
        $this->edebug('Sendmail path: ' . ini_get('sendmail_path'));
        $this->edebug("Envelope sender: {$this->Sender}");
        $this->edebug("To: {$to}");
        $this->edebug("Subject: {$subject}");
        $this->edebug("Headers: {$header}");
        if (!$this->UseSendmailOptions || null === $params) {
            $result = @mail($to, $subject, $body, $header);
    ***REMOVED*** else {
            $this->edebug("Additional params: {$params}");
            $result = @mail($to, $subject, $body, $header, $params);
    ***REMOVED***
        $this->edebug('Result: ' . ($result ? 'true' : 'false'));
        return $result;
***REMOVED***

    /**
     * Output debugging info via a user-defined method.
     * Only generates output if debug output is enabled.
     *
     * @see PHPMailer::$Debugoutput
     * @see PHPMailer::$SMTPDebug
     *
     * @param string $str
     */
    protected function edebug($str)
***REMOVED***
        if ($this->SMTPDebug <= 0) {
            return;
    ***REMOVED***
        //Is this a PSR-3 logger?
        if ($this->Debugoutput instanceof \Psr\Log\LoggerInterface) {
            $this->Debugoutput->debug($str);

            return;
    ***REMOVED***
        //Avoid clash with built-in function names
        if (is_callable($this->Debugoutput) && !in_array($this->Debugoutput, ['error_log', 'html', 'echo'***REMOVED***)) {
            call_user_func($this->Debugoutput, $str, $this->SMTPDebug);

            return;
    ***REMOVED***
        switch ($this->Debugoutput) {
            case 'error_log':
                //Don't output, just log
                /** @noinspection ForgottenDebugOutputInspection */
                error_log($str);
                break;
            case 'html':
                //Cleans up output a bit for a better looking, HTML-safe output
                echo htmlentities(
                    preg_replace('/[\r\n***REMOVED***+/', '', $str),
                    ENT_QUOTES,
                    'UTF-8'
                ), "<br>\n";
                break;
            case 'echo':
            default:
                //Normalize line breaks
                $str = preg_replace('/\r\n|\r/m', "\n", $str);
                echo gmdate('Y-m-d H:i:s'),
                "\t",
                    //Trim trailing space
                trim(
                    //Indent for readability, except for trailing break
                    str_replace(
                        "\n",
                        "\n                   \t                  ",
                        trim($str)
                    )
                ),
                "\n";
    ***REMOVED***
***REMOVED***

    /**
     * Sets message type to HTML or plain.
     *
     * @param bool $isHtml True for HTML mode
     */
    public function isHTML($isHtml = true)
***REMOVED***
        if ($isHtml) {
            $this->ContentType = static::CONTENT_TYPE_TEXT_HTML;
    ***REMOVED*** else {
            $this->ContentType = static::CONTENT_TYPE_PLAINTEXT;
    ***REMOVED***
***REMOVED***

    /**
     * Send messages using SMTP.
     */
    public function isSMTP()
***REMOVED***
        $this->Mailer = 'smtp';
***REMOVED***

    /**
     * Send messages using PHP's mail() function.
     */
    public function isMail()
***REMOVED***
        $this->Mailer = 'mail';
***REMOVED***

    /**
     * Send messages using $Sendmail.
     */
    public function isSendmail()
***REMOVED***
        $ini_sendmail_path = ini_get('sendmail_path');

        if (false === stripos($ini_sendmail_path, 'sendmail')) {
            $this->Sendmail = '/usr/sbin/sendmail';
    ***REMOVED*** else {
            $this->Sendmail = $ini_sendmail_path;
    ***REMOVED***
        $this->Mailer = 'sendmail';
***REMOVED***

    /**
     * Send messages using qmail.
     */
    public function isQmail()
***REMOVED***
        $ini_sendmail_path = ini_get('sendmail_path');

        if (false === stripos($ini_sendmail_path, 'qmail')) {
            $this->Sendmail = '/var/qmail/bin/qmail-inject';
    ***REMOVED*** else {
            $this->Sendmail = $ini_sendmail_path;
    ***REMOVED***
        $this->Mailer = 'qmail';
***REMOVED***

    /**
     * Add a "To" address.
     *
     * @param string $address The email address to send to
     * @param string $name
     *
     * @throws Exception
     *
     * @return bool true on success, false if address already used or invalid in some way
     */
    public function addAddress($address, $name = '')
***REMOVED***
        return $this->addOrEnqueueAnAddress('to', $address, $name);
***REMOVED***

    /**
     * Add a "CC" address.
     *
     * @param string $address The email address to send to
     * @param string $name
     *
     * @throws Exception
     *
     * @return bool true on success, false if address already used or invalid in some way
     */
    public function addCC($address, $name = '')
***REMOVED***
        return $this->addOrEnqueueAnAddress('cc', $address, $name);
***REMOVED***

    /**
     * Add a "BCC" address.
     *
     * @param string $address The email address to send to
     * @param string $name
     *
     * @throws Exception
     *
     * @return bool true on success, false if address already used or invalid in some way
     */
    public function addBCC($address, $name = '')
***REMOVED***
        return $this->addOrEnqueueAnAddress('bcc', $address, $name);
***REMOVED***

    /**
     * Add a "Reply-To" address.
     *
     * @param string $address The email address to reply to
     * @param string $name
     *
     * @throws Exception
     *
     * @return bool true on success, false if address already used or invalid in some way
     */
    public function addReplyTo($address, $name = '')
***REMOVED***
        return $this->addOrEnqueueAnAddress('Reply-To', $address, $name);
***REMOVED***

    /**
     * Add an address to one of the recipient arrays or to the ReplyTo array. Because PHPMailer
     * can't validate addresses with an IDN without knowing the PHPMailer::$CharSet (that can still
     * be modified after calling this function), addition of such addresses is delayed until send().
     * Addresses that have been added already return false, but do not throw exceptions.
     *
     * @param string $kind    One of 'to', 'cc', 'bcc', or 'ReplyTo'
     * @param string $address The email address to send, resp. to reply to
     * @param string $name
     *
     * @throws Exception
     *
     * @return bool true on success, false if address already used or invalid in some way
     */
    protected function addOrEnqueueAnAddress($kind, $address, $name)
***REMOVED***
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n***REMOVED***+/', '', $name)); //Strip breaks and trim
        $pos = strrpos($address, '@');
        if (false === $pos) {
            //At-sign is missing.
            $error_message = sprintf(
                '%s (%s): %s',
                $this->lang('invalid_address'),
                $kind,
                $address
            );
            $this->setError($error_message);
            $this->edebug($error_message);
            if ($this->exceptions) {
                throw new Exception($error_message);
        ***REMOVED***

            return false;
    ***REMOVED***
        $params = [$kind, $address, $name***REMOVED***;
        //Enqueue addresses with IDN until we know the PHPMailer::$CharSet.
        if (static::idnSupported() && $this->has8bitChars(substr($address, ++$pos))) {
            if ('Reply-To' !== $kind) {
                if (!array_key_exists($address, $this->RecipientsQueue)) {
                    $this->RecipientsQueue[$address***REMOVED*** = $params;

                    return true;
            ***REMOVED***
        ***REMOVED*** elseif (!array_key_exists($address, $this->ReplyToQueue)) {
                $this->ReplyToQueue[$address***REMOVED*** = $params;

                return true;
        ***REMOVED***

            return false;
    ***REMOVED***

        //Immediately add standard addresses without IDN.
        return call_user_func_array([$this, 'addAnAddress'***REMOVED***, $params);
***REMOVED***

    /**
     * Add an address to one of the recipient arrays or to the ReplyTo array.
     * Addresses that have been added already return false, but do not throw exceptions.
     *
     * @param string $kind    One of 'to', 'cc', 'bcc', or 'ReplyTo'
     * @param string $address The email address to send, resp. to reply to
     * @param string $name
     *
     * @throws Exception
     *
     * @return bool true on success, false if address already used or invalid in some way
     */
    protected function addAnAddress($kind, $address, $name = '')
***REMOVED***
        if (!in_array($kind, ['to', 'cc', 'bcc', 'Reply-To'***REMOVED***)) {
            $error_message = sprintf(
                '%s: %s',
                $this->lang('Invalid recipient kind'),
                $kind
            );
            $this->setError($error_message);
            $this->edebug($error_message);
            if ($this->exceptions) {
                throw new Exception($error_message);
        ***REMOVED***

            return false;
    ***REMOVED***
        if (!static::validateAddress($address)) {
            $error_message = sprintf(
                '%s (%s): %s',
                $this->lang('invalid_address'),
                $kind,
                $address
            );
            $this->setError($error_message);
            $this->edebug($error_message);
            if ($this->exceptions) {
                throw new Exception($error_message);
        ***REMOVED***

            return false;
    ***REMOVED***
        if ('Reply-To' !== $kind) {
            if (!array_key_exists(strtolower($address), $this->all_recipients)) {
                $this->{$kind}[***REMOVED*** = [$address, $name***REMOVED***;
                $this->all_recipients[strtolower($address)***REMOVED*** = true;

                return true;
        ***REMOVED***
    ***REMOVED*** elseif (!array_key_exists(strtolower($address), $this->ReplyTo)) {
            $this->ReplyTo[strtolower($address)***REMOVED*** = [$address, $name***REMOVED***;

            return true;
    ***REMOVED***

        return false;
***REMOVED***

    /**
     * Parse and validate a string containing one or more RFC822-style comma-separated email addresses
     * of the form "display name <address>" into an array of name/address pairs.
     * Uses the imap_rfc822_parse_adrlist function if the IMAP extension is available.
     * Note that quotes in the name part are removed.
     *
     * @see http://www.andrew.cmu.edu/user/agreen1/testing/mrbs/web/Mail/RFC822.php A more careful implementation
     *
     * @param string $addrstr The address list string
     * @param bool   $useimap Whether to use the IMAP extension to parse the list
     *
     * @return array
     */
    public static function parseAddresses($addrstr, $useimap = true, $charset = self::CHARSET_ISO88591)
***REMOVED***
        $addresses = [***REMOVED***;
        if ($useimap && function_exists('imap_rfc822_parse_adrlist')) {
            //Use this built-in parser if it's available
            $list = imap_rfc822_parse_adrlist($addrstr, '');
            // Clear any potential IMAP errors to get rid of notices being thrown at end of script.
            imap_errors();
            foreach ($list as $address) {
                if (
                    '.SYNTAX-ERROR.' !== $address->host &&
                    static::validateAddress($address->mailbox . '@' . $address->host)
                ) {
                    //Decode the name part if it's present and encoded
                    if (
                        property_exists($address, 'personal') &&
                        //Check for a Mbstring constant rather than using extension_loaded, which is sometimes disabled
                        defined('MB_CASE_UPPER') &&
                        preg_match('/^=\?.*\?=$/s', $address->personal)
                    ) {
                        $origCharset = mb_internal_encoding();
                        mb_internal_encoding($charset);
                        //Undo any RFC2047-encoded spaces-as-underscores
                        $address->personal = str_replace('_', '=20', $address->personal);
                        //Decode the name
                        $address->personal = mb_decode_mimeheader($address->personal);
                        mb_internal_encoding($origCharset);
                ***REMOVED***

                    $addresses[***REMOVED*** = [
                        'name' => (property_exists($address, 'personal') ? $address->personal : ''),
                        'address' => $address->mailbox . '@' . $address->host,
                    ***REMOVED***;
            ***REMOVED***
        ***REMOVED***
    ***REMOVED*** else {
            //Use this simpler parser
            $list = explode(',', $addrstr);
            foreach ($list as $address) {
                $address = trim($address);
                //Is there a separate name part?
                if (strpos($address, '<') === false) {
                    //No separate name, just use the whole thing
                    if (static::validateAddress($address)) {
                        $addresses[***REMOVED*** = [
                            'name' => '',
                            'address' => $address,
                        ***REMOVED***;
                ***REMOVED***
            ***REMOVED*** else {
                    list($name, $email) = explode('<', $address);
                    $email = trim(str_replace('>', '', $email));
                    $name = trim($name);
                    if (static::validateAddress($email)) {
                        //Check for a Mbstring constant rather than using extension_loaded, which is sometimes disabled
                        //If this name is encoded, decode it
                        if (defined('MB_CASE_UPPER') && preg_match('/^=\?.*\?=$/s', $name)) {
                            $origCharset = mb_internal_encoding();
                            mb_internal_encoding($charset);
                            //Undo any RFC2047-encoded spaces-as-underscores
                            $name = str_replace('_', '=20', $name);
                            //Decode the name
                            $name = mb_decode_mimeheader($name);
                            mb_internal_encoding($origCharset);
                    ***REMOVED***
                        $addresses[***REMOVED*** = [
                            //Remove any surrounding quotes and spaces from the name
                            'name' => trim($name, '\'" '),
                            'address' => $email,
                        ***REMOVED***;
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***

        return $addresses;
***REMOVED***

    /**
     * Set the From and FromName properties.
     *
     * @param string $address
     * @param string $name
     * @param bool   $auto    Whether to also set the Sender address, defaults to true
     *
     * @throws Exception
     *
     * @return bool
     */
    public function setFrom($address, $name = '', $auto = true)
***REMOVED***
        $address = trim($address);
        $name = trim(preg_replace('/[\r\n***REMOVED***+/', '', $name)); //Strip breaks and trim
        //Don't validate now addresses with IDN. Will be done in send().
        $pos = strrpos($address, '@');
        if (
            (false === $pos)
            || ((!$this->has8bitChars(substr($address, ++$pos)) || !static::idnSupported())
            && !static::validateAddress($address))
        ) {
            $error_message = sprintf(
                '%s (From): %s',
                $this->lang('invalid_address'),
                $address
            );
            $this->setError($error_message);
            $this->edebug($error_message);
            if ($this->exceptions) {
                throw new Exception($error_message);
        ***REMOVED***

            return false;
    ***REMOVED***
        $this->From = $address;
        $this->FromName = $name;
        if ($auto && empty($this->Sender)) {
            $this->Sender = $address;
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Return the Message-ID header of the last email.
     * Technically this is the value from the last time the headers were created,
     * but it's also the message ID of the last sent message except in
     * pathological cases.
     *
     * @return string
     */
    public function getLastMessageID()
***REMOVED***
        return $this->lastMessageID;
***REMOVED***

    /**
     * Check that a string looks like an email address.
     * Validation patterns supported:
     * * `auto` Pick best pattern automatically;
     * * `pcre8` Use the squiloople.com pattern, requires PCRE > 8.0;
     * * `pcre` Use old PCRE implementation;
     * * `php` Use PHP built-in FILTER_VALIDATE_EMAIL;
     * * `html5` Use the pattern given by the HTML5 spec for 'email' type form input elements.
     * * `noregex` Don't use a regex: super fast, really dumb.
     * Alternatively you may pass in a callable to inject your own validator, for example:
     *
     * ```php
     * PHPMailer::validateAddress('user@example.com', function($address) {
     *     return (strpos($address, '@') !== false);
     * });
     * ```
     *
     * You can also set the PHPMailer::$validator static to a callable, allowing built-in methods to use your validator.
     *
     * @param string          $address       The email address to check
     * @param string|callable $patternselect Which pattern to use
     *
     * @return bool
     */
    public static function validateAddress($address, $patternselect = null)
***REMOVED***
        if (null === $patternselect) {
            $patternselect = static::$validator;
    ***REMOVED***
        //Don't allow strings as callables, see SECURITY.md and CVE-2021-3603
        if (is_callable($patternselect) && !is_string($patternselect)) {
            return call_user_func($patternselect, $address);
    ***REMOVED***
        //Reject line breaks in addresses; it's valid RFC5322, but not RFC5321
        if (strpos($address, "\n") !== false || strpos($address, "\r") !== false) {
            return false;
    ***REMOVED***
        switch ($patternselect) {
            case 'pcre': //Kept for BC
            case 'pcre8':
                /*
                 * A more complex and more permissive version of the RFC5322 regex on which FILTER_VALIDATE_EMAIL
                 * is based.
                 * In addition to the addresses allowed by filter_var, also permits:
                 *  * dotless domains: `a@b`
                 *  * comments: `1234 @ local(blah) .machine .example`
                 *  * quoted elements: `'"test blah"@example.org'`
                 *  * numeric TLDs: `a@b.123`
                 *  * unbracketed IPv4 literals: `a@192.168.0.1`
                 *  * IPv6 literals: 'first.last@[IPv6:a1::***REMOVED***'
                 * Not all of these will necessarily work for sending!
                 *
                 * @see       http://squiloople.com/2009/12/20/email-address-validation/
                 * @copyright 2009-2010 Michael Rushton
                 * Feel free to use and redistribute this code. But please keep this copyright notice.
                 */
                return (bool) preg_match(
                    '/^(?!(?>(?1)"?(?>\\\[ -~***REMOVED***|[^"***REMOVED***)"?(?1)){255,})(?!(?>(?1)"?(?>\\\[ -~***REMOVED***|[^"***REMOVED***)"?(?1)){65,}@)' .
                    '((?>(?>(?>((?>(?>(?>\x0D\x0A)?[\t ***REMOVED***)+|(?>[\t ***REMOVED****\x0D\x0A)?[\t ***REMOVED***+)?)(\((?>(?2)' .
                    '(?>[\x01-\x08\x0B\x0C\x0E-\'*-\[\***REMOVED***-\x7F***REMOVED***|\\\[\x00-\x7F***REMOVED***|(?3)))*(?2)\)))+(?2))|(?2))?)' .
                    '([!#-\'*+\/-9=?^-~-***REMOVED***+|"(?>(?2)(?>[\x01-\x08\x0B\x0C\x0E-!#-\[\***REMOVED***-\x7F***REMOVED***|\\\[\x00-\x7F***REMOVED***))*' .
                    '(?2)")(?>(?1)\.(?1)(?4))*(?1)@(?!(?1)[a-z0-9-***REMOVED***{64,})(?1)(?>([a-z0-9***REMOVED***(?>[a-z0-9-***REMOVED****[a-z0-9***REMOVED***)?)' .
                    '(?>(?1)\.(?!(?1)[a-z0-9-***REMOVED***{64,})(?1)(?5)){0,126}|\[(?:(?>IPv6:(?>([a-f0-9***REMOVED***{1,4})(?>:(?6)){7}' .
                    '|(?!(?:.*[a-f0-9***REMOVED***[:\***REMOVED******REMOVED***){8,})((?6)(?>:(?6)){0,6})?::(?7)?))|(?>(?>IPv6:(?>(?6)(?>:(?6)){5}:' .
                    '|(?!(?:.*[a-f0-9***REMOVED***:){6,})(?8)?::(?>((?6)(?>:(?6)){0,4}):)?))?(25[0-5***REMOVED***|2[0-4***REMOVED***[0-9***REMOVED***|1[0-9***REMOVED***{2}' .
                    '|[1-9***REMOVED***?[0-9***REMOVED***)(?>\.(?9)){3}))\***REMOVED***)(?1)$/isD',
                    $address
                );
            case 'html5':
                /*
                 * This is the pattern used in the HTML5 spec for validation of 'email' type form input elements.
                 *
                 * @see https://html.spec.whatwg.org/#e-mail-state-(type=email)
                 */
                return (bool) preg_match(
                    '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-***REMOVED***+@[a-zA-Z0-9***REMOVED***(?:[a-zA-Z0-9-***REMOVED***{0,61}' .
                    '[a-zA-Z0-9***REMOVED***)?(?:\.[a-zA-Z0-9***REMOVED***(?:[a-zA-Z0-9-***REMOVED***{0,61}[a-zA-Z0-9***REMOVED***)?)*$/sD',
                    $address
                );
            case 'php':
            default:
                return filter_var($address, FILTER_VALIDATE_EMAIL) !== false;
    ***REMOVED***
***REMOVED***

    /**
     * Tells whether IDNs (Internationalized Domain Names) are supported or not. This requires the
     * `intl` and `mbstring` PHP extensions.
     *
     * @return bool `true` if required functions for IDN support are present
     */
    public static function idnSupported()
***REMOVED***
        return function_exists('idn_to_ascii') && function_exists('mb_convert_encoding');
***REMOVED***

    /**
     * Converts IDN in given email address to its ASCII form, also known as punycode, if possible.
     * Important: Address must be passed in same encoding as currently set in PHPMailer::$CharSet.
     * This function silently returns unmodified address if:
     * - No conversion is necessary (i.e. domain name is not an IDN, or is already in ASCII form)
     * - Conversion to punycode is impossible (e.g. required PHP functions are not available)
     *   or fails for any reason (e.g. domain contains characters not allowed in an IDN).
     *
     * @see PHPMailer::$CharSet
     *
     * @param string $address The email address to convert
     *
     * @return string The encoded address in ASCII form
     */
    public function punyencodeAddress($address)
***REMOVED***
        //Verify we have required functions, CharSet, and at-sign.
        $pos = strrpos($address, '@');
        if (
            !empty($this->CharSet) &&
            false !== $pos &&
            static::idnSupported()
        ) {
            $domain = substr($address, ++$pos);
            //Verify CharSet string is a valid one, and domain properly encoded in this CharSet.
            if ($this->has8bitChars($domain) && @mb_check_encoding($domain, $this->CharSet)) {
                //Convert the domain from whatever charset it's in to UTF-8
                $domain = mb_convert_encoding($domain, self::CHARSET_UTF8, $this->CharSet);
                //Ignore IDE complaints about this line - method signature changed in PHP 5.4
                $errorcode = 0;
                if (defined('INTL_IDNA_VARIANT_UTS46')) {
                    //Use the current punycode standard (appeared in PHP 7.2)
                    $punycode = idn_to_ascii(
                        $domain,
                        \IDNA_DEFAULT | \IDNA_USE_STD3_RULES | \IDNA_CHECK_BIDI |
                            \IDNA_CHECK_CONTEXTJ | \IDNA_NONTRANSITIONAL_TO_ASCII,
                        \INTL_IDNA_VARIANT_UTS46
                    );
            ***REMOVED*** elseif (defined('INTL_IDNA_VARIANT_2003')) {
                    //Fall back to this old, deprecated/removed encoding
                    $punycode = idn_to_ascii($domain, $errorcode, \INTL_IDNA_VARIANT_2003);
            ***REMOVED*** else {
                    //Fall back to a default we don't know about
                    $punycode = idn_to_ascii($domain, $errorcode);
            ***REMOVED***
                if (false !== $punycode) {
                    return substr($address, 0, $pos) . $punycode;
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***

        return $address;
***REMOVED***

    /**
     * Create a message and send it.
     * Uses the sending method specified by $Mailer.
     *
     * @throws Exception
     *
     * @return bool false on error - See the ErrorInfo property for details of the error
     */
    public function send()
***REMOVED***
        try {
            if (!$this->preSend()) {
                return false;
        ***REMOVED***

            return $this->postSend();
    ***REMOVED*** catch (Exception $exc) {
            $this->mailHeader = '';
            $this->setError($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
        ***REMOVED***

            return false;
    ***REMOVED***
***REMOVED***

    /**
     * Prepare a message for sending.
     *
     * @throws Exception
     *
     * @return bool
     */
    public function preSend()
***REMOVED***
        if (
            'smtp' === $this->Mailer
            || ('mail' === $this->Mailer && (\PHP_VERSION_ID >= 80000 || stripos(PHP_OS, 'WIN') === 0))
        ) {
            //SMTP mandates RFC-compliant line endings
            //and it's also used with mail() on Windows
            static::setLE(self::CRLF);
    ***REMOVED*** else {
            //Maintain backward compatibility with legacy Linux command line mailers
            static::setLE(PHP_EOL);
    ***REMOVED***
        //Check for buggy PHP versions that add a header with an incorrect line break
        if (
            'mail' === $this->Mailer
            && ((\PHP_VERSION_ID >= 70000 && \PHP_VERSION_ID < 70017)
                || (\PHP_VERSION_ID >= 70100 && \PHP_VERSION_ID < 70103))
            && ini_get('mail.add_x_header') === '1'
            && stripos(PHP_OS, 'WIN') === 0
        ) {
            trigger_error($this->lang('buggy_php'), E_USER_WARNING);
    ***REMOVED***

        try {
            $this->error_count = 0; //Reset errors
            $this->mailHeader = '';

            //Dequeue recipient and Reply-To addresses with IDN
            foreach (array_merge($this->RecipientsQueue, $this->ReplyToQueue) as $params) {
                $params[1***REMOVED*** = $this->punyencodeAddress($params[1***REMOVED***);
                call_user_func_array([$this, 'addAnAddress'***REMOVED***, $params);
        ***REMOVED***
            if (count($this->to) + count($this->cc) + count($this->bcc) < 1) {
                throw new Exception($this->lang('provide_address'), self::STOP_CRITICAL);
        ***REMOVED***

            //Validate From, Sender, and ConfirmReadingTo addresses
            foreach (['From', 'Sender', 'ConfirmReadingTo'***REMOVED*** as $address_kind) {
                $this->$address_kind = trim($this->$address_kind);
                if (empty($this->$address_kind)) {
                    continue;
            ***REMOVED***
                $this->$address_kind = $this->punyencodeAddress($this->$address_kind);
                if (!static::validateAddress($this->$address_kind)) {
                    $error_message = sprintf(
                        '%s (%s): %s',
                        $this->lang('invalid_address'),
                        $address_kind,
                        $this->$address_kind
                    );
                    $this->setError($error_message);
                    $this->edebug($error_message);
                    if ($this->exceptions) {
                        throw new Exception($error_message);
                ***REMOVED***

                    return false;
            ***REMOVED***
        ***REMOVED***

            //Set whether the message is multipart/alternative
            if ($this->alternativeExists()) {
                $this->ContentType = static::CONTENT_TYPE_MULTIPART_ALTERNATIVE;
        ***REMOVED***

            $this->setMessageType();
            //Refuse to send an empty message unless we are specifically allowing it
            if (!$this->AllowEmpty && empty($this->Body)) {
                throw new Exception($this->lang('empty_message'), self::STOP_CRITICAL);
        ***REMOVED***

            //Trim subject consistently
            $this->Subject = trim($this->Subject);
            //Create body before headers in case body makes changes to headers (e.g. altering transfer encoding)
            $this->MIMEHeader = '';
            $this->MIMEBody = $this->createBody();
            //createBody may have added some headers, so retain them
            $tempheaders = $this->MIMEHeader;
            $this->MIMEHeader = $this->createHeader();
            $this->MIMEHeader .= $tempheaders;

            //To capture the complete message when using mail(), create
            //an extra header list which createHeader() doesn't fold in
            if ('mail' === $this->Mailer) {
                if (count($this->to) > 0) {
                    $this->mailHeader .= $this->addrAppend('To', $this->to);
            ***REMOVED*** else {
                    $this->mailHeader .= $this->headerLine('To', 'undisclosed-recipients:;');
            ***REMOVED***
                $this->mailHeader .= $this->headerLine(
                    'Subject',
                    $this->encodeHeader($this->secureHeader($this->Subject))
                );
        ***REMOVED***

            //Sign with DKIM if enabled
            if (
                !empty($this->DKIM_domain)
                && !empty($this->DKIM_selector)
                && (!empty($this->DKIM_private_string)
                    || (!empty($this->DKIM_private)
                        && static::isPermittedPath($this->DKIM_private)
                        && file_exists($this->DKIM_private)
                    )
                )
            ) {
                $header_dkim = $this->DKIM_Add(
                    $this->MIMEHeader . $this->mailHeader,
                    $this->encodeHeader($this->secureHeader($this->Subject)),
                    $this->MIMEBody
                );
                $this->MIMEHeader = static::stripTrailingWSP($this->MIMEHeader) . static::$LE .
                    static::normalizeBreaks($header_dkim) . static::$LE;
        ***REMOVED***

            return true;
    ***REMOVED*** catch (Exception $exc) {
            $this->setError($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
        ***REMOVED***

            return false;
    ***REMOVED***
***REMOVED***

    /**
     * Actually send a message via the selected mechanism.
     *
     * @throws Exception
     *
     * @return bool
     */
    public function postSend()
***REMOVED***
        try {
            //Choose the mailer and send through it
            switch ($this->Mailer) {
                case 'sendmail':
                case 'qmail':
                    return $this->sendmailSend($this->MIMEHeader, $this->MIMEBody);
                case 'smtp':
                    return $this->smtpSend($this->MIMEHeader, $this->MIMEBody);
                case 'mail':
                    return $this->mailSend($this->MIMEHeader, $this->MIMEBody);
                default:
                    $sendMethod = $this->Mailer . 'Send';
                    if (method_exists($this, $sendMethod)) {
                        return $this->$sendMethod($this->MIMEHeader, $this->MIMEBody);
                ***REMOVED***

                    return $this->mailSend($this->MIMEHeader, $this->MIMEBody);
        ***REMOVED***
    ***REMOVED*** catch (Exception $exc) {
            if ($this->Mailer === 'smtp' && $this->SMTPKeepAlive == true) {
                $this->smtp->reset();
        ***REMOVED***
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
        ***REMOVED***
    ***REMOVED***

        return false;
***REMOVED***

    /**
     * Send mail using the $Sendmail program.
     *
     * @see PHPMailer::$Sendmail
     *
     * @param string $header The message headers
     * @param string $body   The message body
     *
     * @throws Exception
     *
     * @return bool
     */
    protected function sendmailSend($header, $body)
***REMOVED***
        if ($this->Mailer === 'qmail') {
            $this->edebug('Sending with qmail');
    ***REMOVED*** else {
            $this->edebug('Sending with sendmail');
    ***REMOVED***
        $header = static::stripTrailingWSP($header) . static::$LE . static::$LE;
        //This sets the SMTP envelope sender which gets turned into a return-path header by the receiver
        //A space after `-f` is optional, but there is a long history of its presence
        //causing problems, so we don't use one
        //Exim docs: http://www.exim.org/exim-html-current/doc/html/spec_html/ch-the_exim_command_line.html
        //Sendmail docs: http://www.sendmail.org/~ca/email/man/sendmail.html
        //Qmail docs: http://www.qmail.org/man/man8/qmail-inject.html
        //Example problem: https://www.drupal.org/node/1057954

        //PHP 5.6 workaround
        $sendmail_from_value = ini_get('sendmail_from');
        if (empty($this->Sender) && !empty($sendmail_from_value)) {
            //PHP config has a sender address we can use
            $this->Sender = ini_get('sendmail_from');
    ***REMOVED***
        //CVE-2016-10033, CVE-2016-10045: Don't pass -f if characters will be escaped.
        if (!empty($this->Sender) && static::validateAddress($this->Sender) && self::isShellSafe($this->Sender)) {
            if ($this->Mailer === 'qmail') {
                $sendmailFmt = '%s -f%s';
        ***REMOVED*** else {
                $sendmailFmt = '%s -oi -f%s -t';
        ***REMOVED***
    ***REMOVED*** else {
            //allow sendmail to choose a default envelope sender. It may
            //seem preferable to force it to use the From header as with
            //SMTP, but that introduces new problems (see
            //<https://github.com/PHPMailer/PHPMailer/issues/2298>), and
            //it has historically worked this way.
            $sendmailFmt = '%s -oi -t';
    ***REMOVED***

        $sendmail = sprintf($sendmailFmt, escapeshellcmd($this->Sendmail), $this->Sender);
        $this->edebug('Sendmail path: ' . $this->Sendmail);
        $this->edebug('Sendmail command: ' . $sendmail);
        $this->edebug('Envelope sender: ' . $this->Sender);
        $this->edebug("Headers: {$header}");

        if ($this->SingleTo) {
            foreach ($this->SingleToArray as $toAddr) {
                $mail = @popen($sendmail, 'w');
                if (!$mail) {
                    throw new Exception($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
            ***REMOVED***
                $this->edebug("To: {$toAddr}");
                fwrite($mail, 'To: ' . $toAddr . "\n");
                fwrite($mail, $header);
                fwrite($mail, $body);
                $result = pclose($mail);
                $addrinfo = static::parseAddresses($toAddr, true, $this->charSet);
                $this->doCallback(
                    ($result === 0),
                    [[$addrinfo['address'***REMOVED***, $addrinfo['name'***REMOVED******REMOVED******REMOVED***,
                    $this->cc,
                    $this->bcc,
                    $this->Subject,
                    $body,
                    $this->From,
                    [***REMOVED***
                );
                $this->edebug("Result: " . ($result === 0 ? 'true' : 'false'));
                if (0 !== $result) {
                    throw new Exception($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
            ***REMOVED***
        ***REMOVED***
    ***REMOVED*** else {
            $mail = @popen($sendmail, 'w');
            if (!$mail) {
                throw new Exception($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
        ***REMOVED***
            fwrite($mail, $header);
            fwrite($mail, $body);
            $result = pclose($mail);
            $this->doCallback(
                ($result === 0),
                $this->to,
                $this->cc,
                $this->bcc,
                $this->Subject,
                $body,
                $this->From,
                [***REMOVED***
            );
            $this->edebug("Result: " . ($result === 0 ? 'true' : 'false'));
            if (0 !== $result) {
                throw new Exception($this->lang('execute') . $this->Sendmail, self::STOP_CRITICAL);
        ***REMOVED***
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Fix CVE-2016-10033 and CVE-2016-10045 by disallowing potentially unsafe shell characters.
     * Note that escapeshellarg and escapeshellcmd are inadequate for our purposes, especially on Windows.
     *
     * @see https://github.com/PHPMailer/PHPMailer/issues/924 CVE-2016-10045 bug report
     *
     * @param string $string The string to be validated
     *
     * @return bool
     */
    protected static function isShellSafe($string)
***REMOVED***
        //Future-proof
        if (
            escapeshellcmd($string) !== $string
            || !in_array(escapeshellarg($string), ["'$string'", "\"$string\""***REMOVED***)
        ) {
            return false;
    ***REMOVED***

        $length = strlen($string);

        for ($i = 0; $i < $length; ++$i) {
            $c = $string[$i***REMOVED***;

            //All other characters have a special meaning in at least one common shell, including = and +.
            //Full stop (.) has a special meaning in cmd.exe, but its impact should be negligible here.
            //Note that this does permit non-Latin alphanumeric characters based on the current locale.
            if (!ctype_alnum($c) && strpos('@_-.', $c) === false) {
                return false;
        ***REMOVED***
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Check whether a file path is of a permitted type.
     * Used to reject URLs and phar files from functions that access local file paths,
     * such as addAttachment.
     *
     * @param string $path A relative or absolute path to a file
     *
     * @return bool
     */
    protected static function isPermittedPath($path)
***REMOVED***
        //Matches scheme definition from https://tools.ietf.org/html/rfc3986#section-3.1
        return !preg_match('#^[a-z***REMOVED***[a-z\d+.-***REMOVED****://#i', $path);
***REMOVED***

    /**
     * Check whether a file path is safe, accessible, and readable.
     *
     * @param string $path A relative or absolute path to a file
     *
     * @return bool
     */
    protected static function fileIsAccessible($path)
***REMOVED***
        if (!static::isPermittedPath($path)) {
            return false;
    ***REMOVED***
        $readable = file_exists($path);
        //If not a UNC path (expected to start with \\), check read permission, see #2069
        if (strpos($path, '\\\\') !== 0) {
            $readable = $readable && is_readable($path);
    ***REMOVED***
        return  $readable;
***REMOVED***

    /**
     * Send mail using the PHP mail() function.
     *
     * @see http://www.php.net/manual/en/book.mail.php
     *
     * @param string $header The message headers
     * @param string $body   The message body
     *
     * @throws Exception
     *
     * @return bool
     */
    protected function mailSend($header, $body)
***REMOVED***
        $header = static::stripTrailingWSP($header) . static::$LE . static::$LE;

        $toArr = [***REMOVED***;
        foreach ($this->to as $toaddr) {
            $toArr[***REMOVED*** = $this->addrFormat($toaddr);
    ***REMOVED***
        $to = implode(', ', $toArr);

        $params = null;
        //This sets the SMTP envelope sender which gets turned into a return-path header by the receiver
        //A space after `-f` is optional, but there is a long history of its presence
        //causing problems, so we don't use one
        //Exim docs: http://www.exim.org/exim-html-current/doc/html/spec_html/ch-the_exim_command_line.html
        //Sendmail docs: http://www.sendmail.org/~ca/email/man/sendmail.html
        //Qmail docs: http://www.qmail.org/man/man8/qmail-inject.html
        //Example problem: https://www.drupal.org/node/1057954
        //CVE-2016-10033, CVE-2016-10045: Don't pass -f if characters will be escaped.

        //PHP 5.6 workaround
        $sendmail_from_value = ini_get('sendmail_from');
        if (empty($this->Sender) && !empty($sendmail_from_value)) {
            //PHP config has a sender address we can use
            $this->Sender = ini_get('sendmail_from');
    ***REMOVED***
        if (!empty($this->Sender) && static::validateAddress($this->Sender)) {
            if (self::isShellSafe($this->Sender)) {
                $params = sprintf('-f%s', $this->Sender);
        ***REMOVED***
            $old_from = ini_get('sendmail_from');
            ini_set('sendmail_from', $this->Sender);
    ***REMOVED***
        $result = false;
        if ($this->SingleTo && count($toArr) > 1) {
            foreach ($toArr as $toAddr) {
                $result = $this->mailPassthru($toAddr, $this->Subject, $body, $header, $params);
                $addrinfo = static::parseAddresses($toAddr, true, $this->charSet);
                $this->doCallback(
                    $result,
                    [[$addrinfo['address'***REMOVED***, $addrinfo['name'***REMOVED******REMOVED******REMOVED***,
                    $this->cc,
                    $this->bcc,
                    $this->Subject,
                    $body,
                    $this->From,
                    [***REMOVED***
                );
        ***REMOVED***
    ***REMOVED*** else {
            $result = $this->mailPassthru($to, $this->Subject, $body, $header, $params);
            $this->doCallback($result, $this->to, $this->cc, $this->bcc, $this->Subject, $body, $this->From, [***REMOVED***);
    ***REMOVED***
        if (isset($old_from)) {
            ini_set('sendmail_from', $old_from);
    ***REMOVED***
        if (!$result) {
            throw new Exception($this->lang('instantiate'), self::STOP_CRITICAL);
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Get an instance to use for SMTP operations.
     * Override this function to load your own SMTP implementation,
     * or set one with setSMTPInstance.
     *
     * @return SMTP
     */
    public function getSMTPInstance()
***REMOVED***
        if (!is_object($this->smtp)) {
            $this->smtp = new SMTP();
    ***REMOVED***

        return $this->smtp;
***REMOVED***

    /**
     * Provide an instance to use for SMTP operations.
     *
     * @return SMTP
     */
    public function setSMTPInstance(SMTP $smtp)
***REMOVED***
        $this->smtp = $smtp;

        return $this->smtp;
***REMOVED***

    /**
     * Send mail via SMTP.
     * Returns false if there is a bad MAIL FROM, RCPT, or DATA input.
     *
     * @see PHPMailer::setSMTPInstance() to use a different class.
     *
     * @uses \PHPMailer\PHPMailer\SMTP
     *
     * @param string $header The message headers
     * @param string $body   The message body
     *
     * @throws Exception
     *
     * @return bool
     */
    protected function smtpSend($header, $body)
***REMOVED***
        $header = static::stripTrailingWSP($header) . static::$LE . static::$LE;
        $bad_rcpt = [***REMOVED***;
        if (!$this->smtpConnect($this->SMTPOptions)) {
            throw new Exception($this->lang('smtp_connect_failed'), self::STOP_CRITICAL);
    ***REMOVED***
        //Sender already validated in preSend()
        if ('' === $this->Sender) {
            $smtp_from = $this->From;
    ***REMOVED*** else {
            $smtp_from = $this->Sender;
    ***REMOVED***
        if (!$this->smtp->mail($smtp_from)) {
            $this->setError($this->lang('from_failed') . $smtp_from . ' : ' . implode(',', $this->smtp->getError()));
            throw new Exception($this->ErrorInfo, self::STOP_CRITICAL);
    ***REMOVED***

        $callbacks = [***REMOVED***;
        //Attempt to send to all recipients
        foreach ([$this->to, $this->cc, $this->bcc***REMOVED*** as $togroup) {
            foreach ($togroup as $to) {
                if (!$this->smtp->recipient($to[0***REMOVED***, $this->dsn)) {
                    $error = $this->smtp->getError();
                    $bad_rcpt[***REMOVED*** = ['to' => $to[0***REMOVED***, 'error' => $error['detail'***REMOVED******REMOVED***;
                    $isSent = false;
            ***REMOVED*** else {
                    $isSent = true;
            ***REMOVED***

                $callbacks[***REMOVED*** = ['issent' => $isSent, 'to' => $to[0***REMOVED***, 'name' => $to[1***REMOVED******REMOVED***;
        ***REMOVED***
    ***REMOVED***

        //Only send the DATA command if we have viable recipients
        if ((count($this->all_recipients) > count($bad_rcpt)) && !$this->smtp->data($header . $body)) {
            throw new Exception($this->lang('data_not_accepted'), self::STOP_CRITICAL);
    ***REMOVED***

        $smtp_transaction_id = $this->smtp->getLastTransactionID();

        if ($this->SMTPKeepAlive) {
            $this->smtp->reset();
    ***REMOVED*** else {
            $this->smtp->quit();
            $this->smtp->close();
    ***REMOVED***

        foreach ($callbacks as $cb) {
            $this->doCallback(
                $cb['issent'***REMOVED***,
                [[$cb['to'***REMOVED***, $cb['name'***REMOVED******REMOVED******REMOVED***,
                [***REMOVED***,
                [***REMOVED***,
                $this->Subject,
                $body,
                $this->From,
                ['smtp_transaction_id' => $smtp_transaction_id***REMOVED***
            );
    ***REMOVED***

        //Create error message for any bad addresses
        if (count($bad_rcpt) > 0) {
            $errstr = '';
            foreach ($bad_rcpt as $bad) {
                $errstr .= $bad['to'***REMOVED*** . ': ' . $bad['error'***REMOVED***;
        ***REMOVED***
            throw new Exception($this->lang('recipients_failed') . $errstr, self::STOP_CONTINUE);
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Initiate a connection to an SMTP server.
     * Returns false if the operation failed.
     *
     * @param array $options An array of options compatible with stream_context_create()
     *
     * @throws Exception
     *
     * @uses \PHPMailer\PHPMailer\SMTP
     *
     * @return bool
     */
    public function smtpConnect($options = null)
***REMOVED***
        if (null === $this->smtp) {
            $this->smtp = $this->getSMTPInstance();
    ***REMOVED***

        //If no options are provided, use whatever is set in the instance
        if (null === $options) {
            $options = $this->SMTPOptions;
    ***REMOVED***

        //Already connected?
        if ($this->smtp->connected()) {
            return true;
    ***REMOVED***

        $this->smtp->setTimeout($this->Timeout);
        $this->smtp->setDebugLevel($this->SMTPDebug);
        $this->smtp->setDebugOutput($this->Debugoutput);
        $this->smtp->setVerp($this->do_verp);
        $hosts = explode(';', $this->Host);
        $lastexception = null;

        foreach ($hosts as $hostentry) {
            $hostinfo = [***REMOVED***;
            if (
                !preg_match(
                    '/^(?:(ssl|tls):\/\/)?(.+?)(?::(\d+))?$/',
                    trim($hostentry),
                    $hostinfo
                )
            ) {
                $this->edebug($this->lang('invalid_hostentry') . ' ' . trim($hostentry));
                //Not a valid host entry
                continue;
        ***REMOVED***
            //$hostinfo[1***REMOVED***: optional ssl or tls prefix
            //$hostinfo[2***REMOVED***: the hostname
            //$hostinfo[3***REMOVED***: optional port number
            //The host string prefix can temporarily override the current setting for SMTPSecure
            //If it's not specified, the default value is used

            //Check the host name is a valid name or IP address before trying to use it
            if (!static::isValidHost($hostinfo[2***REMOVED***)) {
                $this->edebug($this->lang('invalid_host') . ' ' . $hostinfo[2***REMOVED***);
                continue;
        ***REMOVED***
            $prefix = '';
            $secure = $this->SMTPSecure;
            $tls = (static::ENCRYPTION_STARTTLS === $this->SMTPSecure);
            if ('ssl' === $hostinfo[1***REMOVED*** || ('' === $hostinfo[1***REMOVED*** && static::ENCRYPTION_SMTPS === $this->SMTPSecure)) {
                $prefix = 'ssl://';
                $tls = false; //Can't have SSL and TLS at the same time
                $secure = static::ENCRYPTION_SMTPS;
        ***REMOVED*** elseif ('tls' === $hostinfo[1***REMOVED***) {
                $tls = true;
                //TLS doesn't use a prefix
                $secure = static::ENCRYPTION_STARTTLS;
        ***REMOVED***
            //Do we need the OpenSSL extension?
            $sslext = defined('OPENSSL_ALGO_SHA256');
            if (static::ENCRYPTION_STARTTLS === $secure || static::ENCRYPTION_SMTPS === $secure) {
                //Check for an OpenSSL constant rather than using extension_loaded, which is sometimes disabled
                if (!$sslext) {
                    throw new Exception($this->lang('extension_missing') . 'openssl', self::STOP_CRITICAL);
            ***REMOVED***
        ***REMOVED***
            $host = $hostinfo[2***REMOVED***;
            $port = $this->Port;
            if (
                array_key_exists(3, $hostinfo) &&
                is_numeric($hostinfo[3***REMOVED***) &&
                $hostinfo[3***REMOVED*** > 0 &&
                $hostinfo[3***REMOVED*** < 65536
            ) {
                $port = (int) $hostinfo[3***REMOVED***;
        ***REMOVED***
            if ($this->smtp->connect($prefix . $host, $port, $this->Timeout, $options)) {
                try {
                    if ($this->Helo) {
                        $hello = $this->Helo;
                ***REMOVED*** else {
                        $hello = $this->serverHostname();
                ***REMOVED***
                    $this->smtp->hello($hello);
                    //Automatically enable TLS encryption if:
                    //* it's not disabled
                    //* we have openssl extension
                    //* we are not already using SSL
                    //* the server offers STARTTLS
                    if ($this->SMTPAutoTLS && $sslext && 'ssl' !== $secure && $this->smtp->getServerExt('STARTTLS')) {
                        $tls = true;
                ***REMOVED***
                    if ($tls) {
                        if (!$this->smtp->startTLS()) {
                            throw new Exception($this->lang('connect_host'));
                    ***REMOVED***
                        //We must resend EHLO after TLS negotiation
                        $this->smtp->hello($hello);
                ***REMOVED***
                    if (
                        $this->SMTPAuth && !$this->smtp->authenticate(
                            $this->Username,
                            $this->Password,
                            $this->AuthType,
                            $this->oauth
                        )
                    ) {
                        throw new Exception($this->lang('authenticate'));
                ***REMOVED***

                    return true;
            ***REMOVED*** catch (Exception $exc) {
                    $lastexception = $exc;
                    $this->edebug($exc->getMessage());
                    //We must have connected, but then failed TLS or Auth, so close connection nicely
                    $this->smtp->quit();
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***
        //If we get here, all connection attempts have failed, so close connection hard
        $this->smtp->close();
        //As we've caught all exceptions, just report whatever the last one was
        if ($this->exceptions && null !== $lastexception) {
            throw $lastexception;
    ***REMOVED***

        return false;
***REMOVED***

    /**
     * Close the active SMTP session if one exists.
     */
    public function smtpClose()
***REMOVED***
        if ((null !== $this->smtp) && $this->smtp->connected()) {
            $this->smtp->quit();
            $this->smtp->close();
    ***REMOVED***
***REMOVED***

    /**
     * Set the language for error messages.
     * The default language is English.
     *
     * @param string $langcode  ISO 639-1 2-character language code (e.g. French is "fr")
     *                          Optionally, the language code can be enhanced with a 4-character
     *                          script annotation and/or a 2-character country annotation.
     * @param string $lang_path Path to the language file directory, with trailing separator (slash)
     *                          Do not set this from user input!
     *
     * @return bool Returns true if the requested language was loaded, false otherwise.
     */
    public function setLanguage($langcode = 'en', $lang_path = '')
***REMOVED***
        //Backwards compatibility for renamed language codes
        $renamed_langcodes = [
            'br' => 'pt_br',
            'cz' => 'cs',
            'dk' => 'da',
            'no' => 'nb',
            'se' => 'sv',
            'rs' => 'sr',
            'tg' => 'tl',
            'am' => 'hy',
        ***REMOVED***;

        if (array_key_exists($langcode, $renamed_langcodes)) {
            $langcode = $renamed_langcodes[$langcode***REMOVED***;
    ***REMOVED***

        //Define full set of translatable strings in English
        $PHPMAILER_LANG = [
            'authenticate' => 'SMTP Error: Could not authenticate.',
            'buggy_php' => 'Your version of PHP is affected by a bug that may result in corrupted messages.' .
                ' To fix it, switch to sending using SMTP, disable the mail.add_x_header option in' .
                ' your php.ini, switch to MacOS or Linux, or upgrade your PHP to version 7.0.17+ or 7.1.3+.',
            'connect_host' => 'SMTP Error: Could not connect to SMTP host.',
            'data_not_accepted' => 'SMTP Error: data not accepted.',
            'empty_message' => 'Message body empty',
            'encoding' => 'Unknown encoding: ',
            'execute' => 'Could not execute: ',
            'extension_missing' => 'Extension missing: ',
            'file_access' => 'Could not access file: ',
            'file_open' => 'File Error: Could not open file: ',
            'from_failed' => 'The following From address failed: ',
            'instantiate' => 'Could not instantiate mail function.',
            'invalid_address' => 'Invalid address: ',
            'invalid_header' => 'Invalid header name or value',
            'invalid_hostentry' => 'Invalid hostentry: ',
            'invalid_host' => 'Invalid host: ',
            'mailer_not_supported' => ' mailer is not supported.',
            'provide_address' => 'You must provide at least one recipient email address.',
            'recipients_failed' => 'SMTP Error: The following recipients failed: ',
            'signing' => 'Signing Error: ',
            'smtp_code' => 'SMTP code: ',
            'smtp_code_ex' => 'Additional SMTP info: ',
            'smtp_connect_failed' => 'SMTP connect() failed.',
            'smtp_detail' => 'Detail: ',
            'smtp_error' => 'SMTP server error: ',
            'variable_set' => 'Cannot set or reset variable: ',
        ***REMOVED***;
        if (empty($lang_path)) {
            //Calculate an absolute path so it can work if CWD is not here
            $lang_path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'language' . DIRECTORY_SEPARATOR;
    ***REMOVED***

        //Validate $langcode
        $foundlang = true;
        $langcode  = strtolower($langcode);
        if (
            !preg_match('/^(?P<lang>[a-z***REMOVED***{2})(?P<script>_[a-z***REMOVED***{4})?(?P<country>_[a-z***REMOVED***{2})?$/', $langcode, $matches)
            && $langcode !== 'en'
        ) {
            $foundlang = false;
            $langcode = 'en';
    ***REMOVED***

        //There is no English translation file
        if ('en' !== $langcode) {
            $langcodes = [***REMOVED***;
            if (!empty($matches['script'***REMOVED***) && !empty($matches['country'***REMOVED***)) {
                $langcodes[***REMOVED*** = $matches['lang'***REMOVED*** . $matches['script'***REMOVED*** . $matches['country'***REMOVED***;
        ***REMOVED***
            if (!empty($matches['country'***REMOVED***)) {
                $langcodes[***REMOVED*** = $matches['lang'***REMOVED*** . $matches['country'***REMOVED***;
        ***REMOVED***
            if (!empty($matches['script'***REMOVED***)) {
                $langcodes[***REMOVED*** = $matches['lang'***REMOVED*** . $matches['script'***REMOVED***;
        ***REMOVED***
            $langcodes[***REMOVED*** = $matches['lang'***REMOVED***;

            //Try and find a readable language file for the requested language.
            $foundFile = false;
            foreach ($langcodes as $code) {
                $lang_file = $lang_path . 'phpmailer.lang-' . $code . '.php';
                if (static::fileIsAccessible($lang_file)) {
                    $foundFile = true;
                    break;
            ***REMOVED***
        ***REMOVED***

            if ($foundFile === false) {
                $foundlang = false;
        ***REMOVED*** else {
                $lines = file($lang_file);
                foreach ($lines as $line) {
                    //Translation file lines look like this:
                    //$PHPMAILER_LANG['authenticate'***REMOVED*** = 'SMTP-Fehler: Authentifizierung fehlgeschlagen.';
                    //These files are parsed as text and not PHP so as to avoid the possibility of code injection
                    //See https://blog.stevenlevithan.com/archives/match-quoted-string
                    $matches = [***REMOVED***;
                    if (
                        preg_match(
                            '/^\$PHPMAILER_LANG\[\'([a-z\d_***REMOVED***+)\'\***REMOVED***\s*=\s*(["\'***REMOVED***)(.+)*?\2;/',
                            $line,
                            $matches
                        ) &&
                        //Ignore unknown translation keys
                        array_key_exists($matches[1***REMOVED***, $PHPMAILER_LANG)
                    ) {
                        //Overwrite language-specific strings so we'll never have missing translation keys.
                        $PHPMAILER_LANG[$matches[1***REMOVED******REMOVED*** = (string)$matches[3***REMOVED***;
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***
        $this->language = $PHPMAILER_LANG;

        return $foundlang; //Returns false if language not found
***REMOVED***

    /**
     * Get the array of strings for the current language.
     *
     * @return array
     */
    public function getTranslations()
***REMOVED***
        if (empty($this->language)) {
            $this->setLanguage(); // Set the default language.
    ***REMOVED***

        return $this->language;
***REMOVED***

    /**
     * Create recipient headers.
     *
     * @param string $type
     * @param array  $addr An array of recipients,
     *                     where each recipient is a 2-element indexed array with element 0 containing an address
     *                     and element 1 containing a name, like:
     *                     [['joe@example.com', 'Joe User'***REMOVED***, ['zoe@example.com', 'Zoe User'***REMOVED******REMOVED***
     *
     * @return string
     */
    public function addrAppend($type, $addr)
***REMOVED***
        $addresses = [***REMOVED***;
        foreach ($addr as $address) {
            $addresses[***REMOVED*** = $this->addrFormat($address);
    ***REMOVED***

        return $type . ': ' . implode(', ', $addresses) . static::$LE;
***REMOVED***

    /**
     * Format an address for use in a message header.
     *
     * @param array $addr A 2-element indexed array, element 0 containing an address, element 1 containing a name like
     *                    ['joe@example.com', 'Joe User'***REMOVED***
     *
     * @return string
     */
    public function addrFormat($addr)
***REMOVED***
        if (empty($addr[1***REMOVED***)) { //No name provided
            return $this->secureHeader($addr[0***REMOVED***);
    ***REMOVED***

        return $this->encodeHeader($this->secureHeader($addr[1***REMOVED***), 'phrase') .
            ' <' . $this->secureHeader($addr[0***REMOVED***) . '>';
***REMOVED***

    /**
     * Word-wrap message.
     * For use with mailers that do not automatically perform wrapping
     * and for quoted-printable encoded messages.
     * Original written by philippe.
     *
     * @param string $message The message to wrap
     * @param int    $length  The line length to wrap to
     * @param bool   $qp_mode Whether to run in Quoted-Printable mode
     *
     * @return string
     */
    public function wrapText($message, $length, $qp_mode = false)
***REMOVED***
        if ($qp_mode) {
            $soft_break = sprintf(' =%s', static::$LE);
    ***REMOVED*** else {
            $soft_break = static::$LE;
    ***REMOVED***
        //If utf-8 encoding is used, we will need to make sure we don't
        //split multibyte characters when we wrap
        $is_utf8 = static::CHARSET_UTF8 === strtolower($this->CharSet);
        $lelen = strlen(static::$LE);
        $crlflen = strlen(static::$LE);

        $message = static::normalizeBreaks($message);
        //Remove a trailing line break
        if (substr($message, -$lelen) === static::$LE) {
            $message = substr($message, 0, -$lelen);
    ***REMOVED***

        //Split message into lines
        $lines = explode(static::$LE, $message);
        //Message will be rebuilt in here
        $message = '';
        foreach ($lines as $line) {
            $words = explode(' ', $line);
            $buf = '';
            $firstword = true;
            foreach ($words as $word) {
                if ($qp_mode && (strlen($word) > $length)) {
                    $space_left = $length - strlen($buf) - $crlflen;
                    if (!$firstword) {
                        if ($space_left > 20) {
                            $len = $space_left;
                            if ($is_utf8) {
                                $len = $this->utf8CharBoundary($word, $len);
                        ***REMOVED*** elseif ('=' === substr($word, $len - 1, 1)) {
                                --$len;
                        ***REMOVED*** elseif ('=' === substr($word, $len - 2, 1)) {
                                $len -= 2;
                        ***REMOVED***
                            $part = substr($word, 0, $len);
                            $word = substr($word, $len);
                            $buf .= ' ' . $part;
                            $message .= $buf . sprintf('=%s', static::$LE);
                    ***REMOVED*** else {
                            $message .= $buf . $soft_break;
                    ***REMOVED***
                        $buf = '';
                ***REMOVED***
                    while ($word !== '') {
                        if ($length <= 0) {
                            break;
                    ***REMOVED***
                        $len = $length;
                        if ($is_utf8) {
                            $len = $this->utf8CharBoundary($word, $len);
                    ***REMOVED*** elseif ('=' === substr($word, $len - 1, 1)) {
                            --$len;
                    ***REMOVED*** elseif ('=' === substr($word, $len - 2, 1)) {
                            $len -= 2;
                    ***REMOVED***
                        $part = substr($word, 0, $len);
                        $word = (string) substr($word, $len);

                        if ($word !== '') {
                            $message .= $part . sprintf('=%s', static::$LE);
                    ***REMOVED*** else {
                            $buf = $part;
                    ***REMOVED***
                ***REMOVED***
            ***REMOVED*** else {
                    $buf_o = $buf;
                    if (!$firstword) {
                        $buf .= ' ';
                ***REMOVED***
                    $buf .= $word;

                    if ('' !== $buf_o && strlen($buf) > $length) {
                        $message .= $buf_o . $soft_break;
                        $buf = $word;
                ***REMOVED***
            ***REMOVED***
                $firstword = false;
        ***REMOVED***
            $message .= $buf . static::$LE;
    ***REMOVED***

        return $message;
***REMOVED***

    /**
     * Find the last character boundary prior to $maxLength in a utf-8
     * quoted-printable encoded string.
     * Original written by Colin Brown.
     *
     * @param string $encodedText utf-8 QP text
     * @param int    $maxLength   Find the last character boundary prior to this length
     *
     * @return int
     */
    public function utf8CharBoundary($encodedText, $maxLength)
***REMOVED***
        $foundSplitPos = false;
        $lookBack = 3;
        while (!$foundSplitPos) {
            $lastChunk = substr($encodedText, $maxLength - $lookBack, $lookBack);
            $encodedCharPos = strpos($lastChunk, '=');
            if (false !== $encodedCharPos) {
                //Found start of encoded character byte within $lookBack block.
                //Check the encoded byte value (the 2 chars after the '=')
                $hex = substr($encodedText, $maxLength - $lookBack + $encodedCharPos + 1, 2);
                $dec = hexdec($hex);
                if ($dec < 128) {
                    //Single byte character.
                    //If the encoded char was found at pos 0, it will fit
                    //otherwise reduce maxLength to start of the encoded char
                    if ($encodedCharPos > 0) {
                        $maxLength -= $lookBack - $encodedCharPos;
                ***REMOVED***
                    $foundSplitPos = true;
            ***REMOVED*** elseif ($dec >= 192) {
                    //First byte of a multi byte character
                    //Reduce maxLength to split at start of character
                    $maxLength -= $lookBack - $encodedCharPos;
                    $foundSplitPos = true;
            ***REMOVED*** elseif ($dec < 192) {
                    //Middle byte of a multi byte character, look further back
                    $lookBack += 3;
            ***REMOVED***
        ***REMOVED*** else {
                //No encoded character found
                $foundSplitPos = true;
        ***REMOVED***
    ***REMOVED***

        return $maxLength;
***REMOVED***

    /**
     * Apply word wrapping to the message body.
     * Wraps the message body to the number of chars set in the WordWrap property.
     * You should only do this to plain-text bodies as wrapping HTML tags may break them.
     * This is called automatically by createBody(), so you don't need to call it yourself.
     */
    public function setWordWrap()
***REMOVED***
        if ($this->WordWrap < 1) {
            return;
    ***REMOVED***

        switch ($this->message_type) {
            case 'alt':
            case 'alt_inline':
            case 'alt_attach':
            case 'alt_inline_attach':
                $this->AltBody = $this->wrapText($this->AltBody, $this->WordWrap);
                break;
            default:
                $this->Body = $this->wrapText($this->Body, $this->WordWrap);
                break;
    ***REMOVED***
***REMOVED***

    /**
     * Assemble message headers.
     *
     * @return string The assembled headers
     */
    public function createHeader()
***REMOVED***
        $result = '';

        $result .= $this->headerLine('Date', '' === $this->MessageDate ? self::rfcDate() : $this->MessageDate);

        //The To header is created automatically by mail(), so needs to be omitted here
        if ('mail' !== $this->Mailer) {
            if ($this->SingleTo) {
                foreach ($this->to as $toaddr) {
                    $this->SingleToArray[***REMOVED*** = $this->addrFormat($toaddr);
            ***REMOVED***
        ***REMOVED*** elseif (count($this->to) > 0) {
                $result .= $this->addrAppend('To', $this->to);
        ***REMOVED*** elseif (count($this->cc) === 0) {
                $result .= $this->headerLine('To', 'undisclosed-recipients:;');
        ***REMOVED***
    ***REMOVED***
        $result .= $this->addrAppend('From', [[trim($this->From), $this->FromName***REMOVED******REMOVED***);

        //sendmail and mail() extract Cc from the header before sending
        if (count($this->cc) > 0) {
            $result .= $this->addrAppend('Cc', $this->cc);
    ***REMOVED***

        //sendmail and mail() extract Bcc from the header before sending
        if (
            (
                'sendmail' === $this->Mailer || 'qmail' === $this->Mailer || 'mail' === $this->Mailer
            )
            && count($this->bcc) > 0
        ) {
            $result .= $this->addrAppend('Bcc', $this->bcc);
    ***REMOVED***

        if (count($this->ReplyTo) > 0) {
            $result .= $this->addrAppend('Reply-To', $this->ReplyTo);
    ***REMOVED***

        //mail() sets the subject itself
        if ('mail' !== $this->Mailer) {
            $result .= $this->headerLine('Subject', $this->encodeHeader($this->secureHeader($this->Subject)));
    ***REMOVED***

        //Only allow a custom message ID if it conforms to RFC 5322 section 3.6.4
        //https://tools.ietf.org/html/rfc5322#section-3.6.4
        if (
            '' !== $this->MessageID &&
            preg_match(
                '/^<((([a-z\d!#$%&\'*+\/=?^_`{|}~-***REMOVED***+(\.[a-z\d!#$%&\'*+\/=?^_`{|}~-***REMOVED***+)*)' .
                '|("(([\x01-\x08\x0B\x0C\x0E-\x1F\x7F***REMOVED***|[\x21\x23-\x5B\x5D-\x7E***REMOVED***)' .
                '|(\\[\x01-\x09\x0B\x0C\x0E-\x7F***REMOVED***))*"))@(([a-z\d!#$%&\'*+\/=?^_`{|}~-***REMOVED***+' .
                '(\.[a-z\d!#$%&\'*+\/=?^_`{|}~-***REMOVED***+)*)|(\[(([\x01-\x08\x0B\x0C\x0E-\x1F\x7F***REMOVED***' .
                '|[\x21-\x5A\x5E-\x7E***REMOVED***)|(\\[\x01-\x09\x0B\x0C\x0E-\x7F***REMOVED***))*\***REMOVED***)))>$/Di',
                $this->MessageID
            )
        ) {
            $this->lastMessageID = $this->MessageID;
    ***REMOVED*** else {
            $this->lastMessageID = sprintf('<%s@%s>', $this->uniqueid, $this->serverHostname());
    ***REMOVED***
        $result .= $this->headerLine('Message-ID', $this->lastMessageID);
        if (null !== $this->Priority) {
            $result .= $this->headerLine('X-Priority', $this->Priority);
    ***REMOVED***
        if ('' === $this->XMailer) {
            $result .= $this->headerLine(
                'X-Mailer',
                'PHPMailer ' . self::VERSION . ' (https://github.com/PHPMailer/PHPMailer)'
            );
    ***REMOVED*** else {
            $myXmailer = trim($this->XMailer);
            if ($myXmailer) {
                $result .= $this->headerLine('X-Mailer', $myXmailer);
        ***REMOVED***
    ***REMOVED***

        if ('' !== $this->ConfirmReadingTo) {
            $result .= $this->headerLine('Disposition-Notification-To', '<' . $this->ConfirmReadingTo . '>');
    ***REMOVED***

        //Add custom headers
        foreach ($this->CustomHeader as $header) {
            $result .= $this->headerLine(
                trim($header[0***REMOVED***),
                $this->encodeHeader(trim($header[1***REMOVED***))
            );
    ***REMOVED***
        if (!$this->sign_key_file) {
            $result .= $this->headerLine('MIME-Version', '1.0');
            $result .= $this->getMailMIME();
    ***REMOVED***

        return $result;
***REMOVED***

    /**
     * Get the message MIME type headers.
     *
     * @return string
     */
    public function getMailMIME()
***REMOVED***
        $result = '';
        $ismultipart = true;
        switch ($this->message_type) {
            case 'inline':
                $result .= $this->headerLine('Content-Type', static::CONTENT_TYPE_MULTIPART_RELATED . ';');
                $result .= $this->textLine(' boundary="' . $this->boundary[1***REMOVED*** . '"');
                break;
            case 'attach':
            case 'inline_attach':
            case 'alt_attach':
            case 'alt_inline_attach':
                $result .= $this->headerLine('Content-Type', static::CONTENT_TYPE_MULTIPART_MIXED . ';');
                $result .= $this->textLine(' boundary="' . $this->boundary[1***REMOVED*** . '"');
                break;
            case 'alt':
            case 'alt_inline':
                $result .= $this->headerLine('Content-Type', static::CONTENT_TYPE_MULTIPART_ALTERNATIVE . ';');
                $result .= $this->textLine(' boundary="' . $this->boundary[1***REMOVED*** . '"');
                break;
            default:
                //Catches case 'plain': and case '':
                $result .= $this->textLine('Content-Type: ' . $this->ContentType . '; charset=' . $this->CharSet);
                $ismultipart = false;
                break;
    ***REMOVED***
        //RFC1341 part 5 says 7bit is assumed if not specified
        if (static::ENCODING_7BIT !== $this->Encoding) {
            //RFC 2045 section 6.4 says multipart MIME parts may only use 7bit, 8bit or binary CTE
            if ($ismultipart) {
                if (static::ENCODING_8BIT === $this->Encoding) {
                    $result .= $this->headerLine('Content-Transfer-Encoding', static::ENCODING_8BIT);
            ***REMOVED***
                //The only remaining alternatives are quoted-printable and base64, which are both 7bit compatible
        ***REMOVED*** else {
                $result .= $this->headerLine('Content-Transfer-Encoding', $this->Encoding);
        ***REMOVED***
    ***REMOVED***

        return $result;
***REMOVED***

    /**
     * Returns the whole MIME message.
     * Includes complete headers and body.
     * Only valid post preSend().
     *
     * @see PHPMailer::preSend()
     *
     * @return string
     */
    public function getSentMIMEMessage()
***REMOVED***
        return static::stripTrailingWSP($this->MIMEHeader . $this->mailHeader) .
            static::$LE . static::$LE . $this->MIMEBody;
***REMOVED***

    /**
     * Create a unique ID to use for boundaries.
     *
     * @return string
     */
    protected function generateId()
***REMOVED***
        $len = 32; //32 bytes = 256 bits
        $bytes = '';
        if (function_exists('random_bytes')) {
            try {
                $bytes = random_bytes($len);
        ***REMOVED*** catch (\Exception $e) {
                //Do nothing
        ***REMOVED***
    ***REMOVED*** elseif (function_exists('openssl_random_pseudo_bytes')) {
            /** @noinspection CryptographicallySecureRandomnessInspection */
            $bytes = openssl_random_pseudo_bytes($len);
    ***REMOVED***
        if ($bytes === '') {
            //We failed to produce a proper random string, so make do.
            //Use a hash to force the length to the same as the other methods
            $bytes = hash('sha256', uniqid((string) mt_rand(), true), true);
    ***REMOVED***

        //We don't care about messing up base64 format here, just want a random string
        return str_replace(['=', '+', '/'***REMOVED***, '', base64_encode(hash('sha256', $bytes, true)));
***REMOVED***

    /**
     * Assemble the message body.
     * Returns an empty string on failure.
     *
     * @throws Exception
     *
     * @return string The assembled message body
     */
    public function createBody()
***REMOVED***
        $body = '';
        //Create unique IDs and preset boundaries
        $this->uniqueid = $this->generateId();
        $this->boundary[1***REMOVED*** = 'b1_' . $this->uniqueid;
        $this->boundary[2***REMOVED*** = 'b2_' . $this->uniqueid;
        $this->boundary[3***REMOVED*** = 'b3_' . $this->uniqueid;

        if ($this->sign_key_file) {
            $body .= $this->getMailMIME() . static::$LE;
    ***REMOVED***

        $this->setWordWrap();

        $bodyEncoding = $this->Encoding;
        $bodyCharSet = $this->CharSet;
        //Can we do a 7-bit downgrade?
        if (static::ENCODING_8BIT === $bodyEncoding && !$this->has8bitChars($this->Body)) {
            $bodyEncoding = static::ENCODING_7BIT;
            //All ISO 8859, Windows codepage and UTF-8 charsets are ascii compatible up to 7-bit
            $bodyCharSet = static::CHARSET_ASCII;
    ***REMOVED***
        //If lines are too long, and we're not already using an encoding that will shorten them,
        //change to quoted-printable transfer encoding for the body part only
        if (static::ENCODING_BASE64 !== $this->Encoding && static::hasLineLongerThanMax($this->Body)) {
            $bodyEncoding = static::ENCODING_QUOTED_PRINTABLE;
    ***REMOVED***

        $altBodyEncoding = $this->Encoding;
        $altBodyCharSet = $this->CharSet;
        //Can we do a 7-bit downgrade?
        if (static::ENCODING_8BIT === $altBodyEncoding && !$this->has8bitChars($this->AltBody)) {
            $altBodyEncoding = static::ENCODING_7BIT;
            //All ISO 8859, Windows codepage and UTF-8 charsets are ascii compatible up to 7-bit
            $altBodyCharSet = static::CHARSET_ASCII;
    ***REMOVED***
        //If lines are too long, and we're not already using an encoding that will shorten them,
        //change to quoted-printable transfer encoding for the alt body part only
        if (static::ENCODING_BASE64 !== $altBodyEncoding && static::hasLineLongerThanMax($this->AltBody)) {
            $altBodyEncoding = static::ENCODING_QUOTED_PRINTABLE;
    ***REMOVED***
        //Use this as a preamble in all multipart message types
        $mimepre = 'This is a multi-part message in MIME format.' . static::$LE . static::$LE;
        switch ($this->message_type) {
            case 'inline':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1***REMOVED***, $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= static::$LE;
                $body .= $this->attachAll('inline', $this->boundary[1***REMOVED***);
                break;
            case 'attach':
                $body .= $mimepre;
                $body .= $this->getBoundary($this->boundary[1***REMOVED***, $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= static::$LE;
                $body .= $this->attachAll('attachment', $this->boundary[1***REMOVED***);
                break;
            case 'inline_attach':
                $body .= $mimepre;
                $body .= $this->textLine('--' . $this->boundary[1***REMOVED***);
                $body .= $this->headerLine('Content-Type', static::CONTENT_TYPE_MULTIPART_RELATED . ';');
                $body .= $this->textLine(' boundary="' . $this->boundary[2***REMOVED*** . '";');
                $body .= $this->textLine(' type="' . static::CONTENT_TYPE_TEXT_HTML . '"');
                $body .= static::$LE;
                $body .= $this->getBoundary($this->boundary[2***REMOVED***, $bodyCharSet, '', $bodyEncoding);
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= static::$LE;
                $body .= $this->attachAll('inline', $this->boundary[2***REMOVED***);
                $body .= static::$LE;
                $body .= $this->attachAll('attachment', $this->boundary[1***REMOVED***);
                break;
            case 'alt':
                $body .= $mimepre;
                $body .= $this->getBoundary(
                    $this->boundary[1***REMOVED***,
                    $altBodyCharSet,
                    static::CONTENT_TYPE_PLAINTEXT,
                    $altBodyEncoding
                );
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= static::$LE;
                $body .= $this->getBoundary(
                    $this->boundary[1***REMOVED***,
                    $bodyCharSet,
                    static::CONTENT_TYPE_TEXT_HTML,
                    $bodyEncoding
                );
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= static::$LE;
                if (!empty($this->Ical)) {
                    $method = static::ICAL_METHOD_REQUEST;
                    foreach (static::$IcalMethods as $imethod) {
                        if (stripos($this->Ical, 'METHOD:' . $imethod) !== false) {
                            $method = $imethod;
                            break;
                    ***REMOVED***
                ***REMOVED***
                    $body .= $this->getBoundary(
                        $this->boundary[1***REMOVED***,
                        '',
                        static::CONTENT_TYPE_TEXT_CALENDAR . '; method=' . $method,
                        ''
                    );
                    $body .= $this->encodeString($this->Ical, $this->Encoding);
                    $body .= static::$LE;
            ***REMOVED***
                $body .= $this->endBoundary($this->boundary[1***REMOVED***);
                break;
            case 'alt_inline':
                $body .= $mimepre;
                $body .= $this->getBoundary(
                    $this->boundary[1***REMOVED***,
                    $altBodyCharSet,
                    static::CONTENT_TYPE_PLAINTEXT,
                    $altBodyEncoding
                );
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= static::$LE;
                $body .= $this->textLine('--' . $this->boundary[1***REMOVED***);
                $body .= $this->headerLine('Content-Type', static::CONTENT_TYPE_MULTIPART_RELATED . ';');
                $body .= $this->textLine(' boundary="' . $this->boundary[2***REMOVED*** . '";');
                $body .= $this->textLine(' type="' . static::CONTENT_TYPE_TEXT_HTML . '"');
                $body .= static::$LE;
                $body .= $this->getBoundary(
                    $this->boundary[2***REMOVED***,
                    $bodyCharSet,
                    static::CONTENT_TYPE_TEXT_HTML,
                    $bodyEncoding
                );
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= static::$LE;
                $body .= $this->attachAll('inline', $this->boundary[2***REMOVED***);
                $body .= static::$LE;
                $body .= $this->endBoundary($this->boundary[1***REMOVED***);
                break;
            case 'alt_attach':
                $body .= $mimepre;
                $body .= $this->textLine('--' . $this->boundary[1***REMOVED***);
                $body .= $this->headerLine('Content-Type', static::CONTENT_TYPE_MULTIPART_ALTERNATIVE . ';');
                $body .= $this->textLine(' boundary="' . $this->boundary[2***REMOVED*** . '"');
                $body .= static::$LE;
                $body .= $this->getBoundary(
                    $this->boundary[2***REMOVED***,
                    $altBodyCharSet,
                    static::CONTENT_TYPE_PLAINTEXT,
                    $altBodyEncoding
                );
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= static::$LE;
                $body .= $this->getBoundary(
                    $this->boundary[2***REMOVED***,
                    $bodyCharSet,
                    static::CONTENT_TYPE_TEXT_HTML,
                    $bodyEncoding
                );
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= static::$LE;
                if (!empty($this->Ical)) {
                    $method = static::ICAL_METHOD_REQUEST;
                    foreach (static::$IcalMethods as $imethod) {
                        if (stripos($this->Ical, 'METHOD:' . $imethod) !== false) {
                            $method = $imethod;
                            break;
                    ***REMOVED***
                ***REMOVED***
                    $body .= $this->getBoundary(
                        $this->boundary[2***REMOVED***,
                        '',
                        static::CONTENT_TYPE_TEXT_CALENDAR . '; method=' . $method,
                        ''
                    );
                    $body .= $this->encodeString($this->Ical, $this->Encoding);
            ***REMOVED***
                $body .= $this->endBoundary($this->boundary[2***REMOVED***);
                $body .= static::$LE;
                $body .= $this->attachAll('attachment', $this->boundary[1***REMOVED***);
                break;
            case 'alt_inline_attach':
                $body .= $mimepre;
                $body .= $this->textLine('--' . $this->boundary[1***REMOVED***);
                $body .= $this->headerLine('Content-Type', static::CONTENT_TYPE_MULTIPART_ALTERNATIVE . ';');
                $body .= $this->textLine(' boundary="' . $this->boundary[2***REMOVED*** . '"');
                $body .= static::$LE;
                $body .= $this->getBoundary(
                    $this->boundary[2***REMOVED***,
                    $altBodyCharSet,
                    static::CONTENT_TYPE_PLAINTEXT,
                    $altBodyEncoding
                );
                $body .= $this->encodeString($this->AltBody, $altBodyEncoding);
                $body .= static::$LE;
                $body .= $this->textLine('--' . $this->boundary[2***REMOVED***);
                $body .= $this->headerLine('Content-Type', static::CONTENT_TYPE_MULTIPART_RELATED . ';');
                $body .= $this->textLine(' boundary="' . $this->boundary[3***REMOVED*** . '";');
                $body .= $this->textLine(' type="' . static::CONTENT_TYPE_TEXT_HTML . '"');
                $body .= static::$LE;
                $body .= $this->getBoundary(
                    $this->boundary[3***REMOVED***,
                    $bodyCharSet,
                    static::CONTENT_TYPE_TEXT_HTML,
                    $bodyEncoding
                );
                $body .= $this->encodeString($this->Body, $bodyEncoding);
                $body .= static::$LE;
                $body .= $this->attachAll('inline', $this->boundary[3***REMOVED***);
                $body .= static::$LE;
                $body .= $this->endBoundary($this->boundary[2***REMOVED***);
                $body .= static::$LE;
                $body .= $this->attachAll('attachment', $this->boundary[1***REMOVED***);
                break;
            default:
                //Catch case 'plain' and case '', applies to simple `text/plain` and `text/html` body content types
                //Reset the `Encoding` property in case we changed it for line length reasons
                $this->Encoding = $bodyEncoding;
                $body .= $this->encodeString($this->Body, $this->Encoding);
                break;
    ***REMOVED***

        if ($this->isError()) {
            $body = '';
            if ($this->exceptions) {
                throw new Exception($this->lang('empty_message'), self::STOP_CRITICAL);
        ***REMOVED***
    ***REMOVED*** elseif ($this->sign_key_file) {
            try {
                if (!defined('PKCS7_TEXT')) {
                    throw new Exception($this->lang('extension_missing') . 'openssl');
            ***REMOVED***

                $file = tempnam(sys_get_temp_dir(), 'srcsign');
                $signed = tempnam(sys_get_temp_dir(), 'mailsign');
                file_put_contents($file, $body);

                //Workaround for PHP bug https://bugs.php.net/bug.php?id=69197
                if (empty($this->sign_extracerts_file)) {
                    $sign = @openssl_pkcs7_sign(
                        $file,
                        $signed,
                        'file://' . realpath($this->sign_cert_file),
                        ['file://' . realpath($this->sign_key_file), $this->sign_key_pass***REMOVED***,
                        [***REMOVED***
                    );
            ***REMOVED*** else {
                    $sign = @openssl_pkcs7_sign(
                        $file,
                        $signed,
                        'file://' . realpath($this->sign_cert_file),
                        ['file://' . realpath($this->sign_key_file), $this->sign_key_pass***REMOVED***,
                        [***REMOVED***,
                        PKCS7_DETACHED,
                        $this->sign_extracerts_file
                    );
            ***REMOVED***

                @unlink($file);
                if ($sign) {
                    $body = file_get_contents($signed);
                    @unlink($signed);
                    //The message returned by openssl contains both headers and body, so need to split them up
                    $parts = explode("\n\n", $body, 2);
                    $this->MIMEHeader .= $parts[0***REMOVED*** . static::$LE . static::$LE;
                    $body = $parts[1***REMOVED***;
            ***REMOVED*** else {
                    @unlink($signed);
                    throw new Exception($this->lang('signing') . openssl_error_string());
            ***REMOVED***
        ***REMOVED*** catch (Exception $exc) {
                $body = '';
                if ($this->exceptions) {
                    throw $exc;
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***

        return $body;
***REMOVED***

    /**
     * Return the start of a message boundary.
     *
     * @param string $boundary
     * @param string $charSet
     * @param string $contentType
     * @param string $encoding
     *
     * @return string
     */
    protected function getBoundary($boundary, $charSet, $contentType, $encoding)
***REMOVED***
        $result = '';
        if ('' === $charSet) {
            $charSet = $this->CharSet;
    ***REMOVED***
        if ('' === $contentType) {
            $contentType = $this->ContentType;
    ***REMOVED***
        if ('' === $encoding) {
            $encoding = $this->Encoding;
    ***REMOVED***
        $result .= $this->textLine('--' . $boundary);
        $result .= sprintf('Content-Type: %s; charset=%s', $contentType, $charSet);
        $result .= static::$LE;
        //RFC1341 part 5 says 7bit is assumed if not specified
        if (static::ENCODING_7BIT !== $encoding) {
            $result .= $this->headerLine('Content-Transfer-Encoding', $encoding);
    ***REMOVED***
        $result .= static::$LE;

        return $result;
***REMOVED***

    /**
     * Return the end of a message boundary.
     *
     * @param string $boundary
     *
     * @return string
     */
    protected function endBoundary($boundary)
***REMOVED***
        return static::$LE . '--' . $boundary . '--' . static::$LE;
***REMOVED***

    /**
     * Set the message type.
     * PHPMailer only supports some preset message types, not arbitrary MIME structures.
     */
    protected function setMessageType()
***REMOVED***
        $type = [***REMOVED***;
        if ($this->alternativeExists()) {
            $type[***REMOVED*** = 'alt';
    ***REMOVED***
        if ($this->inlineImageExists()) {
            $type[***REMOVED*** = 'inline';
    ***REMOVED***
        if ($this->attachmentExists()) {
            $type[***REMOVED*** = 'attach';
    ***REMOVED***
        $this->message_type = implode('_', $type);
        if ('' === $this->message_type) {
            //The 'plain' message_type refers to the message having a single body element, not that it is plain-text
            $this->message_type = 'plain';
    ***REMOVED***
***REMOVED***

    /**
     * Format a header line.
     *
     * @param string     $name
     * @param string|int $value
     *
     * @return string
     */
    public function headerLine($name, $value)
***REMOVED***
        return $name . ': ' . $value . static::$LE;
***REMOVED***

    /**
     * Return a formatted mail line.
     *
     * @param string $value
     *
     * @return string
     */
    public function textLine($value)
***REMOVED***
        return $value . static::$LE;
***REMOVED***

    /**
     * Add an attachment from a path on the filesystem.
     * Never use a user-supplied path to a file!
     * Returns false if the file could not be found or read.
     * Explicitly *does not* support passing URLs; PHPMailer is not an HTTP client.
     * If you need to do that, fetch the resource yourself and pass it in via a local file or string.
     *
     * @param string $path        Path to the attachment
     * @param string $name        Overrides the attachment name
     * @param string $encoding    File encoding (see $Encoding)
     * @param string $type        MIME type, e.g. `image/jpeg`; determined automatically from $path if not specified
     * @param string $disposition Disposition to use
     *
     * @throws Exception
     *
     * @return bool
     */
    public function addAttachment(
        $path,
        $name = '',
        $encoding = self::ENCODING_BASE64,
        $type = '',
        $disposition = 'attachment'
    ) {
        try {
            if (!static::fileIsAccessible($path)) {
                throw new Exception($this->lang('file_access') . $path, self::STOP_CONTINUE);
        ***REMOVED***

            //If a MIME type is not specified, try to work it out from the file name
            if ('' === $type) {
                $type = static::filenameToType($path);
        ***REMOVED***

            $filename = (string) static::mb_pathinfo($path, PATHINFO_BASENAME);
            if ('' === $name) {
                $name = $filename;
        ***REMOVED***
            if (!$this->validateEncoding($encoding)) {
                throw new Exception($this->lang('encoding') . $encoding);
        ***REMOVED***

            $this->attachment[***REMOVED*** = [
                0 => $path,
                1 => $filename,
                2 => $name,
                3 => $encoding,
                4 => $type,
                5 => false, //isStringAttachment
                6 => $disposition,
                7 => $name,
            ***REMOVED***;
    ***REMOVED*** catch (Exception $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
        ***REMOVED***

            return false;
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Return the array of attachments.
     *
     * @return array
     */
    public function getAttachments()
***REMOVED***
        return $this->attachment;
***REMOVED***

    /**
     * Attach all file, string, and binary attachments to the message.
     * Returns an empty string on failure.
     *
     * @param string $disposition_type
     * @param string $boundary
     *
     * @throws Exception
     *
     * @return string
     */
    protected function attachAll($disposition_type, $boundary)
***REMOVED***
        //Return text of body
        $mime = [***REMOVED***;
        $cidUniq = [***REMOVED***;
        $incl = [***REMOVED***;

        //Add all attachments
        foreach ($this->attachment as $attachment) {
            //Check if it is a valid disposition_filter
            if ($attachment[6***REMOVED*** === $disposition_type) {
                //Check for string attachment
                $string = '';
                $path = '';
                $bString = $attachment[5***REMOVED***;
                if ($bString) {
                    $string = $attachment[0***REMOVED***;
            ***REMOVED*** else {
                    $path = $attachment[0***REMOVED***;
            ***REMOVED***

                $inclhash = hash('sha256', serialize($attachment));
                if (in_array($inclhash, $incl, true)) {
                    continue;
            ***REMOVED***
                $incl[***REMOVED*** = $inclhash;
                $name = $attachment[2***REMOVED***;
                $encoding = $attachment[3***REMOVED***;
                $type = $attachment[4***REMOVED***;
                $disposition = $attachment[6***REMOVED***;
                $cid = $attachment[7***REMOVED***;
                if ('inline' === $disposition && array_key_exists($cid, $cidUniq)) {
                    continue;
            ***REMOVED***
                $cidUniq[$cid***REMOVED*** = true;

                $mime[***REMOVED*** = sprintf('--%s%s', $boundary, static::$LE);
                //Only include a filename property if we have one
                if (!empty($name)) {
                    $mime[***REMOVED*** = sprintf(
                        'Content-Type: %s; name=%s%s',
                        $type,
                        static::quotedString($this->encodeHeader($this->secureHeader($name))),
                        static::$LE
                    );
            ***REMOVED*** else {
                    $mime[***REMOVED*** = sprintf(
                        'Content-Type: %s%s',
                        $type,
                        static::$LE
                    );
            ***REMOVED***
                //RFC1341 part 5 says 7bit is assumed if not specified
                if (static::ENCODING_7BIT !== $encoding) {
                    $mime[***REMOVED*** = sprintf('Content-Transfer-Encoding: %s%s', $encoding, static::$LE);
            ***REMOVED***

                //Only set Content-IDs on inline attachments
                if ((string) $cid !== '' && $disposition === 'inline') {
                    $mime[***REMOVED*** = 'Content-ID: <' . $this->encodeHeader($this->secureHeader($cid)) . '>' . static::$LE;
            ***REMOVED***

                //Allow for bypassing the Content-Disposition header
                if (!empty($disposition)) {
                    $encoded_name = $this->encodeHeader($this->secureHeader($name));
                    if (!empty($encoded_name)) {
                        $mime[***REMOVED*** = sprintf(
                            'Content-Disposition: %s; filename=%s%s',
                            $disposition,
                            static::quotedString($encoded_name),
                            static::$LE . static::$LE
                        );
                ***REMOVED*** else {
                        $mime[***REMOVED*** = sprintf(
                            'Content-Disposition: %s%s',
                            $disposition,
                            static::$LE . static::$LE
                        );
                ***REMOVED***
            ***REMOVED*** else {
                    $mime[***REMOVED*** = static::$LE;
            ***REMOVED***

                //Encode as string attachment
                if ($bString) {
                    $mime[***REMOVED*** = $this->encodeString($string, $encoding);
            ***REMOVED*** else {
                    $mime[***REMOVED*** = $this->encodeFile($path, $encoding);
            ***REMOVED***
                if ($this->isError()) {
                    return '';
            ***REMOVED***
                $mime[***REMOVED*** = static::$LE;
        ***REMOVED***
    ***REMOVED***

        $mime[***REMOVED*** = sprintf('--%s--%s', $boundary, static::$LE);

        return implode('', $mime);
***REMOVED***

    /**
     * Encode a file attachment in requested format.
     * Returns an empty string on failure.
     *
     * @param string $path     The full path to the file
     * @param string $encoding The encoding to use; one of 'base64', '7bit', '8bit', 'binary', 'quoted-printable'
     *
     * @return string
     */
    protected function encodeFile($path, $encoding = self::ENCODING_BASE64)
***REMOVED***
        try {
            if (!static::fileIsAccessible($path)) {
                throw new Exception($this->lang('file_open') . $path, self::STOP_CONTINUE);
        ***REMOVED***
            $file_buffer = file_get_contents($path);
            if (false === $file_buffer) {
                throw new Exception($this->lang('file_open') . $path, self::STOP_CONTINUE);
        ***REMOVED***
            $file_buffer = $this->encodeString($file_buffer, $encoding);

            return $file_buffer;
    ***REMOVED*** catch (Exception $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
        ***REMOVED***

            return '';
    ***REMOVED***
***REMOVED***

    /**
     * Encode a string in requested format.
     * Returns an empty string on failure.
     *
     * @param string $str      The text to encode
     * @param string $encoding The encoding to use; one of 'base64', '7bit', '8bit', 'binary', 'quoted-printable'
     *
     * @throws Exception
     *
     * @return string
     */
    public function encodeString($str, $encoding = self::ENCODING_BASE64)
***REMOVED***
        $encoded = '';
        switch (strtolower($encoding)) {
            case static::ENCODING_BASE64:
                $encoded = chunk_split(
                    base64_encode($str),
                    static::STD_LINE_LENGTH,
                    static::$LE
                );
                break;
            case static::ENCODING_7BIT:
            case static::ENCODING_8BIT:
                $encoded = static::normalizeBreaks($str);
                //Make sure it ends with a line break
                if (substr($encoded, -(strlen(static::$LE))) !== static::$LE) {
                    $encoded .= static::$LE;
            ***REMOVED***
                break;
            case static::ENCODING_BINARY:
                $encoded = $str;
                break;
            case static::ENCODING_QUOTED_PRINTABLE:
                $encoded = $this->encodeQP($str);
                break;
            default:
                $this->setError($this->lang('encoding') . $encoding);
                if ($this->exceptions) {
                    throw new Exception($this->lang('encoding') . $encoding);
            ***REMOVED***
                break;
    ***REMOVED***

        return $encoded;
***REMOVED***

    /**
     * Encode a header value (not including its label) optimally.
     * Picks shortest of Q, B, or none. Result includes folding if needed.
     * See RFC822 definitions for phrase, comment and text positions.
     *
     * @param string $str      The header value to encode
     * @param string $position What context the string will be used in
     *
     * @return string
     */
    public function encodeHeader($str, $position = 'text')
***REMOVED***
        $matchcount = 0;
        switch (strtolower($position)) {
            case 'phrase':
                if (!preg_match('/[\200-\377***REMOVED***/', $str)) {
                    //Can't use addslashes as we don't know the value of magic_quotes_sybase
                    $encoded = addcslashes($str, "\0..\37\177\\\"");
                    if (($str === $encoded) && !preg_match('/[^A-Za-z0-9!#$%&\'*+\/=?^_`{|}~ -***REMOVED***/', $str)) {
                        return $encoded;
                ***REMOVED***

                    return "\"$encoded\"";
            ***REMOVED***
                $matchcount = preg_match_all('/[^\040\041\043-\133\135-\176***REMOVED***/', $str, $matches);
                break;
            /* @noinspection PhpMissingBreakStatementInspection */
            case 'comment':
                $matchcount = preg_match_all('/[()"***REMOVED***/', $str, $matches);
            //fallthrough
            case 'text':
            default:
                $matchcount += preg_match_all('/[\000-\010\013\014\016-\037\177-\377***REMOVED***/', $str, $matches);
                break;
    ***REMOVED***

        if ($this->has8bitChars($str)) {
            $charset = $this->CharSet;
    ***REMOVED*** else {
            $charset = static::CHARSET_ASCII;
    ***REMOVED***

        //Q/B encoding adds 8 chars and the charset ("` =?<charset>?[QB***REMOVED***?<content>?=`").
        $overhead = 8 + strlen($charset);

        if ('mail' === $this->Mailer) {
            $maxlen = static::MAIL_MAX_LINE_LENGTH - $overhead;
    ***REMOVED*** else {
            $maxlen = static::MAX_LINE_LENGTH - $overhead;
    ***REMOVED***

        //Select the encoding that produces the shortest output and/or prevents corruption.
        if ($matchcount > strlen($str) / 3) {
            //More than 1/3 of the content needs encoding, use B-encode.
            $encoding = 'B';
    ***REMOVED*** elseif ($matchcount > 0) {
            //Less than 1/3 of the content needs encoding, use Q-encode.
            $encoding = 'Q';
    ***REMOVED*** elseif (strlen($str) > $maxlen) {
            //No encoding needed, but value exceeds max line length, use Q-encode to prevent corruption.
            $encoding = 'Q';
    ***REMOVED*** else {
            //No reformatting needed
            $encoding = false;
    ***REMOVED***

        switch ($encoding) {
            case 'B':
                if ($this->hasMultiBytes($str)) {
                    //Use a custom function which correctly encodes and wraps long
                    //multibyte strings without breaking lines within a character
                    $encoded = $this->base64EncodeWrapMB($str, "\n");
            ***REMOVED*** else {
                    $encoded = base64_encode($str);
                    $maxlen -= $maxlen % 4;
                    $encoded = trim(chunk_split($encoded, $maxlen, "\n"));
            ***REMOVED***
                $encoded = preg_replace('/^(.*)$/m', ' =?' . $charset . "?$encoding?\\1?=", $encoded);
                break;
            case 'Q':
                $encoded = $this->encodeQ($str, $position);
                $encoded = $this->wrapText($encoded, $maxlen, true);
                $encoded = str_replace('=' . static::$LE, "\n", trim($encoded));
                $encoded = preg_replace('/^(.*)$/m', ' =?' . $charset . "?$encoding?\\1?=", $encoded);
                break;
            default:
                return $str;
    ***REMOVED***

        return trim(static::normalizeBreaks($encoded));
***REMOVED***

    /**
     * Check if a string contains multi-byte characters.
     *
     * @param string $str multi-byte text to wrap encode
     *
     * @return bool
     */
    public function hasMultiBytes($str)
***REMOVED***
        if (function_exists('mb_strlen')) {
            return strlen($str) > mb_strlen($str, $this->CharSet);
    ***REMOVED***

        //Assume no multibytes (we can't handle without mbstring functions anyway)
        return false;
***REMOVED***

    /**
     * Does a string contain any 8-bit chars (in any charset)?
     *
     * @param string $text
     *
     * @return bool
     */
    public function has8bitChars($text)
***REMOVED***
        return (bool) preg_match('/[\x80-\xFF***REMOVED***/', $text);
***REMOVED***

    /**
     * Encode and wrap long multibyte strings for mail headers
     * without breaking lines within a character.
     * Adapted from a function by paravoid.
     *
     * @see http://www.php.net/manual/en/function.mb-encode-mimeheader.php#60283
     *
     * @param string $str       multi-byte text to wrap encode
     * @param string $linebreak string to use as linefeed/end-of-line
     *
     * @return string
     */
    public function base64EncodeWrapMB($str, $linebreak = null)
***REMOVED***
        $start = '=?' . $this->CharSet . '?B?';
        $end = '?=';
        $encoded = '';
        if (null === $linebreak) {
            $linebreak = static::$LE;
    ***REMOVED***

        $mb_length = mb_strlen($str, $this->CharSet);
        //Each line must have length <= 75, including $start and $end
        $length = 75 - strlen($start) - strlen($end);
        //Average multi-byte ratio
        $ratio = $mb_length / strlen($str);
        //Base64 has a 4:3 ratio
        $avgLength = floor($length * $ratio * .75);

        $offset = 0;
        for ($i = 0; $i < $mb_length; $i += $offset) {
            $lookBack = 0;
            do {
                $offset = $avgLength - $lookBack;
                $chunk = mb_substr($str, $i, $offset, $this->CharSet);
                $chunk = base64_encode($chunk);
                ++$lookBack;
        ***REMOVED*** while (strlen($chunk) > $length);
            $encoded .= $chunk . $linebreak;
    ***REMOVED***

        //Chomp the last linefeed
        return substr($encoded, 0, -strlen($linebreak));
***REMOVED***

    /**
     * Encode a string in quoted-printable format.
     * According to RFC2045 section 6.7.
     *
     * @param string $string The text to encode
     *
     * @return string
     */
    public function encodeQP($string)
***REMOVED***
        return static::normalizeBreaks(quoted_printable_encode($string));
***REMOVED***

    /**
     * Encode a string using Q encoding.
     *
     * @see http://tools.ietf.org/html/rfc2047#section-4.2
     *
     * @param string $str      the text to encode
     * @param string $position Where the text is going to be used, see the RFC for what that means
     *
     * @return string
     */
    public function encodeQ($str, $position = 'text')
***REMOVED***
        //There should not be any EOL in the string
        $pattern = '';
        $encoded = str_replace(["\r", "\n"***REMOVED***, '', $str);
        switch (strtolower($position)) {
            case 'phrase':
                //RFC 2047 section 5.3
                $pattern = '^A-Za-z0-9!*+\/ -';
                break;
            /*
             * RFC 2047 section 5.2.
             * Build $pattern without including delimiters and [***REMOVED***
             */
            /* @noinspection PhpMissingBreakStatementInspection */
            case 'comment':
                $pattern = '\(\)"';
            /* Intentional fall through */
            case 'text':
            default:
                //RFC 2047 section 5.1
                //Replace every high ascii, control, =, ? and _ characters
                $pattern = '\000-\011\013\014\016-\037\075\077\137\177-\377' . $pattern;
                break;
    ***REMOVED***
        $matches = [***REMOVED***;
        if (preg_match_all("/[{$pattern}***REMOVED***/", $encoded, $matches)) {
            //If the string contains an '=', make sure it's the first thing we replace
            //so as to avoid double-encoding
            $eqkey = array_search('=', $matches[0***REMOVED***, true);
            if (false !== $eqkey) {
                unset($matches[0***REMOVED***[$eqkey***REMOVED***);
                array_unshift($matches[0***REMOVED***, '=');
        ***REMOVED***
            foreach (array_unique($matches[0***REMOVED***) as $char) {
                $encoded = str_replace($char, '=' . sprintf('%02X', ord($char)), $encoded);
        ***REMOVED***
    ***REMOVED***
        //Replace spaces with _ (more readable than =20)
        //RFC 2047 section 4.2(2)
        return str_replace(' ', '_', $encoded);
***REMOVED***

    /**
     * Add a string or binary attachment (non-filesystem).
     * This method can be used to attach ascii or binary data,
     * such as a BLOB record from a database.
     *
     * @param string $string      String attachment data
     * @param string $filename    Name of the attachment
     * @param string $encoding    File encoding (see $Encoding)
     * @param string $type        File extension (MIME) type
     * @param string $disposition Disposition to use
     *
     * @throws Exception
     *
     * @return bool True on successfully adding an attachment
     */
    public function addStringAttachment(
        $string,
        $filename,
        $encoding = self::ENCODING_BASE64,
        $type = '',
        $disposition = 'attachment'
    ) {
        try {
            //If a MIME type is not specified, try to work it out from the file name
            if ('' === $type) {
                $type = static::filenameToType($filename);
        ***REMOVED***

            if (!$this->validateEncoding($encoding)) {
                throw new Exception($this->lang('encoding') . $encoding);
        ***REMOVED***

            //Append to $attachment array
            $this->attachment[***REMOVED*** = [
                0 => $string,
                1 => $filename,
                2 => static::mb_pathinfo($filename, PATHINFO_BASENAME),
                3 => $encoding,
                4 => $type,
                5 => true, //isStringAttachment
                6 => $disposition,
                7 => 0,
            ***REMOVED***;
    ***REMOVED*** catch (Exception $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
        ***REMOVED***

            return false;
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Add an embedded (inline) attachment from a file.
     * This can include images, sounds, and just about any other document type.
     * These differ from 'regular' attachments in that they are intended to be
     * displayed inline with the message, not just attached for download.
     * This is used in HTML messages that embed the images
     * the HTML refers to using the $cid value.
     * Never use a user-supplied path to a file!
     *
     * @param string $path        Path to the attachment
     * @param string $cid         Content ID of the attachment; Use this to reference
     *                            the content when using an embedded image in HTML
     * @param string $name        Overrides the attachment name
     * @param string $encoding    File encoding (see $Encoding)
     * @param string $type        File MIME type
     * @param string $disposition Disposition to use
     *
     * @throws Exception
     *
     * @return bool True on successfully adding an attachment
     */
    public function addEmbeddedImage(
        $path,
        $cid,
        $name = '',
        $encoding = self::ENCODING_BASE64,
        $type = '',
        $disposition = 'inline'
    ) {
        try {
            if (!static::fileIsAccessible($path)) {
                throw new Exception($this->lang('file_access') . $path, self::STOP_CONTINUE);
        ***REMOVED***

            //If a MIME type is not specified, try to work it out from the file name
            if ('' === $type) {
                $type = static::filenameToType($path);
        ***REMOVED***

            if (!$this->validateEncoding($encoding)) {
                throw new Exception($this->lang('encoding') . $encoding);
        ***REMOVED***

            $filename = (string) static::mb_pathinfo($path, PATHINFO_BASENAME);
            if ('' === $name) {
                $name = $filename;
        ***REMOVED***

            //Append to $attachment array
            $this->attachment[***REMOVED*** = [
                0 => $path,
                1 => $filename,
                2 => $name,
                3 => $encoding,
                4 => $type,
                5 => false, //isStringAttachment
                6 => $disposition,
                7 => $cid,
            ***REMOVED***;
    ***REMOVED*** catch (Exception $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
        ***REMOVED***

            return false;
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Add an embedded stringified attachment.
     * This can include images, sounds, and just about any other document type.
     * If your filename doesn't contain an extension, be sure to set the $type to an appropriate MIME type.
     *
     * @param string $string      The attachment binary data
     * @param string $cid         Content ID of the attachment; Use this to reference
     *                            the content when using an embedded image in HTML
     * @param string $name        A filename for the attachment. If this contains an extension,
     *                            PHPMailer will attempt to set a MIME type for the attachment.
     *                            For example 'file.jpg' would get an 'image/jpeg' MIME type.
     * @param string $encoding    File encoding (see $Encoding), defaults to 'base64'
     * @param string $type        MIME type - will be used in preference to any automatically derived type
     * @param string $disposition Disposition to use
     *
     * @throws Exception
     *
     * @return bool True on successfully adding an attachment
     */
    public function addStringEmbeddedImage(
        $string,
        $cid,
        $name = '',
        $encoding = self::ENCODING_BASE64,
        $type = '',
        $disposition = 'inline'
    ) {
        try {
            //If a MIME type is not specified, try to work it out from the name
            if ('' === $type && !empty($name)) {
                $type = static::filenameToType($name);
        ***REMOVED***

            if (!$this->validateEncoding($encoding)) {
                throw new Exception($this->lang('encoding') . $encoding);
        ***REMOVED***

            //Append to $attachment array
            $this->attachment[***REMOVED*** = [
                0 => $string,
                1 => $name,
                2 => $name,
                3 => $encoding,
                4 => $type,
                5 => true, //isStringAttachment
                6 => $disposition,
                7 => $cid,
            ***REMOVED***;
    ***REMOVED*** catch (Exception $exc) {
            $this->setError($exc->getMessage());
            $this->edebug($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
        ***REMOVED***

            return false;
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Validate encodings.
     *
     * @param string $encoding
     *
     * @return bool
     */
    protected function validateEncoding($encoding)
***REMOVED***
        return in_array(
            $encoding,
            [
                self::ENCODING_7BIT,
                self::ENCODING_QUOTED_PRINTABLE,
                self::ENCODING_BASE64,
                self::ENCODING_8BIT,
                self::ENCODING_BINARY,
            ***REMOVED***,
            true
        );
***REMOVED***

    /**
     * Check if an embedded attachment is present with this cid.
     *
     * @param string $cid
     *
     * @return bool
     */
    protected function cidExists($cid)
***REMOVED***
        foreach ($this->attachment as $attachment) {
            if ('inline' === $attachment[6***REMOVED*** && $cid === $attachment[7***REMOVED***) {
                return true;
        ***REMOVED***
    ***REMOVED***

        return false;
***REMOVED***

    /**
     * Check if an inline attachment is present.
     *
     * @return bool
     */
    public function inlineImageExists()
***REMOVED***
        foreach ($this->attachment as $attachment) {
            if ('inline' === $attachment[6***REMOVED***) {
                return true;
        ***REMOVED***
    ***REMOVED***

        return false;
***REMOVED***

    /**
     * Check if an attachment (non-inline) is present.
     *
     * @return bool
     */
    public function attachmentExists()
***REMOVED***
        foreach ($this->attachment as $attachment) {
            if ('attachment' === $attachment[6***REMOVED***) {
                return true;
        ***REMOVED***
    ***REMOVED***

        return false;
***REMOVED***

    /**
     * Check if this message has an alternative body set.
     *
     * @return bool
     */
    public function alternativeExists()
***REMOVED***
        return !empty($this->AltBody);
***REMOVED***

    /**
     * Clear queued addresses of given kind.
     *
     * @param string $kind 'to', 'cc', or 'bcc'
     */
    public function clearQueuedAddresses($kind)
***REMOVED***
        $this->RecipientsQueue = array_filter(
            $this->RecipientsQueue,
            static function ($params) use ($kind) {
                return $params[0***REMOVED*** !== $kind;
        ***REMOVED***
        );
***REMOVED***

    /**
     * Clear all To recipients.
     */
    public function clearAddresses()
***REMOVED***
        foreach ($this->to as $to) {
            unset($this->all_recipients[strtolower($to[0***REMOVED***)***REMOVED***);
    ***REMOVED***
        $this->to = [***REMOVED***;
        $this->clearQueuedAddresses('to');
***REMOVED***

    /**
     * Clear all CC recipients.
     */
    public function clearCCs()
***REMOVED***
        foreach ($this->cc as $cc) {
            unset($this->all_recipients[strtolower($cc[0***REMOVED***)***REMOVED***);
    ***REMOVED***
        $this->cc = [***REMOVED***;
        $this->clearQueuedAddresses('cc');
***REMOVED***

    /**
     * Clear all BCC recipients.
     */
    public function clearBCCs()
***REMOVED***
        foreach ($this->bcc as $bcc) {
            unset($this->all_recipients[strtolower($bcc[0***REMOVED***)***REMOVED***);
    ***REMOVED***
        $this->bcc = [***REMOVED***;
        $this->clearQueuedAddresses('bcc');
***REMOVED***

    /**
     * Clear all ReplyTo recipients.
     */
    public function clearReplyTos()
***REMOVED***
        $this->ReplyTo = [***REMOVED***;
        $this->ReplyToQueue = [***REMOVED***;
***REMOVED***

    /**
     * Clear all recipient types.
     */
    public function clearAllRecipients()
***REMOVED***
        $this->to = [***REMOVED***;
        $this->cc = [***REMOVED***;
        $this->bcc = [***REMOVED***;
        $this->all_recipients = [***REMOVED***;
        $this->RecipientsQueue = [***REMOVED***;
***REMOVED***

    /**
     * Clear all filesystem, string, and binary attachments.
     */
    public function clearAttachments()
***REMOVED***
        $this->attachment = [***REMOVED***;
***REMOVED***

    /**
     * Clear all custom headers.
     */
    public function clearCustomHeaders()
***REMOVED***
        $this->CustomHeader = [***REMOVED***;
***REMOVED***

    /**
     * Add an error message to the error container.
     *
     * @param string $msg
     */
    protected function setError($msg)
***REMOVED***
        ++$this->error_count;
        if ('smtp' === $this->Mailer && null !== $this->smtp) {
            $lasterror = $this->smtp->getError();
            if (!empty($lasterror['error'***REMOVED***)) {
                $msg .= $this->lang('smtp_error') . $lasterror['error'***REMOVED***;
                if (!empty($lasterror['detail'***REMOVED***)) {
                    $msg .= ' ' . $this->lang('smtp_detail') . $lasterror['detail'***REMOVED***;
            ***REMOVED***
                if (!empty($lasterror['smtp_code'***REMOVED***)) {
                    $msg .= ' ' . $this->lang('smtp_code') . $lasterror['smtp_code'***REMOVED***;
            ***REMOVED***
                if (!empty($lasterror['smtp_code_ex'***REMOVED***)) {
                    $msg .= ' ' . $this->lang('smtp_code_ex') . $lasterror['smtp_code_ex'***REMOVED***;
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***
        $this->ErrorInfo = $msg;
***REMOVED***

    /**
     * Return an RFC 822 formatted date.
     *
     * @return string
     */
    public static function rfcDate()
***REMOVED***
        //Set the time zone to whatever the default is to avoid 500 errors
        //Will default to UTC if it's not set properly in php.ini
        date_default_timezone_set(@date_default_timezone_get());

        return date('D, j M Y H:i:s O');
***REMOVED***

    /**
     * Get the server hostname.
     * Returns 'localhost.localdomain' if unknown.
     *
     * @return string
     */
    protected function serverHostname()
***REMOVED***
        $result = '';
        if (!empty($this->Hostname)) {
            $result = $this->Hostname;
    ***REMOVED*** elseif (isset($_SERVER) && array_key_exists('SERVER_NAME', $_SERVER)) {
            $result = $_SERVER['SERVER_NAME'***REMOVED***;
    ***REMOVED*** elseif (function_exists('gethostname') && gethostname() !== false) {
            $result = gethostname();
    ***REMOVED*** elseif (php_uname('n') !== false) {
            $result = php_uname('n');
    ***REMOVED***
        if (!static::isValidHost($result)) {
            return 'localhost.localdomain';
    ***REMOVED***

        return $result;
***REMOVED***

    /**
     * Validate whether a string contains a valid value to use as a hostname or IP address.
     * IPv6 addresses must include [***REMOVED***, e.g. `[::1***REMOVED***`, not just `::1`.
     *
     * @param string $host The host name or IP address to check
     *
     * @return bool
     */
    public static function isValidHost($host)
***REMOVED***
        //Simple syntax limits
        if (
            empty($host)
            || !is_string($host)
            || strlen($host) > 256
            || !preg_match('/^([a-zA-Z\d.-***REMOVED****|\[[a-fA-F\d:***REMOVED***+\***REMOVED***)$/', $host)
        ) {
            return false;
    ***REMOVED***
        //Looks like a bracketed IPv6 address
        if (strlen($host) > 2 && substr($host, 0, 1) === '[' && substr($host, -1, 1) === '***REMOVED***') {
            return filter_var(substr($host, 1, -1), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    ***REMOVED***
        //If removing all the dots results in a numeric string, it must be an IPv4 address.
        //Need to check this first because otherwise things like `999.0.0.0` are considered valid host names
        if (is_numeric(str_replace('.', '', $host))) {
            //Is it a valid IPv4 address?
            return filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    ***REMOVED***
        if (filter_var('http://' . $host, FILTER_VALIDATE_URL) !== false) {
            //Is it a syntactically valid hostname?
            return true;
    ***REMOVED***

        return false;
***REMOVED***

    /**
     * Get an error message in the current language.
     *
     * @param string $key
     *
     * @return string
     */
    protected function lang($key)
***REMOVED***
        if (count($this->language) < 1) {
            $this->setLanguage(); //Set the default language
    ***REMOVED***

        if (array_key_exists($key, $this->language)) {
            if ('smtp_connect_failed' === $key) {
                //Include a link to troubleshooting docs on SMTP connection failure.
                //This is by far the biggest cause of support questions
                //but it's usually not PHPMailer's fault.
                return $this->language[$key***REMOVED*** . ' https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting';
        ***REMOVED***

            return $this->language[$key***REMOVED***;
    ***REMOVED***

        //Return the key as a fallback
        return $key;
***REMOVED***

    /**
     * Check if an error occurred.
     *
     * @return bool True if an error did occur
     */
    public function isError()
***REMOVED***
        return $this->error_count > 0;
***REMOVED***

    /**
     * Add a custom header.
     * $name value can be overloaded to contain
     * both header name and value (name:value).
     *
     * @param string      $name  Custom header name
     * @param string|null $value Header value
     *
     * @throws Exception
     */
    public function addCustomHeader($name, $value = null)
***REMOVED***
        if (null === $value && strpos($name, ':') !== false) {
            //Value passed in as name:value
            list($name, $value) = explode(':', $name, 2);
    ***REMOVED***
        $name = trim($name);
        $value = (null === $value) ? '' : trim($value);
        //Ensure name is not empty, and that neither name nor value contain line breaks
        if (empty($name) || strpbrk($name . $value, "\r\n") !== false) {
            if ($this->exceptions) {
                throw new Exception($this->lang('invalid_header'));
        ***REMOVED***

            return false;
    ***REMOVED***
        $this->CustomHeader[***REMOVED*** = [$name, $value***REMOVED***;

        return true;
***REMOVED***

    /**
     * Returns all custom headers.
     *
     * @return array
     */
    public function getCustomHeaders()
***REMOVED***
        return $this->CustomHeader;
***REMOVED***

    /**
     * Create a message body from an HTML string.
     * Automatically inlines images and creates a plain-text version by converting the HTML,
     * overwriting any existing values in Body and AltBody.
     * Do not source $message content from user input!
     * $basedir is prepended when handling relative URLs, e.g. <img src="/images/a.png"> and must not be empty
     * will look for an image file in $basedir/images/a.png and convert it to inline.
     * If you don't provide a $basedir, relative paths will be left untouched (and thus probably break in email)
     * Converts data-uri images into embedded attachments.
     * If you don't want to apply these transformations to your HTML, just set Body and AltBody directly.
     *
     * @param string        $message  HTML message string
     * @param string        $basedir  Absolute path to a base directory to prepend to relative paths to images
     * @param bool|callable $advanced Whether to use the internal HTML to text converter
     *                                or your own custom converter
     * @return string The transformed message body
     *
     * @throws Exception
     *
     * @see PHPMailer::html2text()
     */
    public function msgHTML($message, $basedir = '', $advanced = false)
***REMOVED***
        preg_match_all('/(?<!-)(src|background)=["\'***REMOVED***(.*)["\'***REMOVED***/Ui', $message, $images);
        if (array_key_exists(2, $images)) {
            if (strlen($basedir) > 1 && '/' !== substr($basedir, -1)) {
                //Ensure $basedir has a trailing /
                $basedir .= '/';
        ***REMOVED***
            foreach ($images[2***REMOVED*** as $imgindex => $url) {
                //Convert data URIs into embedded images
                //e.g. "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                $match = [***REMOVED***;
                if (preg_match('#^data:(image/(?:jpe?g|gif|png));?(base64)?,(.+)#', $url, $match)) {
                    if (count($match) === 4 && static::ENCODING_BASE64 === $match[2***REMOVED***) {
                        $data = base64_decode($match[3***REMOVED***);
                ***REMOVED*** elseif ('' === $match[2***REMOVED***) {
                        $data = rawurldecode($match[3***REMOVED***);
                ***REMOVED*** else {
                        //Not recognised so leave it alone
                        continue;
                ***REMOVED***
                    //Hash the decoded data, not the URL, so that the same data-URI image used in multiple places
                    //will only be embedded once, even if it used a different encoding
                    $cid = substr(hash('sha256', $data), 0, 32) . '@phpmailer.0'; //RFC2392 S 2

                    if (!$this->cidExists($cid)) {
                        $this->addStringEmbeddedImage(
                            $data,
                            $cid,
                            'embed' . $imgindex,
                            static::ENCODING_BASE64,
                            $match[1***REMOVED***
                        );
                ***REMOVED***
                    $message = str_replace(
                        $images[0***REMOVED***[$imgindex***REMOVED***,
                        $images[1***REMOVED***[$imgindex***REMOVED*** . '="cid:' . $cid . '"',
                        $message
                    );
                    continue;
            ***REMOVED***
                if (
                    //Only process relative URLs if a basedir is provided (i.e. no absolute local paths)
                    !empty($basedir)
                    //Ignore URLs containing parent dir traversal (..)
                    && (strpos($url, '..') === false)
                    //Do not change urls that are already inline images
                    && 0 !== strpos($url, 'cid:')
                    //Do not change absolute URLs, including anonymous protocol
                    && !preg_match('#^[a-z***REMOVED***[a-z0-9+.-***REMOVED****:?//#i', $url)
                ) {
                    $filename = static::mb_pathinfo($url, PATHINFO_BASENAME);
                    $directory = dirname($url);
                    if ('.' === $directory) {
                        $directory = '';
                ***REMOVED***
                    //RFC2392 S 2
                    $cid = substr(hash('sha256', $url), 0, 32) . '@phpmailer.0';
                    if (strlen($basedir) > 1 && '/' !== substr($basedir, -1)) {
                        $basedir .= '/';
                ***REMOVED***
                    if (strlen($directory) > 1 && '/' !== substr($directory, -1)) {
                        $directory .= '/';
                ***REMOVED***
                    if (
                        $this->addEmbeddedImage(
                            $basedir . $directory . $filename,
                            $cid,
                            $filename,
                            static::ENCODING_BASE64,
                            static::_mime_types((string) static::mb_pathinfo($filename, PATHINFO_EXTENSION))
                        )
                    ) {
                        $message = preg_replace(
                            '/' . $images[1***REMOVED***[$imgindex***REMOVED*** . '=["\'***REMOVED***' . preg_quote($url, '/') . '["\'***REMOVED***/Ui',
                            $images[1***REMOVED***[$imgindex***REMOVED*** . '="cid:' . $cid . '"',
                            $message
                        );
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***
        $this->isHTML();
        //Convert all message body line breaks to LE, makes quoted-printable encoding work much better
        $this->Body = static::normalizeBreaks($message);
        $this->AltBody = static::normalizeBreaks($this->html2text($message, $advanced));
        if (!$this->alternativeExists()) {
            $this->AltBody = 'This is an HTML-only message. To view it, activate HTML in your email application.'
                . static::$LE;
    ***REMOVED***

        return $this->Body;
***REMOVED***

    /**
     * Convert an HTML string into plain text.
     * This is used by msgHTML().
     * Note - older versions of this function used a bundled advanced converter
     * which was removed for license reasons in #232.
     * Example usage:
     *
     * ```php
     * //Use default conversion
     * $plain = $mail->html2text($html);
     * //Use your own custom converter
     * $plain = $mail->html2text($html, function($html) {
     *     $converter = new MyHtml2text($html);
     *     return $converter->get_text();
     * });
     * ```
     *
     * @param string        $html     The HTML text to convert
     * @param bool|callable $advanced Any boolean value to use the internal converter,
     *                                or provide your own callable for custom conversion.
     *                                *Never* pass user-supplied data into this parameter
     *
     * @return string
     */
    public function html2text($html, $advanced = false)
***REMOVED***
        if (is_callable($advanced)) {
            return call_user_func($advanced, $html);
    ***REMOVED***

        return html_entity_decode(
            trim(strip_tags(preg_replace('/<(head|title|style|script)[^>***REMOVED****>.*?<\/\\1>/si', '', $html))),
            ENT_QUOTES,
            $this->CharSet
        );
***REMOVED***

    /**
     * Get the MIME type for a file extension.
     *
     * @param string $ext File extension
     *
     * @return string MIME type of file
     */
    public static function _mime_types($ext = '')
***REMOVED***
        $mimes = [
            'xl' => 'application/excel',
            'js' => 'application/javascript',
            'hqx' => 'application/mac-binhex40',
            'cpt' => 'application/mac-compactpro',
            'bin' => 'application/macbinary',
            'doc' => 'application/msword',
            'word' => 'application/msword',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
            'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',
            'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'sldx' => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
            'xlam' => 'application/vnd.ms-excel.addin.macroEnabled.12',
            'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
            'class' => 'application/octet-stream',
            'dll' => 'application/octet-stream',
            'dms' => 'application/octet-stream',
            'exe' => 'application/octet-stream',
            'lha' => 'application/octet-stream',
            'lzh' => 'application/octet-stream',
            'psd' => 'application/octet-stream',
            'sea' => 'application/octet-stream',
            'so' => 'application/octet-stream',
            'oda' => 'application/oda',
            'pdf' => 'application/pdf',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
            'smi' => 'application/smil',
            'smil' => 'application/smil',
            'mif' => 'application/vnd.mif',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'wbxml' => 'application/vnd.wap.wbxml',
            'wmlc' => 'application/vnd.wap.wmlc',
            'dcr' => 'application/x-director',
            'dir' => 'application/x-director',
            'dxr' => 'application/x-director',
            'dvi' => 'application/x-dvi',
            'gtar' => 'application/x-gtar',
            'php3' => 'application/x-httpd-php',
            'php4' => 'application/x-httpd-php',
            'php' => 'application/x-httpd-php',
            'phtml' => 'application/x-httpd-php',
            'phps' => 'application/x-httpd-php-source',
            'swf' => 'application/x-shockwave-flash',
            'sit' => 'application/x-stuffit',
            'tar' => 'application/x-tar',
            'tgz' => 'application/x-tar',
            'xht' => 'application/xhtml+xml',
            'xhtml' => 'application/xhtml+xml',
            'zip' => 'application/zip',
            'mid' => 'audio/midi',
            'midi' => 'audio/midi',
            'mp2' => 'audio/mpeg',
            'mp3' => 'audio/mpeg',
            'm4a' => 'audio/mp4',
            'mpga' => 'audio/mpeg',
            'aif' => 'audio/x-aiff',
            'aifc' => 'audio/x-aiff',
            'aiff' => 'audio/x-aiff',
            'ram' => 'audio/x-pn-realaudio',
            'rm' => 'audio/x-pn-realaudio',
            'rpm' => 'audio/x-pn-realaudio-plugin',
            'ra' => 'audio/x-realaudio',
            'wav' => 'audio/x-wav',
            'mka' => 'audio/x-matroska',
            'bmp' => 'image/bmp',
            'gif' => 'image/gif',
            'jpeg' => 'image/jpeg',
            'jpe' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'webp' => 'image/webp',
            'avif' => 'image/avif',
            'heif' => 'image/heif',
            'heifs' => 'image/heif-sequence',
            'heic' => 'image/heic',
            'heics' => 'image/heic-sequence',
            'eml' => 'message/rfc822',
            'css' => 'text/css',
            'html' => 'text/html',
            'htm' => 'text/html',
            'shtml' => 'text/html',
            'log' => 'text/plain',
            'text' => 'text/plain',
            'txt' => 'text/plain',
            'rtx' => 'text/richtext',
            'rtf' => 'text/rtf',
            'vcf' => 'text/vcard',
            'vcard' => 'text/vcard',
            'ics' => 'text/calendar',
            'xml' => 'text/xml',
            'xsl' => 'text/xml',
            'wmv' => 'video/x-ms-wmv',
            'mpeg' => 'video/mpeg',
            'mpe' => 'video/mpeg',
            'mpg' => 'video/mpeg',
            'mp4' => 'video/mp4',
            'm4v' => 'video/mp4',
            'mov' => 'video/quicktime',
            'qt' => 'video/quicktime',
            'rv' => 'video/vnd.rn-realvideo',
            'avi' => 'video/x-msvideo',
            'movie' => 'video/x-sgi-movie',
            'webm' => 'video/webm',
            'mkv' => 'video/x-matroska',
        ***REMOVED***;
        $ext = strtolower($ext);
        if (array_key_exists($ext, $mimes)) {
            return $mimes[$ext***REMOVED***;
    ***REMOVED***

        return 'application/octet-stream';
***REMOVED***

    /**
     * Map a file name to a MIME type.
     * Defaults to 'application/octet-stream', i.e.. arbitrary binary data.
     *
     * @param string $filename A file name or full path, does not need to exist as a file
     *
     * @return string
     */
    public static function filenameToType($filename)
***REMOVED***
        //In case the path is a URL, strip any query string before getting extension
        $qpos = strpos($filename, '?');
        if (false !== $qpos) {
            $filename = substr($filename, 0, $qpos);
    ***REMOVED***
        $ext = static::mb_pathinfo($filename, PATHINFO_EXTENSION);

        return static::_mime_types($ext);
***REMOVED***

    /**
     * Multi-byte-safe pathinfo replacement.
     * Drop-in replacement for pathinfo(), but multibyte- and cross-platform-safe.
     *
     * @see http://www.php.net/manual/en/function.pathinfo.php#107461
     *
     * @param string     $path    A filename or path, does not need to exist as a file
     * @param int|string $options Either a PATHINFO_* constant,
     *                            or a string name to return only the specified piece
     *
     * @return string|array
     */
    public static function mb_pathinfo($path, $options = null)
***REMOVED***
        $ret = ['dirname' => '', 'basename' => '', 'extension' => '', 'filename' => ''***REMOVED***;
        $pathinfo = [***REMOVED***;
        if (preg_match('#^(.*?)[\\\\/***REMOVED****(([^/\\\\***REMOVED****?)(\.([^.\\\\/***REMOVED***+?)|))[\\\\/.***REMOVED****$#m', $path, $pathinfo)) {
            if (array_key_exists(1, $pathinfo)) {
                $ret['dirname'***REMOVED*** = $pathinfo[1***REMOVED***;
        ***REMOVED***
            if (array_key_exists(2, $pathinfo)) {
                $ret['basename'***REMOVED*** = $pathinfo[2***REMOVED***;
        ***REMOVED***
            if (array_key_exists(5, $pathinfo)) {
                $ret['extension'***REMOVED*** = $pathinfo[5***REMOVED***;
        ***REMOVED***
            if (array_key_exists(3, $pathinfo)) {
                $ret['filename'***REMOVED*** = $pathinfo[3***REMOVED***;
        ***REMOVED***
    ***REMOVED***
        switch ($options) {
            case PATHINFO_DIRNAME:
            case 'dirname':
                return $ret['dirname'***REMOVED***;
            case PATHINFO_BASENAME:
            case 'basename':
                return $ret['basename'***REMOVED***;
            case PATHINFO_EXTENSION:
            case 'extension':
                return $ret['extension'***REMOVED***;
            case PATHINFO_FILENAME:
            case 'filename':
                return $ret['filename'***REMOVED***;
            default:
                return $ret;
    ***REMOVED***
***REMOVED***

    /**
     * Set or reset instance properties.
     * You should avoid this function - it's more verbose, less efficient, more error-prone and
     * harder to debug than setting properties directly.
     * Usage Example:
     * `$mail->set('SMTPSecure', static::ENCRYPTION_STARTTLS);`
     *   is the same as:
     * `$mail->SMTPSecure = static::ENCRYPTION_STARTTLS;`.
     *
     * @param string $name  The property name to set
     * @param mixed  $value The value to set the property to
     *
     * @return bool
     */
    public function set($name, $value = '')
***REMOVED***
        if (property_exists($this, $name)) {
            $this->$name = $value;

            return true;
    ***REMOVED***
        $this->setError($this->lang('variable_set') . $name);

        return false;
***REMOVED***

    /**
     * Strip newlines to prevent header injection.
     *
     * @param string $str
     *
     * @return string
     */
    public function secureHeader($str)
***REMOVED***
        return trim(str_replace(["\r", "\n"***REMOVED***, '', $str));
***REMOVED***

    /**
     * Normalize line breaks in a string.
     * Converts UNIX LF, Mac CR and Windows CRLF line breaks into a single line break format.
     * Defaults to CRLF (for message bodies) and preserves consecutive breaks.
     *
     * @param string $text
     * @param string $breaktype What kind of line break to use; defaults to static::$LE
     *
     * @return string
     */
    public static function normalizeBreaks($text, $breaktype = null)
***REMOVED***
        if (null === $breaktype) {
            $breaktype = static::$LE;
    ***REMOVED***
        //Normalise to \n
        $text = str_replace([self::CRLF, "\r"***REMOVED***, "\n", $text);
        //Now convert LE as needed
        if ("\n" !== $breaktype) {
            $text = str_replace("\n", $breaktype, $text);
    ***REMOVED***

        return $text;
***REMOVED***

    /**
     * Remove trailing breaks from a string.
     *
     * @param string $text
     *
     * @return string The text to remove breaks from
     */
    public static function stripTrailingWSP($text)
***REMOVED***
        return rtrim($text, " \r\n\t");
***REMOVED***

    /**
     * Return the current line break format string.
     *
     * @return string
     */
    public static function getLE()
***REMOVED***
        return static::$LE;
***REMOVED***

    /**
     * Set the line break format string, e.g. "\r\n".
     *
     * @param string $le
     */
    protected static function setLE($le)
***REMOVED***
        static::$LE = $le;
***REMOVED***

    /**
     * Set the public and private key files and password for S/MIME signing.
     *
     * @param string $cert_filename
     * @param string $key_filename
     * @param string $key_pass            Password for private key
     * @param string $extracerts_filename Optional path to chain certificate
     */
    public function sign($cert_filename, $key_filename, $key_pass, $extracerts_filename = '')
***REMOVED***
        $this->sign_cert_file = $cert_filename;
        $this->sign_key_file = $key_filename;
        $this->sign_key_pass = $key_pass;
        $this->sign_extracerts_file = $extracerts_filename;
***REMOVED***

    /**
     * Quoted-Printable-encode a DKIM header.
     *
     * @param string $txt
     *
     * @return string
     */
    public function DKIM_QP($txt)
***REMOVED***
        $line = '';
        $len = strlen($txt);
        for ($i = 0; $i < $len; ++$i) {
            $ord = ord($txt[$i***REMOVED***);
            if (((0x21 <= $ord) && ($ord <= 0x3A)) || $ord === 0x3C || ((0x3E <= $ord) && ($ord <= 0x7E))) {
                $line .= $txt[$i***REMOVED***;
        ***REMOVED*** else {
                $line .= '=' . sprintf('%02X', $ord);
        ***REMOVED***
    ***REMOVED***

        return $line;
***REMOVED***

    /**
     * Generate a DKIM signature.
     *
     * @param string $signHeader
     *
     * @throws Exception
     *
     * @return string The DKIM signature value
     */
    public function DKIM_Sign($signHeader)
***REMOVED***
        if (!defined('PKCS7_TEXT')) {
            if ($this->exceptions) {
                throw new Exception($this->lang('extension_missing') . 'openssl');
        ***REMOVED***

            return '';
    ***REMOVED***
        $privKeyStr = !empty($this->DKIM_private_string) ?
            $this->DKIM_private_string :
            file_get_contents($this->DKIM_private);
        if ('' !== $this->DKIM_passphrase) {
            $privKey = openssl_pkey_get_private($privKeyStr, $this->DKIM_passphrase);
    ***REMOVED*** else {
            $privKey = openssl_pkey_get_private($privKeyStr);
    ***REMOVED***
        if (openssl_sign($signHeader, $signature, $privKey, 'sha256WithRSAEncryption')) {
            if (\PHP_MAJOR_VERSION < 8) {
                openssl_pkey_free($privKey);
        ***REMOVED***

            return base64_encode($signature);
    ***REMOVED***
        if (\PHP_MAJOR_VERSION < 8) {
            openssl_pkey_free($privKey);
    ***REMOVED***

        return '';
***REMOVED***

    /**
     * Generate a DKIM canonicalization header.
     * Uses the 'relaxed' algorithm from RFC6376 section 3.4.2.
     * Canonicalized headers should *always* use CRLF, regardless of mailer setting.
     *
     * @see https://tools.ietf.org/html/rfc6376#section-3.4.2
     *
     * @param string $signHeader Header
     *
     * @return string
     */
    public function DKIM_HeaderC($signHeader)
***REMOVED***
        //Normalize breaks to CRLF (regardless of the mailer)
        $signHeader = static::normalizeBreaks($signHeader, self::CRLF);
        //Unfold header lines
        //Note PCRE \s is too broad a definition of whitespace; RFC5322 defines it as `[ \t***REMOVED***`
        //@see https://tools.ietf.org/html/rfc5322#section-2.2
        //That means this may break if you do something daft like put vertical tabs in your headers.
        $signHeader = preg_replace('/\r\n[ \t***REMOVED***+/', ' ', $signHeader);
        //Break headers out into an array
        $lines = explode(self::CRLF, $signHeader);
        foreach ($lines as $key => $line) {
            //If the header is missing a :, skip it as it's invalid
            //This is likely to happen because the explode() above will also split
            //on the trailing LE, leaving an empty line
            if (strpos($line, ':') === false) {
                continue;
        ***REMOVED***
            list($heading, $value) = explode(':', $line, 2);
            //Lower-case header name
            $heading = strtolower($heading);
            //Collapse white space within the value, also convert WSP to space
            $value = preg_replace('/[ \t***REMOVED***+/', ' ', $value);
            //RFC6376 is slightly unclear here - it says to delete space at the *end* of each value
            //But then says to delete space before and after the colon.
            //Net result is the same as trimming both ends of the value.
            //By elimination, the same applies to the field name
            $lines[$key***REMOVED*** = trim($heading, " \t") . ':' . trim($value, " \t");
    ***REMOVED***

        return implode(self::CRLF, $lines);
***REMOVED***

    /**
     * Generate a DKIM canonicalization body.
     * Uses the 'simple' algorithm from RFC6376 section 3.4.3.
     * Canonicalized bodies should *always* use CRLF, regardless of mailer setting.
     *
     * @see https://tools.ietf.org/html/rfc6376#section-3.4.3
     *
     * @param string $body Message Body
     *
     * @return string
     */
    public function DKIM_BodyC($body)
***REMOVED***
        if (empty($body)) {
            return self::CRLF;
    ***REMOVED***
        //Normalize line endings to CRLF
        $body = static::normalizeBreaks($body, self::CRLF);

        //Reduce multiple trailing line breaks to a single one
        return static::stripTrailingWSP($body) . self::CRLF;
***REMOVED***

    /**
     * Create the DKIM header and body in a new message header.
     *
     * @param string $headers_line Header lines
     * @param string $subject      Subject
     * @param string $body         Body
     *
     * @throws Exception
     *
     * @return string
     */
    public function DKIM_Add($headers_line, $subject, $body)
***REMOVED***
        $DKIMsignatureType = 'rsa-sha256'; //Signature & hash algorithms
        $DKIMcanonicalization = 'relaxed/simple'; //Canonicalization methods of header & body
        $DKIMquery = 'dns/txt'; //Query method
        $DKIMtime = time();
        //Always sign these headers without being asked
        //Recommended list from https://tools.ietf.org/html/rfc6376#section-5.4.1
        $autoSignHeaders = [
            'from',
            'to',
            'cc',
            'date',
            'subject',
            'reply-to',
            'message-id',
            'content-type',
            'mime-version',
            'x-mailer',
        ***REMOVED***;
        if (stripos($headers_line, 'Subject') === false) {
            $headers_line .= 'Subject: ' . $subject . static::$LE;
    ***REMOVED***
        $headerLines = explode(static::$LE, $headers_line);
        $currentHeaderLabel = '';
        $currentHeaderValue = '';
        $parsedHeaders = [***REMOVED***;
        $headerLineIndex = 0;
        $headerLineCount = count($headerLines);
        foreach ($headerLines as $headerLine) {
            $matches = [***REMOVED***;
            if (preg_match('/^([^ \t***REMOVED****?)(?::[ \t***REMOVED****)(.*)$/', $headerLine, $matches)) {
                if ($currentHeaderLabel !== '') {
                    //We were previously in another header; This is the start of a new header, so save the previous one
                    $parsedHeaders[***REMOVED*** = ['label' => $currentHeaderLabel, 'value' => $currentHeaderValue***REMOVED***;
            ***REMOVED***
                $currentHeaderLabel = $matches[1***REMOVED***;
                $currentHeaderValue = $matches[2***REMOVED***;
        ***REMOVED*** elseif (preg_match('/^[ \t***REMOVED***+(.*)$/', $headerLine, $matches)) {
                //This is a folded continuation of the current header, so unfold it
                $currentHeaderValue .= ' ' . $matches[1***REMOVED***;
        ***REMOVED***
            ++$headerLineIndex;
            if ($headerLineIndex >= $headerLineCount) {
                //This was the last line, so finish off this header
                $parsedHeaders[***REMOVED*** = ['label' => $currentHeaderLabel, 'value' => $currentHeaderValue***REMOVED***;
        ***REMOVED***
    ***REMOVED***
        $copiedHeaders = [***REMOVED***;
        $headersToSignKeys = [***REMOVED***;
        $headersToSign = [***REMOVED***;
        foreach ($parsedHeaders as $header) {
            //Is this header one that must be included in the DKIM signature?
            if (in_array(strtolower($header['label'***REMOVED***), $autoSignHeaders, true)) {
                $headersToSignKeys[***REMOVED*** = $header['label'***REMOVED***;
                $headersToSign[***REMOVED*** = $header['label'***REMOVED*** . ': ' . $header['value'***REMOVED***;
                if ($this->DKIM_copyHeaderFields) {
                    $copiedHeaders[***REMOVED*** = $header['label'***REMOVED*** . ':' . //Note no space after this, as per RFC
                        str_replace('|', '=7C', $this->DKIM_QP($header['value'***REMOVED***));
            ***REMOVED***
                continue;
        ***REMOVED***
            //Is this an extra custom header we've been asked to sign?
            if (in_array($header['label'***REMOVED***, $this->DKIM_extraHeaders, true)) {
                //Find its value in custom headers
                foreach ($this->CustomHeader as $customHeader) {
                    if ($customHeader[0***REMOVED*** === $header['label'***REMOVED***) {
                        $headersToSignKeys[***REMOVED*** = $header['label'***REMOVED***;
                        $headersToSign[***REMOVED*** = $header['label'***REMOVED*** . ': ' . $header['value'***REMOVED***;
                        if ($this->DKIM_copyHeaderFields) {
                            $copiedHeaders[***REMOVED*** = $header['label'***REMOVED*** . ':' . //Note no space after this, as per RFC
                                str_replace('|', '=7C', $this->DKIM_QP($header['value'***REMOVED***));
                    ***REMOVED***
                        //Skip straight to the next header
                        continue 2;
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***
        $copiedHeaderFields = '';
        if ($this->DKIM_copyHeaderFields && count($copiedHeaders) > 0) {
            //Assemble a DKIM 'z' tag
            $copiedHeaderFields = ' z=';
            $first = true;
            foreach ($copiedHeaders as $copiedHeader) {
                if (!$first) {
                    $copiedHeaderFields .= static::$LE . ' |';
            ***REMOVED***
                //Fold long values
                if (strlen($copiedHeader) > self::STD_LINE_LENGTH - 3) {
                    $copiedHeaderFields .= substr(
                        chunk_split($copiedHeader, self::STD_LINE_LENGTH - 3, static::$LE . self::FWS),
                        0,
                        -strlen(static::$LE . self::FWS)
                    );
            ***REMOVED*** else {
                    $copiedHeaderFields .= $copiedHeader;
            ***REMOVED***
                $first = false;
        ***REMOVED***
            $copiedHeaderFields .= ';' . static::$LE;
    ***REMOVED***
        $headerKeys = ' h=' . implode(':', $headersToSignKeys) . ';' . static::$LE;
        $headerValues = implode(static::$LE, $headersToSign);
        $body = $this->DKIM_BodyC($body);
        //Base64 of packed binary SHA-256 hash of body
        $DKIMb64 = base64_encode(pack('H*', hash('sha256', $body)));
        $ident = '';
        if ('' !== $this->DKIM_identity) {
            $ident = ' i=' . $this->DKIM_identity . ';' . static::$LE;
    ***REMOVED***
        //The DKIM-Signature header is included in the signature *except for* the value of the `b` tag
        //which is appended after calculating the signature
        //https://tools.ietf.org/html/rfc6376#section-3.5
        $dkimSignatureHeader = 'DKIM-Signature: v=1;' .
            ' d=' . $this->DKIM_domain . ';' .
            ' s=' . $this->DKIM_selector . ';' . static::$LE .
            ' a=' . $DKIMsignatureType . ';' .
            ' q=' . $DKIMquery . ';' .
            ' t=' . $DKIMtime . ';' .
            ' c=' . $DKIMcanonicalization . ';' . static::$LE .
            $headerKeys .
            $ident .
            $copiedHeaderFields .
            ' bh=' . $DKIMb64 . ';' . static::$LE .
            ' b=';
        //Canonicalize the set of headers
        $canonicalizedHeaders = $this->DKIM_HeaderC(
            $headerValues . static::$LE . $dkimSignatureHeader
        );
        $signature = $this->DKIM_Sign($canonicalizedHeaders);
        $signature = trim(chunk_split($signature, self::STD_LINE_LENGTH - 3, static::$LE . self::FWS));

        return static::normalizeBreaks($dkimSignatureHeader . $signature);
***REMOVED***

    /**
     * Detect if a string contains a line longer than the maximum line length
     * allowed by RFC 2822 section 2.1.1.
     *
     * @param string $str
     *
     * @return bool
     */
    public static function hasLineLongerThanMax($str)
***REMOVED***
        return (bool) preg_match('/^(.{' . (self::MAX_LINE_LENGTH + strlen(static::$LE)) . ',})/m', $str);
***REMOVED***

    /**
     * If a string contains any "special" characters, double-quote the name,
     * and escape any double quotes with a backslash.
     *
     * @param string $str
     *
     * @return string
     *
     * @see RFC822 3.4.1
     */
    public static function quotedString($str)
***REMOVED***
        if (preg_match('/[ ()<>@,;:"\/\[\***REMOVED***?=***REMOVED***/', $str)) {
            //If the string contains any of these chars, it must be double-quoted
            //and any double quotes must be escaped with a backslash
            return '"' . str_replace('"', '\\"', $str) . '"';
    ***REMOVED***

        //Return the string untouched, it doesn't need quoting
        return $str;
***REMOVED***

    /**
     * Allows for public read access to 'to' property.
     * Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     *
     * @return array
     */
    public function getToAddresses()
***REMOVED***
        return $this->to;
***REMOVED***

    /**
     * Allows for public read access to 'cc' property.
     * Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     *
     * @return array
     */
    public function getCcAddresses()
***REMOVED***
        return $this->cc;
***REMOVED***

    /**
     * Allows for public read access to 'bcc' property.
     * Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     *
     * @return array
     */
    public function getBccAddresses()
***REMOVED***
        return $this->bcc;
***REMOVED***

    /**
     * Allows for public read access to 'ReplyTo' property.
     * Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     *
     * @return array
     */
    public function getReplyToAddresses()
***REMOVED***
        return $this->ReplyTo;
***REMOVED***

    /**
     * Allows for public read access to 'all_recipients' property.
     * Before the send() call, queued addresses (i.e. with IDN) are not yet included.
     *
     * @return array
     */
    public function getAllRecipientAddresses()
***REMOVED***
        return $this->all_recipients;
***REMOVED***

    /**
     * Perform a callback.
     *
     * @param bool   $isSent
     * @param array  $to
     * @param array  $cc
     * @param array  $bcc
     * @param string $subject
     * @param string $body
     * @param string $from
     * @param array  $extra
     */
    protected function doCallback($isSent, $to, $cc, $bcc, $subject, $body, $from, $extra)
***REMOVED***
        if (!empty($this->action_function) && is_callable($this->action_function)) {
            call_user_func($this->action_function, $isSent, $to, $cc, $bcc, $subject, $body, $from, $extra);
    ***REMOVED***
***REMOVED***

    /**
     * Get the OAuth instance.
     *
     * @return OAuth
     */
    public function getOAuth()
***REMOVED***
        return $this->oauth;
***REMOVED***

    /**
     * Set an OAuth instance.
     */
    public function setOAuth(OAuth $oauth)
***REMOVED***
        $this->oauth = $oauth;
***REMOVED***
}


/**
 * PHPMailer RFC821 SMTP email transport class.
 * PHP Version 5.5.
 *
 * @see       https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 *
 * @author    Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author    Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author    Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author    Brent R. Matzelle (original founder)
 * @copyright 2012 - 2020 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

class SMTP
{
    /**
     * The PHPMailer SMTP version number.
     *
     * @var string
     */
    const VERSION = '6.5.1';

    /**
     * SMTP line break constant.
     *
     * @var string
     */
    const LE = "\r\n";

    /**
     * The SMTP port to use if one is not specified.
     *
     * @var int
     */
    const DEFAULT_PORT = 25;

    /**
     * The maximum line length allowed by RFC 5321 section 4.5.3.1.6,
     * *excluding* a trailing CRLF break.
     *
     * @see https://tools.ietf.org/html/rfc5321#section-4.5.3.1.6
     *
     * @var int
     */
    const MAX_LINE_LENGTH = 998;

    /**
     * The maximum line length allowed for replies in RFC 5321 section 4.5.3.1.5,
     * *including* a trailing CRLF line break.
     *
     * @see https://tools.ietf.org/html/rfc5321#section-4.5.3.1.5
     *
     * @var int
     */
    const MAX_REPLY_LENGTH = 512;

    /**
     * Debug level for no output.
     *
     * @var int
     */
    const DEBUG_OFF = 0;

    /**
     * Debug level to show client -> server messages.
     *
     * @var int
     */
    const DEBUG_CLIENT = 1;

    /**
     * Debug level to show client -> server and server -> client messages.
     *
     * @var int
     */
    const DEBUG_SERVER = 2;

    /**
     * Debug level to show connection status, client -> server and server -> client messages.
     *
     * @var int
     */
    const DEBUG_CONNECTION = 3;

    /**
     * Debug level to show all messages.
     *
     * @var int
     */
    const DEBUG_LOWLEVEL = 4;

    /**
     * Debug output level.
     * Options:
     * * self::DEBUG_OFF (`0`) No debug output, default
     * * self::DEBUG_CLIENT (`1`) Client commands
     * * self::DEBUG_SERVER (`2`) Client commands and server responses
     * * self::DEBUG_CONNECTION (`3`) As DEBUG_SERVER plus connection status
     * * self::DEBUG_LOWLEVEL (`4`) Low-level data output, all messages.
     *
     * @var int
     */
    public $do_debug = self::DEBUG_OFF;

    /**
     * How to handle debug output.
     * Options:
     * * `echo` Output plain-text as-is, appropriate for CLI
     * * `html` Output escaped, line breaks converted to `<br>`, appropriate for browser output
     * * `error_log` Output to error log as configured in php.ini
     * Alternatively, you can provide a callable expecting two params: a message string and the debug level:
     *
     * ```php
     * $smtp->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";};
     * ```
     *
     * Alternatively, you can pass in an instance of a PSR-3 compatible logger, though only `debug`
     * level output is used:
     *
     * ```php
     * $mail->Debugoutput = new myPsr3Logger;
     * ```
     *
     * @var string|callable|\Psr\Log\LoggerInterface
     */
    public $Debugoutput = 'echo';

    /**
     * Whether to use VERP.
     *
     * @see http://en.wikipedia.org/wiki/Variable_envelope_return_path
     * @see http://www.postfix.org/VERP_README.html Info on VERP
     *
     * @var bool
     */
    public $do_verp = false;

    /**
     * The timeout value for connection, in seconds.
     * Default of 5 minutes (300sec) is from RFC2821 section 4.5.3.2.
     * This needs to be quite high to function correctly with hosts using greetdelay as an anti-spam measure.
     *
     * @see http://tools.ietf.org/html/rfc2821#section-4.5.3.2
     *
     * @var int
     */
    public $Timeout = 300;

    /**
     * How long to wait for commands to complete, in seconds.
     * Default of 5 minutes (300sec) is from RFC2821 section 4.5.3.2.
     *
     * @var int
     */
    public $Timelimit = 300;

    /**
     * Patterns to extract an SMTP transaction id from reply to a DATA command.
     * The first capture group in each regex will be used as the ID.
     * MS ESMTP returns the message ID, which may not be correct for internal tracking.
     *
     * @var string[***REMOVED***
     */
    protected $smtp_transaction_id_patterns = [
        'exim' => '/[\d***REMOVED***{3} OK id=(.*)/',
        'sendmail' => '/[\d***REMOVED***{3} 2.0.0 (.*) Message/',
        'postfix' => '/[\d***REMOVED***{3} 2.0.0 Ok: queued as (.*)/',
        'Microsoft_ESMTP' => '/[0-9***REMOVED***{3} 2.[\d***REMOVED***.0 (.*)@(?:.*) Queued mail for delivery/',
        'Amazon_SES' => '/[\d***REMOVED***{3} Ok (.*)/',
        'SendGrid' => '/[\d***REMOVED***{3} Ok: queued as (.*)/',
        'CampaignMonitor' => '/[\d***REMOVED***{3} 2.0.0 OK:([a-zA-Z\d***REMOVED***{48})/',
        'Haraka' => '/[\d***REMOVED***{3} Message Queued \((.*)\)/',
    ***REMOVED***;

    /**
     * The last transaction ID issued in response to a DATA command,
     * if one was detected.
     *
     * @var string|bool|null
     */
    protected $last_smtp_transaction_id;

    /**
     * The socket for the server connection.
     *
     * @var ?resource
     */
    protected $smtp_conn;

    /**
     * Error information, if any, for the last SMTP command.
     *
     * @var array
     */
    protected $error = [
        'error' => '',
        'detail' => '',
        'smtp_code' => '',
        'smtp_code_ex' => '',
    ***REMOVED***;

    /**
     * The reply the server sent to us for HELO.
     * If null, no HELO string has yet been received.
     *
     * @var string|null
     */
    protected $helo_rply;

    /**
     * The set of SMTP extensions sent in reply to EHLO command.
     * Indexes of the array are extension names.
     * Value at index 'HELO' or 'EHLO' (according to command that was sent)
     * represents the server name. In case of HELO it is the only element of the array.
     * Other values can be boolean TRUE or an array containing extension options.
     * If null, no HELO/EHLO string has yet been received.
     *
     * @var array|null
     */
    protected $server_caps;

    /**
     * The most recent reply received from the server.
     *
     * @var string
     */
    protected $last_reply = '';

    /**
     * Output debugging info via a user-selected method.
     *
     * @param string $str   Debug string to output
     * @param int    $level The debug level of this message; see DEBUG_* constants
     *
     * @see SMTP::$Debugoutput
     * @see SMTP::$do_debug
     */
    protected function edebug($str, $level = 0)
***REMOVED***
        if ($level > $this->do_debug) {
            return;
    ***REMOVED***
        //Is this a PSR-3 logger?
        if ($this->Debugoutput instanceof \Psr\Log\LoggerInterface) {
            $this->Debugoutput->debug($str);

            return;
    ***REMOVED***
        //Avoid clash with built-in function names
        if (is_callable($this->Debugoutput) && !in_array($this->Debugoutput, ['error_log', 'html', 'echo'***REMOVED***)) {
            call_user_func($this->Debugoutput, $str, $level);

            return;
    ***REMOVED***
        switch ($this->Debugoutput) {
            case 'error_log':
                //Don't output, just log
                error_log($str);
                break;
            case 'html':
                //Cleans up output a bit for a better looking, HTML-safe output
                echo gmdate('Y-m-d H:i:s'), ' ', htmlentities(
                    preg_replace('/[\r\n***REMOVED***+/', '', $str),
                    ENT_QUOTES,
                    'UTF-8'
                ), "<br>\n";
                break;
            case 'echo':
            default:
                //Normalize line breaks
                $str = preg_replace('/\r\n|\r/m', "\n", $str);
                echo gmdate('Y-m-d H:i:s'),
                "\t",
                    //Trim trailing space
                trim(
                    //Indent for readability, except for trailing break
                    str_replace(
                        "\n",
                        "\n                   \t                  ",
                        trim($str)
                    )
                ),
                "\n";
    ***REMOVED***
***REMOVED***

    /**
     * Connect to an SMTP server.
     *
     * @param string $host    SMTP server IP or host name
     * @param int    $port    The port number to connect to
     * @param int    $timeout How long to wait for the connection to open
     * @param array  $options An array of options for stream_context_create()
     *
     * @return bool
     */
    public function connect($host, $port = null, $timeout = 30, $options = [***REMOVED***)
***REMOVED***
        //Clear errors to avoid confusion
        $this->setError('');
        //Make sure we are __not__ connected
        if ($this->connected()) {
            //Already connected, generate error
            $this->setError('Already connected to a server');

            return false;
    ***REMOVED***
        if (empty($port)) {
            $port = self::DEFAULT_PORT;
    ***REMOVED***
        //Connect to the SMTP server
        $this->edebug(
            "Connection: opening to $host:$port, timeout=$timeout, options=" .
            (count($options) > 0 ? var_export($options, true) : 'array()'),
            self::DEBUG_CONNECTION
        );

        $this->smtp_conn = $this->getSMTPConnection($host, $port, $timeout, $options);

        if ($this->smtp_conn === false) {
            //Error info already set inside `getSMTPConnection()`
            return false;
    ***REMOVED***

        $this->edebug('Connection: opened', self::DEBUG_CONNECTION);

        //Get any announcement
        $this->last_reply = $this->get_lines();
        $this->edebug('SERVER -> CLIENT: ' . $this->last_reply, self::DEBUG_SERVER);
        $responseCode = (int)substr($this->last_reply, 0, 3);
        if ($responseCode === 220) {
            return true;
    ***REMOVED***
        //Anything other than a 220 response means something went wrong
        //RFC 5321 says the server will wait for us to send a QUIT in response to a 554 error
        //https://tools.ietf.org/html/rfc5321#section-3.1
        if ($responseCode === 554) {
            $this->quit();
    ***REMOVED***
        //This will handle 421 responses which may not wait for a QUIT (e.g. if the server is being shut down)
        $this->edebug('Connection: closing due to error', self::DEBUG_CONNECTION);
        $this->close();
        return false;
***REMOVED***

    /**
     * Create connection to the SMTP server.
     *
     * @param string $host    SMTP server IP or host name
     * @param int    $port    The port number to connect to
     * @param int    $timeout How long to wait for the connection to open
     * @param array  $options An array of options for stream_context_create()
     *
     * @return false|resource
     */
    protected function getSMTPConnection($host, $port = null, $timeout = 30, $options = [***REMOVED***)
***REMOVED***
        static $streamok;
        //This is enabled by default since 5.0.0 but some providers disable it
        //Check this once and cache the result
        if (null === $streamok) {
            $streamok = function_exists('stream_socket_client');
    ***REMOVED***

        $errno = 0;
        $errstr = '';
        if ($streamok) {
            $socket_context = stream_context_create($options);
            set_error_handler([$this, 'errorHandler'***REMOVED***);
            $connection = stream_socket_client(
                $host . ':' . $port,
                $errno,
                $errstr,
                $timeout,
                STREAM_CLIENT_CONNECT,
                $socket_context
            );
    ***REMOVED*** else {
            //Fall back to fsockopen which should work in more places, but is missing some features
            $this->edebug(
                'Connection: stream_socket_client not available, falling back to fsockopen',
                self::DEBUG_CONNECTION
            );
            set_error_handler([$this, 'errorHandler'***REMOVED***);
            $connection = fsockopen(
                $host,
                $port,
                $errno,
                $errstr,
                $timeout
            );
    ***REMOVED***
        restore_error_handler();

        //Verify we connected properly
        if (!is_resource($connection)) {
            $this->setError(
                'Failed to connect to server',
                '',
                (string) $errno,
                $errstr
            );
            $this->edebug(
                'SMTP ERROR: ' . $this->error['error'***REMOVED***
                . ": $errstr ($errno)",
                self::DEBUG_CLIENT
            );

            return false;
    ***REMOVED***

        //SMTP server can take longer to respond, give longer timeout for first read
        //Windows does not have support for this timeout function
        if (strpos(PHP_OS, 'WIN') !== 0) {
            $max = (int)ini_get('max_execution_time');
            //Don't bother if unlimited, or if set_time_limit is disabled
            if (0 !== $max && $timeout > $max && strpos(ini_get('disable_functions'), 'set_time_limit') === false) {
                @set_time_limit($timeout);
        ***REMOVED***
            stream_set_timeout($connection, $timeout, 0);
    ***REMOVED***

        return $connection;
***REMOVED***

    /**
     * Initiate a TLS (encrypted) session.
     *
     * @return bool
     */
    public function startTLS()
***REMOVED***
        if (!$this->sendCommand('STARTTLS', 'STARTTLS', 220)) {
            return false;
    ***REMOVED***

        //Allow the best TLS version(s) we can
        $crypto_method = STREAM_CRYPTO_METHOD_TLS_CLIENT;

        //PHP 5.6.7 dropped inclusion of TLS 1.1 and 1.2 in STREAM_CRYPTO_METHOD_TLS_CLIENT
        //so add them back in manually if we can
        if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
            $crypto_method |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
            $crypto_method |= STREAM_CRYPTO_METHOD_TLSv1_1_CLIENT;
    ***REMOVED***

        //Begin encrypted connection
        set_error_handler([$this, 'errorHandler'***REMOVED***);
        $crypto_ok = stream_socket_enable_crypto(
            $this->smtp_conn,
            true,
            $crypto_method
        );
        restore_error_handler();

        return (bool) $crypto_ok;
***REMOVED***

    /**
     * Perform SMTP authentication.
     * Must be run after hello().
     *
     * @see    hello()
     *
     * @param string $username The user name
     * @param string $password The password
     * @param string $authtype The auth type (CRAM-MD5, PLAIN, LOGIN, XOAUTH2)
     * @param OAuth  $OAuth    An optional OAuth instance for XOAUTH2 authentication
     *
     * @return bool True if successfully authenticated
     */
    public function authenticate(
        $username,
        $password,
        $authtype = null,
        $OAuth = null
    ) {
        if (!$this->server_caps) {
            $this->setError('Authentication is not allowed before HELO/EHLO');

            return false;
    ***REMOVED***

        if (array_key_exists('EHLO', $this->server_caps)) {
            //SMTP extensions are available; try to find a proper authentication method
            if (!array_key_exists('AUTH', $this->server_caps)) {
                $this->setError('Authentication is not allowed at this stage');
                //'at this stage' means that auth may be allowed after the stage changes
                //e.g. after STARTTLS

                return false;
        ***REMOVED***

            $this->edebug('Auth method requested: ' . ($authtype ?: 'UNSPECIFIED'), self::DEBUG_LOWLEVEL);
            $this->edebug(
                'Auth methods available on the server: ' . implode(',', $this->server_caps['AUTH'***REMOVED***),
                self::DEBUG_LOWLEVEL
            );

            //If we have requested a specific auth type, check the server supports it before trying others
            if (null !== $authtype && !in_array($authtype, $this->server_caps['AUTH'***REMOVED***, true)) {
                $this->edebug('Requested auth method not available: ' . $authtype, self::DEBUG_LOWLEVEL);
                $authtype = null;
        ***REMOVED***

            if (empty($authtype)) {
                //If no auth mechanism is specified, attempt to use these, in this order
                //Try CRAM-MD5 first as it's more secure than the others
                foreach (['CRAM-MD5', 'LOGIN', 'PLAIN', 'XOAUTH2'***REMOVED*** as $method) {
                    if (in_array($method, $this->server_caps['AUTH'***REMOVED***, true)) {
                        $authtype = $method;
                        break;
                ***REMOVED***
            ***REMOVED***
                if (empty($authtype)) {
                    $this->setError('No supported authentication methods found');

                    return false;
            ***REMOVED***
                $this->edebug('Auth method selected: ' . $authtype, self::DEBUG_LOWLEVEL);
        ***REMOVED***

            if (!in_array($authtype, $this->server_caps['AUTH'***REMOVED***, true)) {
                $this->setError("The requested authentication method \"$authtype\" is not supported by the server");

                return false;
        ***REMOVED***
    ***REMOVED*** elseif (empty($authtype)) {
            $authtype = 'LOGIN';
    ***REMOVED***
        switch ($authtype) {
            case 'PLAIN':
                //Start authentication
                if (!$this->sendCommand('AUTH', 'AUTH PLAIN', 334)) {
                    return false;
            ***REMOVED***
                //Send encoded username and password
                if (
                    //Format from https://tools.ietf.org/html/rfc4616#section-2
                    //We skip the first field (it's forgery), so the string starts with a null byte
                    !$this->sendCommand(
                        'User & Password',
                        base64_encode("\0" . $username . "\0" . $password),
                        235
                    )
                ) {
                    return false;
            ***REMOVED***
                break;
            case 'LOGIN':
                //Start authentication
                if (!$this->sendCommand('AUTH', 'AUTH LOGIN', 334)) {
                    return false;
            ***REMOVED***
                if (!$this->sendCommand('Username', base64_encode($username), 334)) {
                    return false;
            ***REMOVED***
                if (!$this->sendCommand('Password', base64_encode($password), 235)) {
                    return false;
            ***REMOVED***
                break;
            case 'CRAM-MD5':
                //Start authentication
                if (!$this->sendCommand('AUTH CRAM-MD5', 'AUTH CRAM-MD5', 334)) {
                    return false;
            ***REMOVED***
                //Get the challenge
                $challenge = base64_decode(substr($this->last_reply, 4));

                //Build the response
                $response = $username . ' ' . $this->hmac($challenge, $password);

                //send encoded credentials
                return $this->sendCommand('Username', base64_encode($response), 235);
            case 'XOAUTH2':
                //The OAuth instance must be set up prior to requesting auth.
                if (null === $OAuth) {
                    return false;
            ***REMOVED***
                $oauth = $OAuth->getOauth64();

                //Start authentication
                if (!$this->sendCommand('AUTH', 'AUTH XOAUTH2 ' . $oauth, 235)) {
                    return false;
            ***REMOVED***
                break;
            default:
                $this->setError("Authentication method \"$authtype\" is not supported");

                return false;
    ***REMOVED***

        return true;
***REMOVED***

    /**
     * Calculate an MD5 HMAC hash.
     * Works like hash_hmac('md5', $data, $key)
     * in case that function is not available.
     *
     * @param string $data The data to hash
     * @param string $key  The key to hash with
     *
     * @return string
     */
    protected function hmac($data, $key)
***REMOVED***
        if (function_exists('hash_hmac')) {
            return hash_hmac('md5', $data, $key);
    ***REMOVED***

        //The following borrowed from
        //http://php.net/manual/en/function.mhash.php#27225

        //RFC 2104 HMAC implementation for php.
        //Creates an md5 HMAC.
        //Eliminates the need to install mhash to compute a HMAC
        //by Lance Rushing

        $bytelen = 64; //byte length for md5
        if (strlen($key) > $bytelen) {
            $key = pack('H*', md5($key));
    ***REMOVED***
        $key = str_pad($key, $bytelen, chr(0x00));
        $ipad = str_pad('', $bytelen, chr(0x36));
        $opad = str_pad('', $bytelen, chr(0x5c));
        $k_ipad = $key ^ $ipad;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack('H*', md5($k_ipad . $data)));
***REMOVED***

    /**
     * Check connection state.
     *
     * @return bool True if connected
     */
    public function connected()
***REMOVED***
        if (is_resource($this->smtp_conn)) {
            $sock_status = stream_get_meta_data($this->smtp_conn);
            if ($sock_status['eof'***REMOVED***) {
                //The socket is valid but we are not connected
                $this->edebug(
                    'SMTP NOTICE: EOF caught while checking if connected',
                    self::DEBUG_CLIENT
                );
                $this->close();

                return false;
        ***REMOVED***

            return true; //everything looks good
    ***REMOVED***

        return false;
***REMOVED***

    /**
     * Close the socket and clean up the state of the class.
     * Don't use this function without first trying to use QUIT.
     *
     * @see quit()
     */
    public function close()
***REMOVED***
        $this->setError('');
        $this->server_caps = null;
        $this->helo_rply = null;
        if (is_resource($this->smtp_conn)) {
            //Close the connection and cleanup
            fclose($this->smtp_conn);
            $this->smtp_conn = null; //Makes for cleaner serialization
            $this->edebug('Connection: closed', self::DEBUG_CONNECTION);
    ***REMOVED***
***REMOVED***

    /**
     * Send an SMTP DATA command.
     * Issues a data command and sends the msg_data to the server,
     * finalizing the mail transaction. $msg_data is the message
     * that is to be send with the headers. Each header needs to be
     * on a single line followed by a <CRLF> with the message headers
     * and the message body being separated by an additional <CRLF>.
     * Implements RFC 821: DATA <CRLF>.
     *
     * @param string $msg_data Message data to send
     *
     * @return bool
     */
    public function data($msg_data)
***REMOVED***
        //This will use the standard timelimit
        if (!$this->sendCommand('DATA', 'DATA', 354)) {
            return false;
    ***REMOVED***

        /* The server is ready to accept data!
         * According to rfc821 we should not send more than 1000 characters on a single line (including the LE)
         * so we will break the data up into lines by \r and/or \n then if needed we will break each of those into
         * smaller lines to fit within the limit.
         * We will also look for lines that start with a '.' and prepend an additional '.'.
         * NOTE: this does not count towards line-length limit.
         */

        //Normalize line breaks before exploding
        $lines = explode("\n", str_replace(["\r\n", "\r"***REMOVED***, "\n", $msg_data));

        /* To distinguish between a complete RFC822 message and a plain message body, we check if the first field
         * of the first line (':' separated) does not contain a space then it _should_ be a header and we will
         * process all lines before a blank line as headers.
         */

        $field = substr($lines[0***REMOVED***, 0, strpos($lines[0***REMOVED***, ':'));
        $in_headers = false;
        if (!empty($field) && strpos($field, ' ') === false) {
            $in_headers = true;
    ***REMOVED***

        foreach ($lines as $line) {
            $lines_out = [***REMOVED***;
            if ($in_headers && $line === '') {
                $in_headers = false;
        ***REMOVED***
            //Break this line up into several smaller lines if it's too long
            //Micro-optimisation: isset($str[$len***REMOVED***) is faster than (strlen($str) > $len),
            while (isset($line[self::MAX_LINE_LENGTH***REMOVED***)) {
                //Working backwards, try to find a space within the last MAX_LINE_LENGTH chars of the line to break on
                //so as to avoid breaking in the middle of a word
                $pos = strrpos(substr($line, 0, self::MAX_LINE_LENGTH), ' ');
                //Deliberately matches both false and 0
                if (!$pos) {
                    //No nice break found, add a hard break
                    $pos = self::MAX_LINE_LENGTH - 1;
                    $lines_out[***REMOVED*** = substr($line, 0, $pos);
                    $line = substr($line, $pos);
            ***REMOVED*** else {
                    //Break at the found point
                    $lines_out[***REMOVED*** = substr($line, 0, $pos);
                    //Move along by the amount we dealt with
                    $line = substr($line, $pos + 1);
            ***REMOVED***
                //If processing headers add a LWSP-char to the front of new line RFC822 section 3.1.1
                if ($in_headers) {
                    $line = "\t" . $line;
            ***REMOVED***
        ***REMOVED***
            $lines_out[***REMOVED*** = $line;

            //Send the lines to the server
            foreach ($lines_out as $line_out) {
                //Dot-stuffing as per RFC5321 section 4.5.2
                //https://tools.ietf.org/html/rfc5321#section-4.5.2
                if (!empty($line_out) && $line_out[0***REMOVED*** === '.') {
                    $line_out = '.' . $line_out;
            ***REMOVED***
                $this->client_send($line_out . static::LE, 'DATA');
        ***REMOVED***
    ***REMOVED***

        //Message data has been sent, complete the command
        //Increase timelimit for end of DATA command
        $savetimelimit = $this->Timelimit;
        $this->Timelimit *= 2;
        $result = $this->sendCommand('DATA END', '.', 250);
        $this->recordLastTransactionID();
        //Restore timelimit
        $this->Timelimit = $savetimelimit;

        return $result;
***REMOVED***

    /**
     * Send an SMTP HELO or EHLO command.
     * Used to identify the sending server to the receiving server.
     * This makes sure that client and server are in a known state.
     * Implements RFC 821: HELO <SP> <domain> <CRLF>
     * and RFC 2821 EHLO.
     *
     * @param string $host The host name or IP to connect to
     *
     * @return bool
     */
    public function hello($host = '')
***REMOVED***
        //Try extended hello first (RFC 2821)
        if ($this->sendHello('EHLO', $host)) {
            return true;
    ***REMOVED***

        //Some servers shut down the SMTP service here (RFC 5321)
        if (substr($this->helo_rply, 0, 3) == '421') {
            return false;
    ***REMOVED***

        return $this->sendHello('HELO', $host);
***REMOVED***

    /**
     * Send an SMTP HELO or EHLO command.
     * Low-level implementation used by hello().
     *
     * @param string $hello The HELO string
     * @param string $host  The hostname to say we are
     *
     * @return bool
     *
     * @see hello()
     */
    protected function sendHello($hello, $host)
***REMOVED***
        $noerror = $this->sendCommand($hello, $hello . ' ' . $host, 250);
        $this->helo_rply = $this->last_reply;
        if ($noerror) {
            $this->parseHelloFields($hello);
    ***REMOVED*** else {
            $this->server_caps = null;
    ***REMOVED***

        return $noerror;
***REMOVED***

    /**
     * Parse a reply to HELO/EHLO command to discover server extensions.
     * In case of HELO, the only parameter that can be discovered is a server name.
     *
     * @param string $type `HELO` or `EHLO`
     */
    protected function parseHelloFields($type)
***REMOVED***
        $this->server_caps = [***REMOVED***;
        $lines = explode("\n", $this->helo_rply);

        foreach ($lines as $n => $s) {
            //First 4 chars contain response code followed by - or space
            $s = trim(substr($s, 4));
            if (empty($s)) {
                continue;
        ***REMOVED***
            $fields = explode(' ', $s);
            if (!empty($fields)) {
                if (!$n) {
                    $name = $type;
                    $fields = $fields[0***REMOVED***;
            ***REMOVED*** else {
                    $name = array_shift($fields);
                    switch ($name) {
                        case 'SIZE':
                            $fields = ($fields ? $fields[0***REMOVED*** : 0);
                            break;
                        case 'AUTH':
                            if (!is_array($fields)) {
                                $fields = [***REMOVED***;
                        ***REMOVED***
                            break;
                        default:
                            $fields = true;
                ***REMOVED***
            ***REMOVED***
                $this->server_caps[$name***REMOVED*** = $fields;
        ***REMOVED***
    ***REMOVED***
***REMOVED***

    /**
     * Send an SMTP MAIL command.
     * Starts a mail transaction from the email address specified in
     * $from. Returns true if successful or false otherwise. If True
     * the mail transaction is started and then one or more recipient
     * commands may be called followed by a data command.
     * Implements RFC 821: MAIL <SP> FROM:<reverse-path> <CRLF>.
     *
     * @param string $from Source address of this message
     *
     * @return bool
     */
    public function mail($from)
***REMOVED***
        $useVerp = ($this->do_verp ? ' XVERP' : '');

        return $this->sendCommand(
            'MAIL FROM',
            'MAIL FROM:<' . $from . '>' . $useVerp,
            250
        );
***REMOVED***

    /**
     * Send an SMTP QUIT command.
     * Closes the socket if there is no error or the $close_on_error argument is true.
     * Implements from RFC 821: QUIT <CRLF>.
     *
     * @param bool $close_on_error Should the connection close if an error occurs?
     *
     * @return bool
     */
    public function quit($close_on_error = true)
***REMOVED***
        $noerror = $this->sendCommand('QUIT', 'QUIT', 221);
        $err = $this->error; //Save any error
        if ($noerror || $close_on_error) {
            $this->close();
            $this->error = $err; //Restore any error from the quit command
    ***REMOVED***

        return $noerror;
***REMOVED***

    /**
     * Send an SMTP RCPT command.
     * Sets the TO argument to $toaddr.
     * Returns true if the recipient was accepted false if it was rejected.
     * Implements from RFC 821: RCPT <SP> TO:<forward-path> <CRLF>.
     *
     * @param string $address The address the message is being sent to
     * @param string $dsn     Comma separated list of DSN notifications. NEVER, SUCCESS, FAILURE
     *                        or DELAY. If you specify NEVER all other notifications are ignored.
     *
     * @return bool
     */
    public function recipient($address, $dsn = '')
***REMOVED***
        if (empty($dsn)) {
            $rcpt = 'RCPT TO:<' . $address . '>';
    ***REMOVED*** else {
            $dsn = strtoupper($dsn);
            $notify = [***REMOVED***;

            if (strpos($dsn, 'NEVER') !== false) {
                $notify[***REMOVED*** = 'NEVER';
        ***REMOVED*** else {
                foreach (['SUCCESS', 'FAILURE', 'DELAY'***REMOVED*** as $value) {
                    if (strpos($dsn, $value) !== false) {
                        $notify[***REMOVED*** = $value;
                ***REMOVED***
            ***REMOVED***
        ***REMOVED***

            $rcpt = 'RCPT TO:<' . $address . '> NOTIFY=' . implode(',', $notify);
    ***REMOVED***

        return $this->sendCommand(
            'RCPT TO',
            $rcpt,
            [250, 251***REMOVED***
        );
***REMOVED***

    /**
     * Send an SMTP RSET command.
     * Abort any transaction that is currently in progress.
     * Implements RFC 821: RSET <CRLF>.
     *
     * @return bool True on success
     */
    public function reset()
***REMOVED***
        return $this->sendCommand('RSET', 'RSET', 250);
***REMOVED***

    /**
     * Send a command to an SMTP server and check its return code.
     *
     * @param string    $command       The command name - not sent to the server
     * @param string    $commandstring The actual command to send
     * @param int|array $expect        One or more expected integer success codes
     *
     * @return bool True on success
     */
    protected function sendCommand($command, $commandstring, $expect)
***REMOVED***
        if (!$this->connected()) {
            $this->setError("Called $command without being connected");

            return false;
    ***REMOVED***
        //Reject line breaks in all commands
        if ((strpos($commandstring, "\n") !== false) || (strpos($commandstring, "\r") !== false)) {
            $this->setError("Command '$command' contained line breaks");

            return false;
    ***REMOVED***
        $this->client_send($commandstring . static::LE, $command);

        $this->last_reply = $this->get_lines();
        //Fetch SMTP code and possible error code explanation
        $matches = [***REMOVED***;
        if (preg_match('/^([\d***REMOVED***{3})[ -***REMOVED***(?:([\d***REMOVED***\\.[\d***REMOVED***\\.[\d***REMOVED***{1,2}) )?/', $this->last_reply, $matches)) {
            $code = (int) $matches[1***REMOVED***;
            $code_ex = (count($matches) > 2 ? $matches[2***REMOVED*** : null);
            //Cut off error code from each response line
            $detail = preg_replace(
                "/{$code}[ -***REMOVED***" .
                ($code_ex ? str_replace('.', '\\.', $code_ex) . ' ' : '') . '/m',
                '',
                $this->last_reply
            );
    ***REMOVED*** else {
            //Fall back to simple parsing if regex fails
            $code = (int) substr($this->last_reply, 0, 3);
            $code_ex = null;
            $detail = substr($this->last_reply, 4);
    ***REMOVED***

        $this->edebug('SERVER -> CLIENT: ' . $this->last_reply, self::DEBUG_SERVER);

        if (!in_array($code, (array) $expect, true)) {
            $this->setError(
                "$command command failed",
                $detail,
                $code,
                $code_ex
            );
            $this->edebug(
                'SMTP ERROR: ' . $this->error['error'***REMOVED*** . ': ' . $this->last_reply,
                self::DEBUG_CLIENT
            );

            return false;
    ***REMOVED***

        $this->setError('');

        return true;
***REMOVED***

    /**
     * Send an SMTP SAML command.
     * Starts a mail transaction from the email address specified in $from.
     * Returns true if successful or false otherwise. If True
     * the mail transaction is started and then one or more recipient
     * commands may be called followed by a data command. This command
     * will send the message to the users terminal if they are logged
     * in and send them an email.
     * Implements RFC 821: SAML <SP> FROM:<reverse-path> <CRLF>.
     *
     * @param string $from The address the message is from
     *
     * @return bool
     */
    public function sendAndMail($from)
***REMOVED***
        return $this->sendCommand('SAML', "SAML FROM:$from", 250);
***REMOVED***

    /**
     * Send an SMTP VRFY command.
     *
     * @param string $name The name to verify
     *
     * @return bool
     */
    public function verify($name)
***REMOVED***
        return $this->sendCommand('VRFY', "VRFY $name", [250, 251***REMOVED***);
***REMOVED***

    /**
     * Send an SMTP NOOP command.
     * Used to keep keep-alives alive, doesn't actually do anything.
     *
     * @return bool
     */
    public function noop()
***REMOVED***
        return $this->sendCommand('NOOP', 'NOOP', 250);
***REMOVED***

    /**
     * Send an SMTP TURN command.
     * This is an optional command for SMTP that this class does not support.
     * This method is here to make the RFC821 Definition complete for this class
     * and _may_ be implemented in future.
     * Implements from RFC 821: TURN <CRLF>.
     *
     * @return bool
     */
    public function turn()
***REMOVED***
        $this->setError('The SMTP TURN command is not implemented');
        $this->edebug('SMTP NOTICE: ' . $this->error['error'***REMOVED***, self::DEBUG_CLIENT);

        return false;
***REMOVED***

    /**
     * Send raw data to the server.
     *
     * @param string $data    The data to send
     * @param string $command Optionally, the command this is part of, used only for controlling debug output
     *
     * @return int|bool The number of bytes sent to the server or false on error
     */
    public function client_send($data, $command = '')
***REMOVED***
        //If SMTP transcripts are left enabled, or debug output is posted online
        //it can leak credentials, so hide credentials in all but lowest level
        if (
            self::DEBUG_LOWLEVEL > $this->do_debug &&
            in_array($command, ['User & Password', 'Username', 'Password'***REMOVED***, true)
        ) {
            $this->edebug('CLIENT -> SERVER: [credentials hidden***REMOVED***', self::DEBUG_CLIENT);
    ***REMOVED*** else {
            $this->edebug('CLIENT -> SERVER: ' . $data, self::DEBUG_CLIENT);
    ***REMOVED***
        set_error_handler([$this, 'errorHandler'***REMOVED***);
        $result = fwrite($this->smtp_conn, $data);
        restore_error_handler();

        return $result;
***REMOVED***

    /**
     * Get the latest error.
     *
     * @return array
     */
    public function getError()
***REMOVED***
        return $this->error;
***REMOVED***

    /**
     * Get SMTP extensions available on the server.
     *
     * @return array|null
     */
    public function getServerExtList()
***REMOVED***
        return $this->server_caps;
***REMOVED***

    /**
     * Get metadata about the SMTP server from its HELO/EHLO response.
     * The method works in three ways, dependent on argument value and current state:
     *   1. HELO/EHLO has not been sent - returns null and populates $this->error.
     *   2. HELO has been sent -
     *     $name == 'HELO': returns server name
     *     $name == 'EHLO': returns boolean false
     *     $name == any other string: returns null and populates $this->error
     *   3. EHLO has been sent -
     *     $name == 'HELO'|'EHLO': returns the server name
     *     $name == any other string: if extension $name exists, returns True
     *       or its options (e.g. AUTH mechanisms supported). Otherwise returns False.
     *
     * @param string $name Name of SMTP extension or 'HELO'|'EHLO'
     *
     * @return string|bool|null
     */
    public function getServerExt($name)
***REMOVED***
        if (!$this->server_caps) {
            $this->setError('No HELO/EHLO was sent');

            return null;
    ***REMOVED***

        if (!array_key_exists($name, $this->server_caps)) {
            if ('HELO' === $name) {
                return $this->server_caps['EHLO'***REMOVED***;
        ***REMOVED***
            if ('EHLO' === $name || array_key_exists('EHLO', $this->server_caps)) {
                return false;
        ***REMOVED***
            $this->setError('HELO handshake was used; No information about server extensions available');

            return null;
    ***REMOVED***

        return $this->server_caps[$name***REMOVED***;
***REMOVED***

    /**
     * Get the last reply from the server.
     *
     * @return string
     */
    public function getLastReply()
***REMOVED***
        return $this->last_reply;
***REMOVED***

    /**
     * Read the SMTP server's response.
     * Either before eof or socket timeout occurs on the operation.
     * With SMTP we can tell if we have more lines to read if the
     * 4th character is '-' symbol. If it is a space then we don't
     * need to read anything else.
     *
     * @return string
     */
    protected function get_lines()
***REMOVED***
        //If the connection is bad, give up straight away
        if (!is_resource($this->smtp_conn)) {
            return '';
    ***REMOVED***
        $data = '';
        $endtime = 0;
        stream_set_timeout($this->smtp_conn, $this->Timeout);
        if ($this->Timelimit > 0) {
            $endtime = time() + $this->Timelimit;
    ***REMOVED***
        $selR = [$this->smtp_conn***REMOVED***;
        $selW = null;
        while (is_resource($this->smtp_conn) && !feof($this->smtp_conn)) {
            //Must pass vars in here as params are by reference
            //solution for signals inspired by https://github.com/symfony/symfony/pull/6540
            set_error_handler([$this, 'errorHandler'***REMOVED***);
            $n = stream_select($selR, $selW, $selW, $this->Timelimit);
            restore_error_handler();

            if ($n === false) {
                $message = $this->getError()['detail'***REMOVED***;

                $this->edebug(
                    'SMTP -> get_lines(): select failed (' . $message . ')',
                    self::DEBUG_LOWLEVEL
                );

                //stream_select returns false when the `select` system call is interrupted
                //by an incoming signal, try the select again
                if (stripos($message, 'interrupted system call') !== false) {
                    $this->edebug(
                        'SMTP -> get_lines(): retrying stream_select',
                        self::DEBUG_LOWLEVEL
                    );
                    $this->setError('');
                    continue;
            ***REMOVED***

                break;
        ***REMOVED***

            if (!$n) {
                $this->edebug(
                    'SMTP -> get_lines(): select timed-out in (' . $this->Timelimit . ' sec)',
                    self::DEBUG_LOWLEVEL
                );
                break;
        ***REMOVED***

            //Deliberate noise suppression - errors are handled afterwards
            $str = @fgets($this->smtp_conn, self::MAX_REPLY_LENGTH);
            $this->edebug('SMTP INBOUND: "' . trim($str) . '"', self::DEBUG_LOWLEVEL);
            $data .= $str;
            //If response is only 3 chars (not valid, but RFC5321 S4.2 says it must be handled),
            //or 4th character is a space or a line break char, we are done reading, break the loop.
            //String array access is a significant micro-optimisation over strlen
            if (!isset($str[3***REMOVED***) || $str[3***REMOVED*** === ' ' || $str[3***REMOVED*** === "\r" || $str[3***REMOVED*** === "\n") {
                break;
        ***REMOVED***
            //Timed-out? Log and break
            $info = stream_get_meta_data($this->smtp_conn);
            if ($info['timed_out'***REMOVED***) {
                $this->edebug(
                    'SMTP -> get_lines(): stream timed-out (' . $this->Timeout . ' sec)',
                    self::DEBUG_LOWLEVEL
                );
                break;
        ***REMOVED***
            //Now check if reads took too long
            if ($endtime && time() > $endtime) {
                $this->edebug(
                    'SMTP -> get_lines(): timelimit reached (' .
                    $this->Timelimit . ' sec)',
                    self::DEBUG_LOWLEVEL
                );
                break;
        ***REMOVED***
    ***REMOVED***

        return $data;
***REMOVED***

    /**
     * Enable or disable VERP address generation.
     *
     * @param bool $enabled
     */
    public function setVerp($enabled = false)
***REMOVED***
        $this->do_verp = $enabled;
***REMOVED***

    /**
     * Get VERP address generation mode.
     *
     * @return bool
     */
    public function getVerp()
***REMOVED***
        return $this->do_verp;
***REMOVED***

    /**
     * Set error messages and codes.
     *
     * @param string $message      The error message
     * @param string $detail       Further detail on the error
     * @param string $smtp_code    An associated SMTP error code
     * @param string $smtp_code_ex Extended SMTP code
     */
    protected function setError($message, $detail = '', $smtp_code = '', $smtp_code_ex = '')
***REMOVED***
        $this->error = [
            'error' => $message,
            'detail' => $detail,
            'smtp_code' => $smtp_code,
            'smtp_code_ex' => $smtp_code_ex,
        ***REMOVED***;
***REMOVED***

    /**
     * Set debug output method.
     *
     * @param string|callable $method The name of the mechanism to use for debugging output, or a callable to handle it
     */
    public function setDebugOutput($method = 'echo')
***REMOVED***
        $this->Debugoutput = $method;
***REMOVED***

    /**
     * Get debug output method.
     *
     * @return string
     */
    public function getDebugOutput()
***REMOVED***
        return $this->Debugoutput;
***REMOVED***

    /**
     * Set debug output level.
     *
     * @param int $level
     */
    public function setDebugLevel($level = 0)
***REMOVED***
        $this->do_debug = $level;
***REMOVED***

    /**
     * Get debug output level.
     *
     * @return int
     */
    public function getDebugLevel()
***REMOVED***
        return $this->do_debug;
***REMOVED***

    /**
     * Set SMTP timeout.
     *
     * @param int $timeout The timeout duration in seconds
     */
    public function setTimeout($timeout = 0)
***REMOVED***
        $this->Timeout = $timeout;
***REMOVED***

    /**
     * Get SMTP timeout.
     *
     * @return int
     */
    public function getTimeout()
***REMOVED***
        return $this->Timeout;
***REMOVED***

    /**
     * Reports an error number and string.
     *
     * @param int    $errno   The error number returned by PHP
     * @param string $errmsg  The error message returned by PHP
     * @param string $errfile The file the error occurred in
     * @param int    $errline The line number the error occurred on
     */
    protected function errorHandler($errno, $errmsg, $errfile = '', $errline = 0)
***REMOVED***
        $notice = 'Connection failed.';
        $this->setError(
            $notice,
            $errmsg,
            (string) $errno
        );
        $this->edebug(
            "$notice Error #$errno: $errmsg [$errfile line $errline***REMOVED***",
            self::DEBUG_CONNECTION
        );
***REMOVED***

    /**
     * Extract and return the ID of the last SMTP transaction based on
     * a list of patterns provided in SMTP::$smtp_transaction_id_patterns.
     * Relies on the host providing the ID in response to a DATA command.
     * If no reply has been received yet, it will return null.
     * If no pattern was matched, it will return false.
     *
     * @return bool|string|null
     */
    protected function recordLastTransactionID()
***REMOVED***
        $reply = $this->getLastReply();

        if (empty($reply)) {
            $this->last_smtp_transaction_id = null;
    ***REMOVED*** else {
            $this->last_smtp_transaction_id = false;
            foreach ($this->smtp_transaction_id_patterns as $smtp_transaction_id_pattern) {
                $matches = [***REMOVED***;
                if (preg_match($smtp_transaction_id_pattern, $reply, $matches)) {
                    $this->last_smtp_transaction_id = trim($matches[1***REMOVED***);
                    break;
            ***REMOVED***
        ***REMOVED***
    ***REMOVED***

        return $this->last_smtp_transaction_id;
***REMOVED***

    /**
     * Get the queue/transaction ID of the last SMTP transaction
     * If no reply has been received yet, it will return null.
     * If no pattern was matched, it will return false.
     *
     * @return bool|string|null
     *
     * @see recordLastTransactionID()
     */
    public function getLastTransactionID()
***REMOVED***
        return $this->last_smtp_transaction_id;
***REMOVED***
}
