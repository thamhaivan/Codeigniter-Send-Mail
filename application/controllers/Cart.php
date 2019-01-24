<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }


    public function sendMail(){
        $data['name'] = 'Mr.Bean';
        $data['email'] = 'mrbean@gmail.com';
        $data['phone'] = '0958684485x';
        //config mail
        $config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'daibkz@gmail.com', // thay = mail cua ban
            'smtp_pass' => 'crtqszeeiugohrca', // thay bang mat khau mail của bạn, nên đăng ký mật khẩu ứng dụng của gmail
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'wordwrap'  => TRUE
        );

        $this->load->library('email', $config);
        //tieu de mail
        $subject = 'Mail Contact';
        //load noi dung mail
        $message = $this->load->view("carts/view_form_mail",$data,true);

        $body ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        <title>' . htmlspecialchars($subject, ENT_QUOTES, $this->email->charset) . '</title>
                            <style type="text/css">
                                body {
                                    font-family: Arial, Verdana, Helvetica, sans-serif;
                                    font-size: 16px;
                                }
                            </style>
                        </head>
                        <body>
                        ' . $message . '
                        </body>
                        </html>';
        $this->email->set_newline("\r\n");
        //cau hinh mail gui va nguoi gui
        $this->email->from('mrbean@gmail.com', 'Mr.Bean');
        //cau hinhf mail nguoi nhan, gui nhieu mail thi cach nhau boi dau ,
        $receiver_email = "daibkz@gmail.com,dai.itbk@gmail.com";

        $this->email->to($receiver_email);

        $this->email->subject($subject);
        $this->email->message($body);

        if(!$this->email->send()){
            //neu khong gui dc mail thi thong bao loi
            echo '<pre>';print_r($this->email->print_debugger());die;
        }
    }

}