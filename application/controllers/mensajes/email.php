<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('mensajes/notificaciones_model','notm');
    }

    function sendemail()
    {
        $prodSinStock = $this->input->post('table_productos');
        $trabCorreo = $this->input->post('trabajadoresId');
        $from = $this->ion_auth->user()->row()->email;      
            
        $para           =  $trabCorreo;
        $subject        =  "Listado de Productos con Stock Mínimo";

        $html = '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <style type="text/css">
                h2{
                    font-size: 16px;
                    text-align:center;
                    text-transform: uppercase;
                }
                table{
                    border-collapse: collapse; 
                    border:1px solid #000;
                }
                thead td{
                    background: #ddd;
                    font-weight: bold;
                    text-align:center;
                    text-transform: uppercase;
                }
                td{
                    border: 1px solid #000;
                    padding:5px;
                }
            </style>
        </head>
        <body>
            <h2>'.$subject.'</h2>
            '.$prodSinStock.'
        </body>
        </html>';

        $msg            =  $html;
        $mainheaders    =  'Content-type: text/html; charset=utf-8' . "\r\n";
        $mainheaders    .=  'From: SIRAD <'.$from.'>' . "\r\n";
        $mainheaders    .=  "Cc:" . $from;
       

        $resultado = mail ($para, $subject, $msg, $mainheaders, "-f ".$from);

        if($resultado){
           echo 'Enviado! :)';
        }        
        else
            echo 'Error! :(';

    }
}
?>